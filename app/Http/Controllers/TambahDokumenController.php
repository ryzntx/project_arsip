<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\DokumenKategori;
use App\Models\DokumenKeluar;
use App\Models\DokumenMasuk;
use App\Models\DokumenTemplate;
use App\Models\Instansi;
use App\Models\PdfDocument;
use App\Notifications\SignDocumentKeluars;
use App\OfficeConverter;
use App\PdfOptimzer;
use DateTime;
use DateTimeZone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Spatie\PdfToText\Pdf;

class TambahDokumenController extends Controller {

    // protected $pdfToTextPath = 'C:\poppler-24.08.0\Library\bin\pdftotext';
    protected $pdfToTextPath = 'C:/laragon/bin/git/mingw64/bin/pdftotext';
    protected $gsPath = '/c/Program Files/gs/gs10.04.0/bin/gswin64c';
    protected $libreOfficePath = 'C:/Program Files/LibreOffice/program/soffice';

    /**
     * Menampilkan halaman tambah_dokumen
     */
    public function tambah_dokumen() {
        $instansi = Instansi::all();
        $kategori = DokumenKategori::all();
        $template_dok = DokumenTemplate::all();
        return view(
            "admin.tambah_dokumen.tambah_dokumen",
            compact("instansi", "kategori", "template_dok")
        );
    }

    public function jsonGetDataDokTemplate($id) {
        $data = DokumenTemplate::findOrfail($id);
        return response()->json($data);
    }

    /**
     * Menyimpan data dokumen ke database
     */
    public function simpan(Request $request) {
        // Mendapatkan nilai dari field 'jenis_dokumen' dari request
        $jenis = $request->jenis_dokumen;


        if ($jenis == "dokumen_masuk") {

            $hasil = $this->__simpanDokumenMasuk($request);
        } elseif ($jenis == "dokumen_keluar") {

            $hasil = $this->__simpanDokumenKeluar($request);
        }

        // Memeriksa apakah data berhasil disimpan
        if ($hasil instanceof DokumenMasuk) {

            return redirect()
                ->route("admin.tambah_dokumen")
                ->with("pesan", "Data berhasil di simpan!");
        } elseif ($hasil instanceof DokumenKeluar) {

            return redirect()
                ->route("admin.tambah_dokumen")
                ->with("pesan", "Data berhasil di simpan!");
        } else {

            return redirect()
                ->route("admin.tambah_dokumen")
                ->with("error", "Data gagal disimpan!");
        }
    }

    /**
     *
     *
     * @param array $request
     * @return DokumenMasuk
     *
     * @throws \Illuminate\Http\RedirectResponse
     *
     *
     */
    protected function __simpanDokumenMasuk($request): DokumenMasuk {
        // dd($request);


        $dateTime = new DateTime("now", new DateTimeZone("Asia/Jakarta"));
        $dtFormat = $dateTime->format("dmY_His");


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

            $file = $request->file("file_dokumen");


            $nama_dokumen = preg_replace("/\s+/", "_", $request->nama_dokumen);


            $file_name = $nama_dokumen . "_" . $dtFormat;

            // Memeriksa apakah file yang diunggah adalah file dokumen yang valid (DOC atau DOCX)
            if ($this->__cekFileDokumen($file)) {

                $uploadPath = $file->storeAs("dokumen/masuk", $file_name . '.docx', "public");


                $convert = new OfficeConverter(storage_path("app/public/" . $uploadPath));
                $pdfFileName = pathinfo($convert->convertTo($file_name . '.pdf'), PATHINFO_FILENAME) . '.pdf';


                Storage::disk("public")->delete($uploadPath);


                $pdfFileCompress = new PdfOptimzer(storage_path("app/public/dokumen/masuk/" . $pdfFileName), storage_path("app/public/dokumen/masuk"));
                $pdfCompressName = $pdfFileCompress->convertPdf();


                Storage::disk("public")->delete("dokumen/masuk/" . $pdfFileName);


                $data["lampiran"] = "dokumen/masuk/" . pathinfo($pdfCompressName, PATHINFO_FILENAME) . ".pdf";
            } elseif ($file->getClientOriginalExtension() == "pdf") {

                $uploadPath = $file->storeAs("dokumen/masuk", $file_name . '.pdf', "public");


                $pdfFileCompress = new PdfOptimzer(storage_path("app/public/" . $uploadPath), storage_path("app/public/dokumen/masuk"));
                $pdfCompressName = $pdfFileCompress->convertPdf();


                Storage::disk("public")->delete($uploadPath);


                $data["lampiran"] = "dokumen/masuk/" . pathinfo($pdfCompressName, PATHINFO_FILENAME) . ".pdf";
            } else {

                return redirect()->back()->with("error", "File yang diunggah harus berupa file dokumen (DOC, DOCX, atau PDF)!")->withInput();
            }
        } else {

            return redirect()->back()->with("error", "File dokumen harus diunggah!")->withInput();
        }

        $content = Pdf::getText(
            Storage::disk("public")->path($data["lampiran"]), $this->pdfToTextPath
        );

        $content = preg_replace('/[^A-Za-z0-9\s]/', '', $content);
        $content = Str::limit($content, 60000);

        PdfDocument::insert([
            "title" => $data["nama_dokumen"],
            "content" => $content,
            "file_name" => $data["lampiran"],
        ]);

        return DokumenMasuk::create($data);
    }

    /**
     * Menyimpan dokumen keluar ke dalam database dan mengunggah file dokumen yang terkait.
     *
     * @param array $request
     * @return DokumenKeluar
     *
     * @throws \Illuminate\Http\RedirectResponse
     *
     *
     */
    protected function __simpanDokumenKeluar($request): DokumenKeluar {

        $dateTime = new DateTime("now", new DateTimeZone("Asia/Jakarta"));
        $dtFormat = $dateTime->format("dmY_His");


        $data = [
            "nama_dokumen" => $request->nama_dokumen,
            "penerima" => $request->nama_penerima,
            // "pengirim" => $request->nama_pengirim,
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

            $file = $request->file("file_dokumen");

            // Nama file menggunakan nama_dokumen yang sudah dirubah (mengganti spasi dengan underscore) dan ditambahkan dengan waktu
            $nama_dokumen = preg_replace(
                "/\s+/",
                "_",
                $request->nama_dokumen
            );


            $file_name = $nama_dokumen . "_" . $dtFormat;

            // Memeriksa apakah file yang diunggah adalah file dokumen yang valid (DOC atau DOCX)
            if ($this->__cekFileDokumen($file)) {

                $uploadPath = $file->storeAs("dokumen/keluar", $file_name, "public");


                $convert = new OfficeConverter(storage_path("app/public/" . $uploadPath));
                $pdfFileName = pathinfo($convert->convertTo($file_name . '.pdf'), PATHINFO_FILENAME) . '.pdf';


                Storage::disk("public")->delete($uploadPath);


                $pdfFileCompress = new PdfOptimzer(storage_path("app/public/dokumen/keluar/" . $pdfFileName), storage_path("app/public/dokumen/keluar"));
                $pdfCompressName = $pdfFileCompress->convertPdf();


                Storage::disk("public")->delete("dokumen/keluar/" . $pdfFileName);


                $data["lampiran"] = "dokumen/keluar/" . pathinfo($pdfCompressName, PATHINFO_FILENAME) . ".pdf";

            } elseif ($file->getClientOriginalExtension() == "pdf") {

                $uploadPath = $file->storeAs("dokumen/keluar", $file_name . '.pdf', "public");


                $pdfFileCompress = new PdfOptimzer(storage_path("app/public/" . $uploadPath), storage_path("app/public/dokumen/keluar"));
                $pdfCompressName = $pdfFileCompress->convertPdf();

                // Menghapus file PDF yang diunggah
                Storage::disk("public")->delete($uploadPath);


                $data["lampiran"] = "dokumen/keluar/" . pathinfo($pdfCompressName, PATHINFO_FILENAME) . ".pdf";
            } else {

                return redirect()->back()->with("error", "File yang diunggah harus berupa file dokumen (DOC, DOCX, atau PDF)!")->withInput();
            }
        } else {

            return redirect()->back()->with("error", "File dokumen harus diunggah!")->withInput();
        }
        // Get content from pdf
        $content = Pdf::getText(
            Storage::disk("public")->path($data["lampiran"]), $this->pdfToTextPath
        );
        // Remove special characters
        $content = preg_replace('/[^A-Za-z0-9\s]/', '', $content);
        $content = Str::limit($content, 60000);

        PdfDocument::insert([
            "title" => $data["nama_dokumen"],
            "content" => $content,
            "file_name" => $data["lampiran"],
        ]);
        if ($request->pengajuan_ke_pimpinan == "ya") {

            $user = auth()->user();
            $user->notify(new SignDocumentKeluars('+6285603391954'));
            /*

         */
        }

        return DokumenKeluar::create($data);
    }

    /**
     * Memeriksa apakah ekstensi file yang diunggah termasuk dalam daftar ekstensi yang diperbolehkan.
     *
     * @param \Illuminate\Http\UploadedFile $file
     * @return bool
     */
    protected function __cekFileDokumen($file) {
        $daftarExtensi = ["doc", "docx"];

        $extensiDariFile = $file->getClientOriginalExtension();

        return in_array($extensiDariFile, $daftarExtensi);
    }

}
