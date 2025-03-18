<?php

namespace App\Http\Controllers;

use App\Models\DokumenKategori;
use App\Models\DokumenMasuk;
use App\Models\Instansi;
use App\OfficeConverter;
use App\PdfOptimzer;
use DateTime;
use DateTimeZone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArsipMasukController extends Controller
{
    // FITUR ADMIN
    public function kelola_arsip_masuk()
    {
        $arsip_masuk = DokumenMasuk::with('dokumen_kategori')->with('instansi')->get();

        return view('admin.arsip_masuk.kelola_arsipMasuk', compact('arsip_masuk'));
    }

    public function kelolaSampahArsipMasuk()
    {
        $arsip_masuk = DokumenMasuk::onlyTrashed()->with('dokumen_kategori')->with('instansi')->get();

        return view('admin.arsip_masuk.sampah', compact('arsip_masuk'));
    }

    public function print($id)
    {
        $arsip_masuk = DokumenMasuk::with('dokumen_kategori')->with('instansi')->find($id);

        if ($arsip_masuk->lampiran) {
            if (Storage::disk('public')->exists($arsip_masuk->lampiran)) {
                return response()->file(storage_path('app/public/' . $arsip_masuk->lampiran));
            }
        }

        return redirect()->back()->with('error', 'Tidak dapat mencetak, dokumen tidak ditemukan!');
    }

    public function download($id)
    {
        $arsip_masuk = DokumenMasuk::with('dokumen_kategori')->with('instansi')->find($id);

        if ($arsip_masuk->lampiran) {
            if (Storage::disk('public')->exists($arsip_masuk->lampiran)) {
                return response()->download(storage_path('app/public/' . $arsip_masuk->lampiran), $arsip_masuk->nama_dokumen);
            }
        }

        return redirect()->back()->with('error', 'Tidak dapat mengunduh, dokumen tidak ditemukan!');
    }

    public function edit_arsip_masuk($id)
    {
        $arsip_masuk = DokumenMasuk::findOrFail($id);
        $instansi = Instansi::all();
        $kategori = DokumenKategori::all();

        return view('admin.arsip_masuk.edit_arsipMasuk', compact('arsip_masuk', 'instansi', 'kategori'));
    }

    public function update_arsip_masuk(Request $request, $id)
    {
        $arsip_masuk = DokumenMasuk::findOrFail($id);

        $validate = $request->validate([
            'nama_dokumen' => 'required',
            'nama_penerima' => 'required',
            'nama_pengirim' => 'required',
            'tanggal_masuk' => 'required',
            'dinas_id' => 'required',
            'kategori_id' => 'required',
        ], [
            'nama_dokumen.required' => 'Nama dokumen wajib diisi!',
            'nama_penerima.required' => 'Penerima wajib diisi!',
            'nama_pengirim.required' => 'Pengirim wajib diisi!',
            'tanggal_masuk.required' => 'Tanggal wajib diisi!',
            'dinas_id.required' => 'Dinas/Instansi wajib diisi!',
            'kategori_id.required' => 'Kategori dokumen wajib diisi!',
        ]);

        $data = [
            'nama_dokumen' => $request->nama_dokumen,
            'penerima' => $request->nama_penerima,
            'pengirim' => $request->nama_pengirim,
            'tanggal_masuk' => $request->tanggal_masuk,
            'keterangan' => $request->keterangan,
            'instansi_id' => $request->dinas_id,
            'dokumen_kategori_id' => $request->kategori_id,
            'user_id' => auth()->user()->id,
        ];

        if (
            $request->hasFile('file_dokumen') &&
            $request->file('file_dokumen')->isValid()
        ) {

            $validate = $request->validate([
                'file_dokumen' => 'required|mimes:doc,docx,pdf',
            ], [
                'file_dokumen.required' => 'Lampiran wajib diisi!',
                'file_dokumen.mimes' => 'File tidak valid. Hanya mendukung format doc | docx | pdf',
            ]);

            $dateTime = new DateTime('now', new DateTimeZone('Asia/Jakarta'));
            $dtFormat = $dateTime->format('dmY_His');

            $file = $request->file('file_dokumen');

            $nama_dokumen = preg_replace("/\s+/", '_', $request->nama_dokumen);

            $file_name = $nama_dokumen . '_' . $dtFormat;
            // Membuat nama file baru dengan format tanggal dan waktu saat ini
            $file_name = $nama_dokumen . '_' . $dtFormat . '.' . $file->getClientOriginalExtension();

            // Memeriksa apakah file yang diunggah adalah file dokumen yang valid (DOC atau DOCX)
            if ($this->__cekFileDokumen($file)) {

                $uploadPath = $file->storeAs('dokumen/masuk', $file_name . '.docx', 'public');

                $convert = new OfficeConverter(storage_path('app/public/' . $uploadPath));
                $pdfFileName = pathinfo($convert->convertTo($file_name . '.pdf'), PATHINFO_FILENAME) . '.pdf';

                Storage::disk('public')->delete($uploadPath);

                $pdfFileCompress = new PdfOptimzer(storage_path('app/public/dokumen/masuk/' . $pdfFileName), storage_path('app/public/dokumen/masuk'));
                $pdfCompressName = $pdfFileCompress->convertPdf();

                Storage::disk('public')->delete('dokumen/masuk/' . $pdfFileName);

                $data['lampiran'] = 'dokumen/masuk/' . pathinfo($pdfCompressName, PATHINFO_FILENAME) . '.pdf';
            } elseif ($file->getClientOriginalExtension() == 'pdf') {

                $uploadPath = $file->storeAs('dokumen/masuk', $file_name . '.pdf', 'public');

                $pdfFileCompress = new PdfOptimzer(storage_path('app/public/' . $uploadPath), storage_path('app/public/dokumen/masuk'));
                $pdfCompressName = $pdfFileCompress->convertPdf();

                Storage::disk('public')->delete($uploadPath);

                $data['lampiran'] = 'dokumen/masuk/' . pathinfo($pdfCompressName, PATHINFO_FILENAME) . '.pdf';
            } else {

                return redirect()->back()->with('error', 'File yang diunggah harus berupa file dokumen (DOC, DOCX, atau PDF)!')->withInput();
            }
        }

        $arsip_masuk->update($data);

        return redirect()->route('admin.arsip_masuk')->with('pesan', 'Data berhasil diubah!');

        // To-Do Fungsi update

    }

    public function delete_arsip_masuk($id)
    {
        // To-Do Fungsi Delete
        $arsip_masuk = DokumenMasuk::findOrFail($id);
        $arsip_masuk->delete();

        return redirect()->back()->with('pesan', 'Data berhasil dihapus!');
    }

    public function restore_arsip_masuk($id)
    {
        // To-Do Fungsi Restore
        $arsip_masuk = DokumenMasuk::onlyTrashed()->findOrFail($id);
        $arsip_masuk->restore();

        return redirect()->back()->with('pesan', 'Data berhasil dipulihkan!');
    }

    public function delete_permanen_arsip_masuk($id)
    {
        // To-Do Fungsi Delete Permanen
        $arsip_masuk = DokumenMasuk::onlyTrashed()->findOrFail($id);
        $arsip_masuk->forceDelete();

        return redirect()->back()->with('pesan', 'Data berhasil dihapus permanen!');
    }

    // FITUR PIMPINAN
    public function monitoring_arsip_masuk()
    {
        $arsip_masuk = DokumenMasuk::with('dokumen_kategori')->with('instansi')->get();

        return view('pimpinan.Monitor_arsipMasuk.arsipMasuk', compact('arsip_masuk'));
    }

    /**
     * Memeriksa apakah ekstensi file yang diunggah termasuk dalam daftar ekstensi yang diperbolehkan.
     *
     * @param  \Illuminate\Http\UploadedFile  $file
     * @return bool
     */
    protected function __cekFileDokumen($file)
    {
        $daftarExtensi = ['doc', 'docx'];

        $extensiDariFile = $file->getClientOriginalExtension();

        return in_array($extensiDariFile, $daftarExtensi);
    }
}
