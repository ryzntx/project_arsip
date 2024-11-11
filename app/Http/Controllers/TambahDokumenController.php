<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\DokumenKategori;
use App\Models\DokumenKeluar;
use App\Models\DokumenMasuk;
use App\Models\Instansi;
use App\Models\PdfDocument;
use DateTime;
use DateTimeZone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Spatie\PdfToText\Pdf;

class TambahDokumenController extends Controller {
    /**
     * Menampilkan halaman tambah_dokumen
     */
    public function tambah_dokumen() {
        $instansi = Instansi::all();
        $kategori = DokumenKategori::all();
        return view(
            "admin.tambah_dokumen.tambah_dokumen",
            compact("instansi", "kategori")
        );
    }

    /**
     * Menyimpan data dokumen ke database
     */
    public function simpan(Request $request) {
        // Mendapatkan tanggal dan waktu saat ini di zona waktu Asia/Jakarta
        $dateTime = new DateTime("now", new DateTimeZone("Asia/Jakarta"));
        $dtFormat = $dateTime->format("dmY_His");

        // Mendapatkan nilai dari field 'jenis_dokumen' dari request
        $jenis = $request->jenis_dokumen;

        // Memeriksa apakah jenis yang dipilih adalah 'dokumen_masuk'
        if ($jenis == "dokumen_masuk") {
            // Membuat array dengan data yang akan disimpan ke database untuk 'dokumen_masuk'
            $data = [
                "nama_dokumen" => $request->nama_dokumen,
                "penerima" => $request->nama_penerima,
                "pengirim" => $request->nama_pengirim,
                "tanggal_masuk" => $request->tanggal_masuk,
                "keterangan" => $request->keterangan,
                "instansi_id" => $request->dinas_id,
                "dokumen_kategori_id" => $request->kategori_id,
                "user_id" => auth()->user()->id,
            ];

            // Memeriksa apakah file diunggah dan merupakan file dokumen yang valid
            if (
                $request->hasFile("file_dokumen") &&
                $request->file("file_dokumen")->isValid()
            ) {
                // Mendapatkan file yang diunggah dari request
                $file = $request->file("file_dokumen");

                // Nama file menggunakan nama_dokumen yang sudah dirubah (mengganti spasi dengan underscore) dan ditambahkan dengan waktu
                $nama_dokumen = preg_replace("/\s+/", "_", $request->nama_dokumen);

                // Membuat nama file baru dengan format tanggal dan waktu saat ini
                $file_name = $nama_dokumen . "_" . $dtFormat;

                // Memeriksa apakah file yang diunggah adalah file dokumen yang valid (DOC atau DOCX)
                if ($this->cekFileDokumen($file)) {
                    // Mengunggah file DOCX ke penyimpanan publik
                    $uploadPath = $file->storeAs("dokumen/masuk", $file_name . '.docx', "public");

                    // Mengonversi file DOCX yang diunggah ke PDF
                    $pdfFileName = $this->konversiDocxKePdf(storage_path("app/public/" . $uploadPath), storage_path("app/public/dokumen/masuk"));

                    // dd($pdfFileName);

                    // Menghapus file DOCX yang diunggah
                    Storage::disk("public")->delete($uploadPath);

                    // Mengompres dan mengoptimalkan file PDF yang telah dikonversi
                    $pdfCompress = $this->kompressFilePdf(storage_path("app/public/dokumen/masuk/" . $pdfFileName), storage_path("app/public/dokumen/masuk"));

                    // Menghapus file PDF yang telah dikonversi
                    Storage::disk("public")->delete("dokumen/masuk/" . $pdfFileName);

                    // Mengatur field 'lampiran' dalam array data ke nama file PDF yang telah dikompres dan dioptimalkan
                    $data["lampiran"] = "dokumen/masuk/" . pathinfo($pdfCompress, PATHINFO_FILENAME) . ".pdf";
                } elseif ($file->getClientOriginalExtension() == "pdf") {
                    // Mengunggah file PDF ke penyimpanan publik
                    $uploadPath = $file->storeAs(
                        "dokumen/masuk",
                        $file_name,
                        "public"
                    );

                    // Mengompres dan mengoptimalkan file PDF yang diunggah
                    $pdfCompress = $this->kompressFilePdf(
                        storage_path("app/public/" . $uploadPath),
                        storage_path("app/public/dokumen/masuk")
                    );

                    // Menghapus file PDF yang diunggah
                    Storage::disk("public")->delete($uploadPath);

                    // Mengatur field 'lampiran' dalam array data ke nama file PDF yang telah dikompres dan dioptimalkan
                    $data["lampiran"] =
                    "dokumen/masuk/" .
                    pathinfo($pdfCompress, PATHINFO_FILENAME) .
                        ".pdf";
                    // $data['lampiran'] = "dokumen/masuk/" . pathinfo($uploadPath, PATHINFO_FILENAME) . '.pdf';
                } else {
                    // Mengembalikan redirect dengan pesan kesalahan
                    return redirect()
                        ->back()
                        ->with(
                            "error",
                            "File yang diunggah harus berupa file dokumen (DOC, DOCX, atau PDF)!"
                        )
                        ->withInput();
                }
            } else {
                // Mengembalikan redirect dengan pesan kesalahan
                return redirect()
                    ->back()
                    ->with("error", "File dokumen harus diunggah!")
                    ->withInput();
            }
            // Get content from pdf
            $content = Pdf::getText(
                Storage::disk("public")->path($data["lampiran"]), 'C:/laragon/bin/git/mingw64/bin/pdftotext'
            );
            // Remove special characters
            $content = preg_replace('/[^A-Za-z0-9\s]/', '', $content);
            $content = Str::limit($content, 60000);
            // Insert to pdf_documents table
            PdfDocument::insert([
                "title" => $data["nama_dokumen"],
                "content" => $content,
                "file_name" => $data["lampiran"],
            ]);
            // Membuat record 'DokumenMasuk' baru di database dengan array data
            DokumenMasuk::create($data);
        } elseif ($jenis == "dokumen_keluar") {
            // Membuat array dengan data yang akan disimpan ke database untuk 'dokumen_keluar'
            $data = [
                "nama_dokumen" => $request->nama_dokumen,
                "penerima" => $request->nama_penerima,
                "pengirim" => $request->nama_pengirim,
                "tanggal_keluar" => $request->tanggal_keluar,
                "keterangan" => $request->keterangan,
                "status" =>
                $request->pengajuan_ke_pimpinan == "ya"
                ? "Menunggu Persetujuan"
                : "Menunggu Dikirim",
                "persetujuan" => $request->pengajuan_ke_pimpinan,
                "instansi_id" => $request->dinas_id,
                "dokumen_kategori_id" => $request->kategori_id,
                "user_id" => auth()->user()->id,
            ];

            // Memeriksa apakah file diunggah dan merupakan file dokumen yang valid
            if (
                $request->hasFile("file_dokumen") &&
                $request->file("file_dokumen")->isValid()
            ) {
                // Mendapatkan file yang diunggah dari request
                $file = $request->file("file_dokumen");

                // Nama file menggunakan nama_dokumen yang sudah dirubah (mengganti spasi dengan underscore) dan ditambahkan dengan waktu
                $nama_dokumen = preg_replace(
                    "/\s+/",
                    "_",
                    $request->nama_dokumen
                );

                // Membuat nama file baru dengan format tanggal dan waktu saat ini
                $file_name = $nama_dokumen . "_" . $dtFormat;

                // Memeriksa apakah file yang diunggah adalah file dokumen yang valid (DOC atau DOCX)
                if ($this->cekFileDokumen($file)) {
                    // Mengunggah file DOCX ke penyimpanan publik
                    $uploadPath = $file->storeAs(
                        "dokumen/keluar",
                        $file_name,
                        "public"
                    );

                    // Mengonversi file DOCX yang diunggah ke PDF
                    $pdfFileName = $this->konversiDocxKePdf(
                        storage_path("app/public/" . $uploadPath),
                        storage_path("app/public/dokumen/keluar")
                    );

                    // Menghapus file DOCX yang diunggah
                    Storage::disk("public")->delete($uploadPath);

                    // Mengompres dan mengoptimalkan file PDF yang telah dikonversi
                    $pdfCompress = $this->kompressFilePdf(
                        storage_path(
                            "app/public/dokumen/keluar/" . $pdfFileName
                        ),
                        storage_path("app/public/dokumen/keluar")
                    );

                    // Menghapus file PDF yang telah dikonversi
                    Storage::disk("public")->delete(
                        "dokumen/keluar/" . $pdfFileName
                    );

                    // Mengatur field 'lampiran' dalam array data ke nama file PDF yang telah dikompres dan dioptimalkan
                    $data["lampiran"] =
                    "dokumen/keluar/" .
                    pathinfo($pdfCompress, PATHINFO_FILENAME) .
                        ".pdf";
                } elseif ($file->getClientOriginalExtension() == "pdf") {
                    // Mengunggah file PDF ke penyimpanan publik
                    $uploadPath = $file->storeAs(
                        "dokumen/keluar",
                        $file_name,
                        "public"
                    );

                    // Mengompres dan mengoptimalkan file PDF yang diunggah
                    $pdfCompress = $this->kompressFilePdf(
                        storage_path("app/public/" . $uploadPath),
                        storage_path("app/public/dokumen/keluar")
                    );

                    // Menghapus file PDF yang diunggah
                    Storage::disk("public")->delete($uploadPath);

                    // Mengatur field 'lampiran' dalam array data ke nama file PDF yang telah dikompres dan dioptimalkan
                    $data["lampiran"] =
                    "dokumen/keluar/" .
                    pathinfo($pdfCompress, PATHINFO_FILENAME) .
                        ".pdf";
                } else {
                    // Mengembalikan redirect dengan pesan kesalahan
                    return redirect()
                        ->back()
                        ->with(
                            "error",
                            "File yang diunggah harus berupa file dokumen (DOC, DOCX, atau PDF)!"
                        )
                        ->withInput();
                }
            } else {
                // Mengembalikan redirect dengan pesan kesalahan
                return redirect()
                    ->back()
                    ->with("error", "File dokumen harus diunggah!")
                    ->withInput();
            }
            PdfDocument::create([
                "title" => $data["nama_dokumen"],
                "content" => Str::limit(
                    Pdf::getText(
                        Storage::disk("public")->path($data["lampiran"]), 'pdftotext'
                    ),
                    60000
                ),
                "file_name" => $data["lampiran"],
            ]);
            // Membuat record 'DokumenKeluar' baru di database dengan array data
            DokumenKeluar::create($data);
        }

        // Redirect ke route 'admin.tambah_dokumen' dengan pesan sukses
        return redirect()
            ->route("admin.tambah_dokumen")
            ->with("pesan", "Data berhasil di simpan!");
    }

    /**
     * Mengonversi file DOCX ke PDF menggunakan LibreOffice.
     *
     * @param string $lokasiFileDocx Path dari file DOCX yang akan dikonversi.
     * @param string $folderMenyimpan Direktori tempat file PDF yang dikonversi akan disimpan.
     * @return string|int Nama file PDF yang dikonversi jika konversi berhasil, jika tidak maka kode error.
     */
    private function konversiDocxKePdf($lokasiFileDocx, $folderMenyimpan) {
        // Memastikan direktori output ada
        if (!is_dir($folderMenyimpan)) {
            mkdir($folderMenyimpan, 0777, true);
        }

        // Mendefinisikan path file output
        $lokasiPDF =
        $folderMenyimpan .
        "/" .
        pathinfo($lokasiFileDocx, PATHINFO_FILENAME) .
            ".pdf";

        $namaPdf = pathinfo($lokasiFileDocx, PATHINFO_FILENAME) . ".pdf";

        // Perintah untuk mengonversi DOCX ke PDF menggunakan LibreOffice
        $perintah =
        "soffice --headless --convert-to pdf " .
        escapeshellarg($lokasiFileDocx) .
        " --outdir " .
        escapeshellarg($folderMenyimpan);

        // Menjalankan perintah
        exec($perintah, $hasil_perintah, $hasil);

        // Memeriksa apakah konversi berhasil
        if ($hasil == 0) {
            return $namaPdf;
        } else {
            return $hasil;
        }
    }

    /**
     * Memeriksa apakah file dokumen valid.
     *
     * @param  \Illuminate\Http\UploadedFile  $file
     * @return bool
     */
    private function cekFileDokumen($file) {
        $daftarExtensi = ["doc", "docx"];

        $extensiDariFile = $file->getClientOriginalExtension();

        return in_array($extensiDariFile, $daftarExtensi);
    }

    /**
     * Mengompres dan mengoptimalkan file PDF menggunakan Ghostscript.
     *
     * @param string $lokasiFilePdf Path dari file PDF yang akan dikompres dan dioptimalkan.
     * @param string $temmpatMenyimpan Direktori tempat file PDF yang dikompres dan dioptimalkan akan disimpan.
     * @return string Path dari file PDF yang dikompres dan dioptimalkan.
     */
    private function kompressFilePdf($lokasiFilePdf, $temmpatMenyimpan) {
        // Memastikan direktori output ada
        if (!is_dir($temmpatMenyimpan)) {
            mkdir($temmpatMenyimpan, 0777, true);
        }

        // Mendefinisikan path file output
        $lokasiFilePdfTerkompres =
        $temmpatMenyimpan .
        "/" .
        pathinfo($lokasiFilePdf, PATHINFO_FILENAME) .
            "_compressed.pdf";

        // Perintah untuk mengompres dan mengoptimalkan PDF menggunakan Ghostscript
        $perintah =
        "gswin64c -sDEVICE=pdfwrite -dPDFSETTINGS=/screen -dNOPAUSE -dQUIET -dBATCH -sOutputFile=" .
        escapeshellarg($lokasiFilePdfTerkompres) .
        " " .
        escapeshellarg($lokasiFilePdf) .
            " 2>&1";

        // Menjalankan perintah
        exec($perintah, $hasil_perintah, $hasil);

        // Memeriksa apakah kompresi dan optimasi berhasil
        if ($hasil == 0) {
            return $lokasiFilePdfTerkompres;
        } else {
            return $hasil;
        }
    }
}