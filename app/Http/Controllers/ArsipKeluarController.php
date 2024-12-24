<?php

namespace App\Http\Controllers;

use DateTime;
use DateTimeZone;
use App\PdfOptimzer;
use App\TagPrefixFixer;
use App\Models\Instansi;
use App\OfficeConverter;
use App\OfficeProcessor;
use Spatie\PdfToText\Pdf;
use App\TemplateProcessor;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\DokumenKeluar;
use App\Models\DokumenKategori;
use App\Models\DokumenTemplate;
use PhpOffice\PhpWord\Shared\Html;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\Rules\File;
use PhpOffice\PhpWord\Element\Section;
use Illuminate\Support\Facades\Storage;

class ArsipKeluarController extends Controller {
    use OfficeProcessor;

    protected $arsip_keluar;

    // FITUR ADMIN
    public function kelola_arsip_keluar() {
        $arsip_keluar = DokumenKeluar::with('dokumen_kategori')->with('instansi')->get();
        return view('admin.arsip_keluar.kelola_arsipKeluar', compact('arsip_keluar'));
    }
    public function print($id) {
        $arsip_keluar = DokumenKeluar::with('dokumen_kategori')->with('instansi')->find($id);
        return view('admin.arsip_keluar.print', compact('arsip_keluar'));
    }

    public function edit_arsip_keluar($id) {
        $arsip_keluar = DokumenKeluar::FindOrFail($id);
        $instansi = Instansi::all();
        $kategori = DokumenKategori::all();
        $template_dok = DokumenTemplate::all();

        return view('admin.arsip_keluar.edit_arsipKeluar', compact('arsip_keluar', 'instansi', 'kategori', 'template_dok'));
        // To-do tampilan edit
    }

    public function update_arsip_keluar(Request $request, $id) {
        $arsip_keluar = DokumenKeluar::findOrFail($id);

        $validated = $request->validate([
            'nama_dokumen' => 'required',
            'nama_penerima' => 'required',
            'tanggal_keluar' => 'required',
            'dinas_id' => 'required',
            'kategori_id' => 'required',
            'pengajuan_ke_pimpinan' => $arsip_keluar->status == 'Menunggu Persetujuan' ? 'required' : '',
            'file_dokumen' => $request->pengajuan_ke_pimpinan == "tidak" ? [File::types(['doc', 'docx', 'pdf'])] : '',
        ], [
            'file_dokumen.required' => 'Lampiran wajib diisi!',
            'file_dokumen.mimes' => 'File tidak valid. Hanya mendukung format doc | docx | pdf',
            'nama_dokumen.required' => 'Nama dokumen wajib diisi!',
            'nama_penerima.required' => 'Penerima wajib diisi!',
            'tanggal_keluar.required' => 'Tanggal wajib diisi!',
            'dinas_id.required' => 'Dinas/Instansi wajib diisi!',
            'kategori_id.required' => 'Kategori dokumen wajib diisi!',
            'pengajuan_ke_pimpinan.required' => 'Pengajuan ke pimpinan wajib diisi!',
        ]);

        if($request->pilihTemplate != null || $request->pilihTemplate != ''){
            $rules = [];
            $message = [];
            foreach ($request->all() as $key => $value) {
                if (Str::startsWith($key, 'var_')) {
                    $rules[$key] = 'required';
                    $message[$key.'.required'] = 'Lampiran data '. str_replace('_', ' ', substr($key, 4)).' wajib diisi!';
                }
            }
            $validated = $request->validate($rules, $message);
        }

        $data = [
            "nama_dokumen" => $request->nama_dokumen,
            "penerima" => $request->nama_penerima,
            "tanggal_keluar" => $request->tanggal_keluar,
            "keterangan" => $request->keterangan,
            "instansi_id" => $request->dinas_id,
            "dokumen_kategori_id" => $request->kategori_id,
            "user_id" => auth()->user()->id,
        ];

        if(isset($request->pengajuan_ke_pimpinan)) {
            $data["status"] = $request->pengajuan_ke_pimpinan == "ya" ? "Menunggu Persetujuan" : "Dikirimkan";
            $data["persetujuan"] = $request->pengajuan_ke_pimpinan;
        }

        // Mendapatkan tanggal dan waktu saat ini di zona waktu Asia/Jakarta
        $dateTime = new DateTime("now", new DateTimeZone("Asia/Jakarta"));
        $dtFormat = $dateTime->format("dmY_His");

        // Nama file menggunakan nama_dokumen yang sudah dirubah (mengganti spasi dengan underscore) dan ditambahkan dengan waktu
        $nama_dokumen = preg_replace("/\s+/", "_", $request->nama_dokumen);

        // Memeriksa apakah file diunggah dan merupakan file dokumen yang valid
        if ($request->hasFile("file_dokumen") && $request->file("file_dokumen")->isValid()) {
            // Mendapatkan file yang diunggah dari request
            $file = $request->file("file_dokumen");

            // Membuat nama file baru dengan format tanggal dan waktu saat ini
            $file_name = $nama_dokumen . "_" . $dtFormat . "." . $file->getClientOriginalExtension();

            // Memeriksa apakah file yang diunggah adalah file dokumen yang valid (DOC atau DOCX)
            if ($this->__cekFileDokumen($file)) {

                $uploadPath = $file->storeAs("dokumen/keluar", $file_name . '.docx', "public");


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


                Storage::disk("public")->delete($uploadPath);


                $data["lampiran"] = "dokumen/keluar/" . pathinfo($pdfCompressName, PATHINFO_FILENAME) . ".pdf";
            } else {

                return redirect()->back()->with("error", "File yang diunggah harus berupa file dokumen (DOC, DOCX, atau PDF)!")->withInput();
            }
            // cek jika file template di pilih
        } elseif ($request->pilihTemplate != null || $request->pilihTemplate != '') {
            $hasil = $this->__prosesTemplateDokumen($request, $nama_dokumen . "_" . $dtFormat);
            $data["lampiran"] = $hasil;
        }

        $arsip_keluar->update($data);

        return redirect()->route('admin.arsip_keluar')->with('pesan', 'Data berhasil diubah!');

        // To-Do Fungsi update

    }

    public function delete_arsip_keluar($id) {
        // To-Do Fungsi Delete
        $arsip_keluar = DokumenKeluar::findOrFail($id);
        $arsip_keluar->delete();

        return redirect()->back()->with('pesan', 'Data berhasil dihapus!');
    }

    public function insert_bukti(Request $request, $id) {

        $request->validate([
            'foto_bukti' => 'required|image',
        ],[
            'foto_bukti.required' => 'Foto bukti wajib diisi!',
            'foto_bukti.image' => 'Foto bukti harus berupa gambar!',
        ]);

        $file = $request->foto_bukti;
        $fileName = Str::uuid()->toString() . '.' . $file->extension();
        $lokasi_file = $file->storeAs('dokumen/keluar/foto_bukti', $fileName, 'public');

        $data = [
            'bukti_dikirimkan' => $lokasi_file,
            'status' => 'Selesai',
        ];

        DokumenKeluar::findOrFail($id)->update($data);

        return redirect()->back()->with('pesan', 'Bukti terima berhasil ditambahkan');

    }

    // FITUR PIMPINAN
    public function monitoring_arsip_keluar() {
        $arsip_keluar = DokumenKeluar::with('dokumen_kategori')->with('instansi')->get();
        return view('pimpinan.Monitor_arsipKeluar.arsipKeluar', compact('arsip_keluar'));

    }
    public function insert_alasan(Request $request, $id) {

        $validate = $request->validate([
            'rejectionReason' => 'required',
        ], [
            'rejectionReason.required' => 'Alasan penolakan wajib diisi!',
        ]);

        $arsip_keluar = DokumenKeluar::findOrFail($id);

        $arsip_keluar->update([
            'alasan' => $request->rejectionReason,
            'status' => 'Ditolak',
            'persetujuan' => 'tidak',
        ]);

        return redirect()->back()->with('pesan', 'Dokumen di tolak!, alasan penolakan berhasil ditambahkan');

    }

    public function persetujuan_arsip_keluar($id) {
        $arsip_keluar = DokumenKeluar::findOrFail($id);

        // cek file
        if (!Storage::disk('public')->exists($arsip_keluar->lampiran)) {
            return redirect()->back()->with('error', 'Oops!, Sepertinya file terhapus / tidak ditemukan pada server!');
        }

        // Cek apakah dokumen keluar memiliki tanda tangan
        if($this->checkVariableInTable('ttd', $arsip_keluar->lampiran) || $this->checkVariableInElements('ttd', $arsip_keluar->lampiran) || $this->checkVariableInTable('TTD', $arsip_keluar->lampiran) || $this->checkVariableInElements('TTD', $arsip_keluar->lampiran)) {
            try {
                $hasilTtd = $this->__templateProcessorImage($arsip_keluar->lampiran);
            } catch (\Exception $e) {
                return redirect()->back()->with('error', 'Gagal memproses tanda tangan!, Error: ' . mb_strcut($e->getMessage(), 0, 100));
            }

            // Get file name
            $file_name = pathinfo($arsip_keluar->lampiran, PATHINFO_FILENAME);

            // Mengonversi file DOCX yang dirubah ke PDF
            $convert = new OfficeConverter(storage_path("app/public/" . $hasilTtd));
            $pdfFileName = pathinfo($convert->convertTo($file_name . '.pdf'), PATHINFO_FILENAME) . '.pdf';

            // Menghapus file DOCX yang dirubah
            Storage::disk("public")->delete($hasilTtd);

            // Mengompres dan mengoptimalkan file PDF yang telah dikonversi
            $pdfFileCompress = new PdfOptimzer(storage_path("app/public/dokumen/keluar/" . $pdfFileName), storage_path("app/public/dokumen/keluar"));
            $pdfCompressName = $pdfFileCompress->convertPdf();

            // Menghapus file PDF yang telah dikonversi
            Storage::disk("public")->delete("dokumen/keluar/" . $pdfFileName);

            // Menyimpan file PDF yang telah dikompres
            $lampiran = "dokumen/keluar/" . pathinfo($pdfCompressName, PATHINFO_FILENAME) . ".pdf";

            // Get content from pdf
            $content = Pdf::getText(
                Storage::disk("public")->path($lampiran), config('libpath.pdf_to_text_path')
            );
            // Remove special characters
            $content = preg_replace('/[^A-Za-z0-9\s]/', '', $content);

            $content = Str::limit($content, 60000);

            // Update status dokumen keluar
            $arsip_keluar->update([
                'status' => 'Dikirimkan',
                'persetujuan' => 'tidak',
                'lampiran' => $lampiran,
                'pdf_content' => $content,
            ]);

            return redirect()->back()->with('pesan', 'Data berhasil disetujui!');
        }

    return redirect()->back()->with('error', 'Placeholder Tanda tangan tidak ditemukan pada dokumen!');

    }

    protected function __templateProcessorImage($file) {
        // Membuat instance TemplateProcessor baru dengan file template yang ditentukan
        $template = new \PhpOffice\PhpWord\TemplateProcessor(storage_path('app/public/' . $file));

        // Ambil gambar tanda tangan dari user yang sedang login
        $ttd = auth()->user()->ttd_path;

        if($ttd == null) {
            return redirect()->back()->with('error', 'Tanda tangan belum diatur!, Silahkan atur tanda tangan terlebih dahulu di menu profil');
        }
        // Mengatur nilai gambar untuk placeholder 'TTD' dengan path, lebar, tinggi, dan rasio yang ditentukan
        $template->setImageValue('TTD', [
            'path' => storage_path('app/public/' . $ttd),
            'width' => 150,
            'height' => 150,
            'ratio' => false,
        ]);

        // Menyimpan template yang telah dimodifikasi ke path file yang ditentukan
        $template->saveAs(storage_path('app/public/' . $file));

        // Mengembalikan path file dari template yang telah disimpan
        return $file;
    }

    protected function __prosesTemplateDokumen(Request $request, $nama_dokumen): string | RedirectResponse {
        $fileTemplate = DokumenTemplate::findOrFail($request->pilihTemplate)->file;

        // cek jika file template tidak ditemukan
        if (!Storage::disk('public')->exists($fileTemplate)) {
            return redirect()->back()->with("error", "File template tidak ditemukan!")->withInput();
        }

        // memulai proses template
        $template = new TemplateProcessor(storage_path('app/public/' . $fileTemplate));

        // inisialisasi section
        $htmlSection = new Section(0);

        // cek jika ada konten yang dikirimkan
        if ($request->var_KONTEN !== null || $request->var_ISISURAT !== null) {
            // tambahkan konten ke section
            // Html::addHtml($htmlSection, TagPrefixFixer::addNamespaces(TagPrefixFixer::cleanHTML($request->var_KONTEN)));
            Html::addHtml($htmlSection, TagPrefixFixer::addNamespaces($request->var_KONTEN));
        }

        // lakukan perulangan dengan form yang dikirimkan
        foreach ($request->all() as $key => $value) {
            if (Str::startsWith($key, 'var_')) {
                // hapus var_ karakter
                $key = substr($key, 4);
                if ($key === 'KONTEN' || $key === 'ISI_SURAT' || $key === 'ISI-SURAT' || $key === 'ISI SURAT' || $key === 'ISISURAT') {
                    $template->setComplexBlock($key, $htmlSection);
                } else {
                    $template->setValue($key, $value);
                }
            }
        }
        $lokasiFile = 'dokumen/keluar/' . $nama_dokumen . '.docx';
        try {
            // cek folder dokumen keluar
            if (!Storage::disk('public')->exists('dokumen/keluar')) {
                Storage::disk('public')->makeDirectory('dokumen/keluar');
            }
            // simpan file
            $template->saveAs(storage_path('app/public/' . $lokasiFile));
        } catch (\Exception $e) {
            // Mengembalikan redirect dengan pesan kesalahan
            return redirect()->back()->with("error", "Gagal memproses dokumen!, Error: " . $e)->withInput();
        }
        // return nama file
        return $lokasiFile;
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
