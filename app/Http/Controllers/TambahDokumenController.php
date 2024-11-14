<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\DokumenKategori;
use App\Models\DokumenKeluar;
use App\Models\DokumenMasuk;
use App\Models\Instansi;
use App\Models\PdfDocument;
use App\OfficeConverter;
use App\PdfOptimzer;
use DateTime;
use DateTimeZone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Spatie\PdfToText\Pdf;

class TambahDokumenController extends Controller {

    protected $pdfToTextPath = 'C:/laragon/bin/git/mingw64/bin/pdftotext';
    protected $gsPath = '/c/Program Files/gs/gs10.04.0/bin/gswin64c';
    protected $libreOfficePath = 'C:/Program Files/LibreOffice/program/soffice';

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
        // Mendapatkan nilai dari field 'jenis_dokumen' dari request
        $jenis = $request->jenis_dokumen;

        // Memeriksa apakah jenis yang dipilih adalah 'dokumen_masuk'
        if ($jenis == "dokumen_masuk") {
            // Memanggil method __simpanDokumenMasuk() untuk menyimpan dokumen masuk ke dalam database
            $hasil = $this->__simpanDokumenMasuk($request);
        } elseif ($jenis == "dokumen_keluar") {
            // Memanggil method __simpanDokumenKeluar() untuk menyimpan dokumen keluar ke dalam database
            $hasil = $this->__simpanDokumenKeluar($request);
        }

        // Memeriksa apakah data berhasil disimpan
        if ($hasil instanceof DokumenMasuk) {
            // Redirect ke route 'admin.tambah_dokumen' dengan pesan sukses
            return redirect()
                ->route("admin.tambah_dokumen")
                ->with("pesan", "Data berhasil di simpan!");
        } elseif ($hasil instanceof DokumenKeluar) {
            // Redirect ke route 'admin.tambah_dokumen' dengan pesan sukses
            return redirect()
                ->route("admin.tambah_dokumen")
                ->with("pesan", "Data berhasil di simpan!");
        } else {
            // Redirect ke route 'admin.tambah_dokumen' dengan pesan error
            return redirect()
                ->route("admin.tambah_dokumen")
                ->with("error", "Data gagal disimpan!");
        }
    }

    /**
     * Menyimpan dokumen masuk ke dalam database dan mengelola file yang diunggah.
     *
     * @param array $request Data yang akan disimpan ke dalam database.
     * @return DokumenMasuk Mengembalikan instance dari model DokumenMasuk yang baru dibuat.
     *
     * @throws \Illuminate\Http\RedirectResponse Jika file dokumen tidak diunggah atau tidak valid.
     *
     * Proses:
     * 1. Mendapatkan tanggal dan waktu saat ini di zona waktu Asia/Jakarta.
     * 2. Membuat array dengan data yang akan disimpan ke database untuk 'dokumen_keluar'.
     * 3. Memeriksa apakah file diunggah dan merupakan file dokumen yang valid.
     * 4. Jika file yang diunggah adalah DOC atau DOCX:
     *    - Mengunggah file DOCX ke penyimpanan publik.
     *    - Mengonversi file DOCX yang diunggah ke PDF.
     *    - Menghapus file DOCX yang diunggah.
     *    - Mengompres dan mengoptimalkan file PDF yang telah dikonversi.
     *    - Menghapus file PDF yang telah dikonversi.
     *    - Mengatur field 'lampiran' dalam array data ke nama file PDF yang telah dikompres dan dioptimalkan.
     * 5. Jika file yang diunggah adalah PDF:
     *    - Mengunggah file PDF ke penyimpanan publik.
     *    - Mengompres dan mengoptimalkan file PDF yang diunggah.
     *    - Menghapus file PDF yang diunggah.
     *    - Mengatur field 'lampiran' dalam array data ke nama file PDF yang telah dikompres dan dioptimalkan.
     * 6. Jika file yang diunggah bukan DOC, DOCX, atau PDF, mengembalikan redirect dengan pesan kesalahan.
     * 7. Jika file dokumen tidak diunggah, mengembalikan redirect dengan pesan kesalahan.
     * 8. Mendapatkan konten dari file PDF.
     * 9. Menghapus karakter khusus dari konten PDF.
     * 10. Membatasi konten PDF hingga 60000 karakter.
     * 11. Menyimpan konten PDF ke dalam tabel 'pdf_documents'.
     * 12. Membuat record 'DokumenMasuk' baru di database dengan array data.
     */
    protected function __simpanDokumenMasuk($request): DokumenMasuk {
        // dd($request);

        // Mendapatkan tanggal dan waktu saat ini di zona waktu Asia/Jakarta
        $dateTime = new DateTime("now", new DateTimeZone("Asia/Jakarta"));
        $dtFormat = $dateTime->format("dmY_His");

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
            if ($this->__cekFileDokumen($file)) {
                // Mengunggah file DOCX ke penyimpanan publik
                $uploadPath = $file->storeAs("dokumen/masuk", $file_name . '.docx', "public");

                // Mengonversi file DOCX yang diunggah ke PDF
                $convert = new OfficeConverter(storage_path("app/public/" . $uploadPath));
                $pdfFileName = pathinfo($convert->convertTo($file_name . '.pdf'), PATHINFO_FILENAME) . '.pdf';

                // Menghapus file DOCX yang diunggah
                Storage::disk("public")->delete($uploadPath);

                // Mengompres dan mengoptimalkan file PDF yang telah dikonversi
                $pdfFileCompress = new PdfOptimzer(storage_path("app/public/dokumen/masuk/" . $pdfFileName), storage_path("app/public/dokumen/masuk"));
                $pdfCompressName = $pdfFileCompress->convertPdf();

                // Menghapus file PDF yang telah dikonversi
                Storage::disk("public")->delete("dokumen/masuk/" . $pdfFileName);

                // Mengatur field 'lampiran' dalam array data ke nama file PDF yang telah dikompres dan dioptimalkan
                $data["lampiran"] = "dokumen/masuk/" . pathinfo($pdfCompressName, PATHINFO_FILENAME) . ".pdf";
            } elseif ($file->getClientOriginalExtension() == "pdf") {
                // Mengunggah file PDF ke penyimpanan publik
                $uploadPath = $file->storeAs("dokumen/masuk", $file_name . '.pdf', "public");

                // Mengompres dan mengoptimalkan file PDF yang diunggah
                $pdfFileCompress = new PdfOptimzer(storage_path("app/public/" . $uploadPath), storage_path("app/public/dokumen/masuk"));
                $pdfCompressName = $pdfFileCompress->convertPdf();

                // Menghapus file PDF yang diunggah
                Storage::disk("public")->delete($uploadPath);

                // Mengatur field 'lampiran' dalam array data ke nama file PDF yang telah dikompres dan dioptimalkan
                $data["lampiran"] = "dokumen/masuk/" . pathinfo($pdfCompressName, PATHINFO_FILENAME) . ".pdf";
            } else {
                // Mengembalikan redirect dengan pesan kesalahan
                return redirect()->back()->with("error", "File yang diunggah harus berupa file dokumen (DOC, DOCX, atau PDF)!")->withInput();
            }
        } else {
            // Mengembalikan redirect dengan pesan kesalahan
            return redirect()->back()->with("error", "File dokumen harus diunggah!")->withInput();
        }
        // Get content from pdf
        $content = Pdf::getText(
            Storage::disk("public")->path($data["lampiran"]), $this->pdfToTextPath
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
        return DokumenMasuk::create($data);
    }

    /**
     * Menyimpan dokumen keluar ke dalam database dan mengunggah file dokumen yang terkait.
     *
     * @param array $request Data yang akan disimpan ke dalam database.
     * @return DokumenKeluar Record 'DokumenKeluar' yang baru dibuat.
     *
     * @throws \Illuminate\Http\RedirectResponse Jika file dokumen tidak diunggah atau tidak valid.
     *
     * Proses:
     * 1. Mendapatkan tanggal dan waktu saat ini di zona waktu Asia/Jakarta.
     * 2. Membuat array dengan data yang akan disimpan ke database untuk 'dokumen_keluar'.
     * 3. Memeriksa apakah file diunggah dan merupakan file dokumen yang valid.
     * 4. Jika file yang diunggah adalah DOC atau DOCX:
     *    - Mengunggah file DOCX ke penyimpanan publik.
     *    - Mengonversi file DOCX yang diunggah ke PDF.
     *    - Menghapus file DOCX yang diunggah.
     *    - Mengompres dan mengoptimalkan file PDF yang telah dikonversi.
     *    - Menghapus file PDF yang telah dikonversi.
     *    - Mengatur field 'lampiran' dalam array data ke nama file PDF yang telah dikompres dan dioptimalkan.
     * 5. Jika file yang diunggah adalah PDF:
     *    - Mengunggah file PDF ke penyimpanan publik.
     *    - Mengompres dan mengoptimalkan file PDF yang diunggah.
     *    - Menghapus file PDF yang diunggah.
     *    - Mengatur field 'lampiran' dalam array data ke nama file PDF yang telah dikompres dan dioptimalkan.
     * 6. Jika file yang diunggah bukan DOC, DOCX, atau PDF, mengembalikan redirect dengan pesan kesalahan.
     * 7. Jika file dokumen tidak diunggah, mengembalikan redirect dengan pesan kesalahan.
     * 8. Mendapatkan konten dari file PDF.
     * 9. Menghapus karakter khusus dari konten PDF.
     * 10. Membatasi konten PDF hingga 60000 karakter.
     * 11. Menyimpan konten PDF ke dalam tabel 'pdf_documents'.
     * 12. Membuat record 'DokumenKeluar' baru di database dengan array data.
     */
    protected function __simpanDokumenKeluar($request): DokumenKeluar {
        // Mendapatkan tanggal dan waktu saat ini di zona waktu Asia/Jakarta
        $dateTime = new DateTime("now", new DateTimeZone("Asia/Jakarta"));
        $dtFormat = $dateTime->format("dmY_His");

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
            if ($this->__cekFileDokumen($file)) {
                // Mengunggah file DOCX ke penyimpanan publik
                $uploadPath = $file->storeAs("dokumen/keluar", $file_name, "public");

                // Mengonversi file DOCX yang diunggah ke PDF
                $convert = new OfficeConverter(storage_path("app/public/" . $uploadPath));
                $pdfFileName = pathinfo($convert->convertTo($file_name . '.pdf'), PATHINFO_FILENAME) . '.pdf';

                // Menghapus file DOCX yang diunggah
                Storage::disk("public")->delete($uploadPath);

                // Mengompres dan mengoptimalkan file PDF yang telah dikonversi
                $pdfFileCompress = new PdfOptimzer(storage_path("app/public/dokumen/keluar/" . $pdfFileName), storage_path("app/public/dokumen/keluar"));
                $pdfCompressName = $pdfFileCompress->convertPdf();

                // Menghapus file PDF yang telah dikonversi
                Storage::disk("public")->delete("dokumen/keluar/" . $pdfFileName);

                // Mengatur field 'lampiran' dalam array data ke nama file PDF yang telah dikompres dan dioptimalkan
                $data["lampiran"] = "dokumen/keluar/" . pathinfo($pdfCompressName, PATHINFO_FILENAME) . ".pdf";

            } elseif ($file->getClientOriginalExtension() == "pdf") {
                // Mengunggah file PDF ke penyimpanan publik
                $uploadPath = $file->storeAs("dokumen/keluar", $file_name . '.pdf', "public");

                // Mengompres dan mengoptimalkan file PDF yang diunggah
                $pdfFileCompress = new PdfOptimzer(storage_path("app/public/" . $uploadPath), storage_path("app/public/dokumen/keluar"));
                $pdfCompressName = $pdfFileCompress->convertPdf();

                // Menghapus file PDF yang diunggah
                Storage::disk("public")->delete($uploadPath);

                // Mengatur field 'lampiran' dalam array data ke nama file PDF yang telah dikompres dan dioptimalkan
                $data["lampiran"] = "dokumen/keluar/" . pathinfo($pdfCompressName, PATHINFO_FILENAME) . ".pdf";
            } else {
                // Mengembalikan redirect dengan pesan kesalahan
                return redirect()->back()->with("error", "File yang diunggah harus berupa file dokumen (DOC, DOCX, atau PDF)!")->withInput();
            }
        } else {
            // Mengembalikan redirect dengan pesan kesalahan
            return redirect()->back()->with("error", "File dokumen harus diunggah!")->withInput();
        }
        // Get content from pdf
        $content = Pdf::getText(
            Storage::disk("public")->path($data["lampiran"]), $this->pdfToTextPath
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
        // Membuat record 'DokumenKeluar' baru di database dengan array data
        return DokumenKeluar::create($data);
    }

    /**
     * Memeriksa apakah ekstensi file yang diunggah termasuk dalam daftar ekstensi yang diperbolehkan.
     *
     * @param \Illuminate\Http\UploadedFile $file File yang akan diperiksa.
     * @return bool Mengembalikan true jika ekstensi file termasuk dalam daftar yang diperbolehkan, false jika tidak.
     */
    protected function __cekFileDokumen($file) {
        $daftarExtensi = ["doc", "docx"];

        $extensiDariFile = $file->getClientOriginalExtension();

        return in_array($extensiDariFile, $daftarExtensi);
    }

}
