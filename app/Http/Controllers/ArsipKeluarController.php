<?php

namespace App\Http\Controllers;

use App\PdfOptimzer;
use App\Models\Instansi;
use App\OfficeConverter;
use Spatie\PdfToText\Pdf;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\DokumenKeluar;
use App\Models\DokumenKategori;
use App\Http\Controllers\Controller;
use App\OfficeProcessor;
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

        return view('admin.arsip_keluar.edit_arsipKeluar', compact('arsip_keluar', 'instansi', 'kategori'));
        // To-do tampilan edit
    }

    public function update_arsip_keluar(Request $request, $id) {
        $arsip_keluar = DokumenKeluar::findOrFail($id);

        $data = [
            'nama_dokumen' => $request->nama_dokumen,
            'penerima' => $request->nama_penerima,
            'pengirim' => $request->nama_pengirim,
            'tanggal_keluar' => $request->tanggal_keluar,
            'keterangan' => $request->keterangan,
            'status' => ($request->pengajuan_ke_pimpinan == 'ya') ? 'Menunggu Persetujuan' : 'Menunggu Dikirim',
            'persetujuan' => $request->pengajuan_ke_pimpinan,
            'instansi_id' => $request->dinas_id,
            'dokumen_kategori_id' => $request->kategori_id,
            'user_id' => auth()->user()->id,

        ];

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
            'foto_bukti' => 'image',
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
            $hasilTtd = $this->__templateProcessorImage($arsip_keluar->lampiran);

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
    // FITUR USER
}
