<?php

namespace App\Http\Controllers;

use App\Models\DokumenKategori;
use App\Models\DokumenKeluar;
use App\Models\DokumenTemplate;
use App\Models\Instansi;
use App\OfficeConverter;
use App\OfficeProcessor;
use App\PdfOptimzer;
use App\TagPrefixFixer;
use App\TemplateProcessor;
use DateTime;
use DateTimeZone;
use Endroid\QrCode\Color\Color;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel;
use Endroid\QrCode\Logo\Logo;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\RoundBlockSizeMode;
use Endroid\QrCode\Writer\PngWriter;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\File;
use PhpOffice\PhpWord\Element\Section;
use PhpOffice\PhpWord\Shared\Html;
use Spatie\PdfToText\Pdf;

class ArsipKeluarController extends Controller
{
    use OfficeProcessor;

    // FITUR ADMIN
    public function kelolaArsipKeluar()
    {
        $arsip_keluar = DokumenKeluar::with('dokumen_kategori')->with('instansi')->orderBy('disetujui', 'asc')->orderBy('sifat_dokumen', 'desc')->orderBy('tanggal_keluar', 'desc')->get();

        return view('admin.arsip_keluar.kelola_arsipKeluar', compact('arsip_keluar'));
    }

    public function kelolaSampahArsipKeluar()
    {
        $arsip_keluar = DokumenKeluar::onlyTrashed()->with('dokumen_kategori')->with('instansi')->orderBy('disetujui', 'asc')->orderBy('sifat_dokumen', 'desc')->orderBy('tanggal_keluar', 'desc')->get();

        return view('admin.arsip_keluar.sampah', compact('arsip_keluar'));
    }

    public function print($id)
    {
        $arsip_keluar = DokumenKeluar::with('dokumen_kategori')->with('instansi')->find($id);

        if ($arsip_keluar->lampiran) {
            if (Storage::disk('public')->exists($arsip_keluar->lampiran)) {
                return response()->file(storage_path('app/public/' . $arsip_keluar->lampiran));
            }
        }

        return redirect()->back()->with('error', 'Tidak dapat mencetak, dokumen tidak ditemukan!');
    }

    public function download($id)
    {
        $arsip_keluar = DokumenKeluar::with('dokumen_kategori')->with('instansi')->find($id);

        if ($arsip_keluar->lampiran) {
            if (Storage::disk('public')->exists($arsip_keluar->lampiran)) {
                return response()->download(storage_path('app/public/' . $arsip_keluar->lampiran), $arsip_keluar->nama_dokumen);
            }
        }

        return redirect()->back()->with('error', 'Tidak dapat mengunduh, dokumen tidak ditemukan!');
    }

    public function editArsipKeluar($id)
    {
        $arsip_keluar = DokumenKeluar::FindOrFail($id);
        $instansi = Instansi::all();
        $kategori = DokumenKategori::all();
        $template_dok = DokumenTemplate::all();

        return view('admin.arsip_keluar.edit_arsipKeluar', compact('arsip_keluar', 'instansi', 'kategori', 'template_dok'));
        // To-do tampilan edit
    }

    public function updateArsipKeluar(Request $request, $id)
    {
        $arsip_keluar = DokumenKeluar::findOrFail($id);

        $validated = $request->validate([
            'nama_dokumen' => 'required',
            'nama_penerima' => 'required',
            'tanggal_keluar' => 'required',
            'dinas_id' => 'required',
            'kategori_id' => 'required',
            'sifat_dokumen' => 'required',
        ], [
            'file_dokumen.required' => 'Lampiran wajib diisi!',
            'file_dokumen.mimes' => 'File tidak valid. Hanya mendukung format doc | docx | pdf',
            'nama_dokumen.required' => 'Nama dokumen wajib diisi!',
            'nama_penerima.required' => 'Penerima wajib diisi!',
            'tanggal_keluar.required' => 'Tanggal wajib diisi!',
            'dinas_id.required' => 'Dinas/Instansi wajib diisi!',
            'kategori_id.required' => 'Kategori dokumen wajib diisi!',
            'sifat_dokumen.required' => 'Sifat dokumen wajib diisi!',
        ]);

        if ($request->pilihTemplate != null || $request->pilihTemplate != '') {
            $rules = [];
            $message = [];
            foreach ($request->all() as $key => $value) {
                if (Str::startsWith($key, 'var_')) {
                    $rules[$key] = 'required';
                    $message[$key . '.required'] = 'Lampiran data ' . str_replace('_', ' ', substr($key, 4)) . ' wajib diisi!';
                }
            }
            $validated = $request->validate($rules, $message);
        }

        $data = [
            'nama_dokumen' => $request->nama_dokumen,
            'penerima' => $request->nama_penerima,
            'tanggal_keluar' => $request->tanggal_keluar,
            'keterangan' => $request->keterangan,
            'sifat_dokumen' => $request->sifat_dokumen,
            'instansi_id' => $request->dinas_id,
            'dokumen_kategori_id' => $request->kategori_id,
            'user_id' => auth()->user()->id,
            'nomor_surat' => $request->nomor_surat,
            'nomor_urut' => $request->nomor_urut,
        ];

        // if (isset($request->pengajuan_ke_pimpinan)) {
        //     $data['status'] = $request->pengajuan_ke_pimpinan == 'ya' ? 'Menunggu Persetujuan' : 'Dikirimkan';
        //     $data['persetujuan'] = $request->pengajuan_ke_pimpinan;
        // }

        // Mendapatkan tanggal dan waktu saat ini di zona waktu Asia/Jakarta
        $dateTime = new DateTime('now', new DateTimeZone('Asia/Jakarta'));
        $dtFormat = $dateTime->format('dmY_His');

        // Nama file menggunakan nama_dokumen yang sudah dirubah (mengganti spasi dengan underscore) dan ditambahkan dengan waktu
        $nama_dokumen = preg_replace("/\s+/", '_', $request->nama_dokumen);

        // Memeriksa apakah file diunggah dan merupakan file dokumen yang valid
        // if ($request->hasFile('file_dokumen') && $request->file('file_dokumen')->isValid()) {
        //     // Mendapatkan file yang diunggah dari request
        //     $file = $request->file('file_dokumen');

        //     // Membuat nama file baru dengan format tanggal dan waktu saat ini
        //     $file_name = $nama_dokumen.'_'.$dtFormat.'.'.$file->getClientOriginalExtension();

        //     // Memeriksa apakah file yang diunggah adalah file dokumen yang valid (DOC atau DOCX)
        //     if ($this->__cekFileDokumen($file)) {

        //         $uploadPath = $file->storeAs('dokumen/keluar', $file_name.'.docx', 'public');

        //         $convert = new OfficeConverter(storage_path('app/public/'.$uploadPath));
        //         $pdfFileName = pathinfo($convert->convertTo($file_name.'.pdf'), PATHINFO_FILENAME).'.pdf';

        //         Storage::disk('public')->delete($uploadPath);

        //         $pdfFileCompress = new PdfOptimzer(storage_path('app/public/dokumen/keluar/'.$pdfFileName), storage_path('app/public/dokumen/keluar'));
        //         $pdfCompressName = $pdfFileCompress->convertPdf();

        //         Storage::disk('public')->delete('dokumen/keluar/'.$pdfFileName);

        //         $data['lampiran'] = 'dokumen/keluar/'.pathinfo($pdfCompressName, PATHINFO_FILENAME).'.pdf';
        //     } elseif ($file->getClientOriginalExtension() == 'pdf') {

        //         $uploadPath = $file->storeAs('dokumen/keluar', $file_name.'.pdf', 'public');

        //         $pdfFileCompress = new PdfOptimzer(storage_path('app/public/'.$uploadPath), storage_path('app/public/dokumen/keluar'));
        //         $pdfCompressName = $pdfFileCompress->convertPdf();

        //         Storage::disk('public')->delete($uploadPath);

        //         $data['lampiran'] = 'dokumen/keluar/'.pathinfo($pdfCompressName, PATHINFO_FILENAME).'.pdf';
        //     } else {

        //         return redirect()->back()->with('error', 'File yang diunggah harus berupa file dokumen (DOC, DOCX, atau PDF)!')->withInput();
        //     }
        //     // cek jika file template di pilih
        // } else
        if ($request->pilihTemplate != null || $request->pilihTemplate != '') {
            $hasil = $this->__prosesTemplateDokumen($request, $nama_dokumen . '_' . $dtFormat);
            $data['lampiran'] = $hasil;
        }

        if ($request->bukti_dikirimkan) {
            $request->validate([
                'bukti_dikirimkan' => ['required', File::image()->max('5mb')],
            ], [
                'bukti_dikirimkan.required' => 'Foto bukti wajib diisi!',
                'bukti_dikirimkan.image' => 'File tidak valid. Hanya mendukung format PNG | JPG | JPEG',
                'bukti_dikirimkan.size' => 'Ukuran foto bukti maksimal 5MB!',
            ]);

            $file = $request->bukti_dikirimkan;
            $fileName = Str::uuid()->toString() . '.' . $file->extension();
            $lokasi_file = $file->storeAs('dokumen/keluar/foto_bukti', $fileName, 'public');

            $data['bukti_dikirimkan'] = $lokasi_file;
            $data['status'] = 'Selesai';
        }

        $arsip_keluar->update($data);

        return redirect()->route('admin.arsip_keluar')->with('pesan', 'Data berhasil diubah!');

        // To-Do Fungsi update

    }

    public function deleteArsipKeluar($id)
    {
        // To-Do Fungsi Delete
        $arsip_keluar = DokumenKeluar::findOrFail($id);
        $arsip_keluar->delete();

        return redirect()->back()->with('pesan', 'Data berhasil dihapus!');
    }

    public function forceDeleteArsipKeluar($id)
    {
        // To-Do Fungsi Delete
        $arsip_keluar = DokumenKeluar::onlyTrashed()->findOrFail($id);
        $arsip_keluar->forceDelete();

        return redirect()->back()->with('pesan', 'Data berhasil dihapus secara permanen!');
    }

    public function restoreArsipKeluar($id)
    {
        // To-Do Fungsi Delete
        $arsip_keluar = DokumenKeluar::onlyTrashed()->findOrFail($id);
        $arsip_keluar->restore();

        return redirect()->back()->with('pesan', 'Data berhasil direstore!');
    }

    public function insertBukti(Request $request, $id)
    {

        $request->validate([
            'foto_bukti' => ['required', File::image()->max('5mb')],
        ], [
            'foto_bukti.required' => 'Foto bukti wajib diisi!',
            'foto_bukti.image' => 'File tidak valid. Hanya mendukung format PNG | JPG | JPEG',
            'foto_bukti.size' => 'Ukuran foto bukti maksimal 5MB!',
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
    public function monitoringArsipKeluar()
    {
        $arsip_keluar = DokumenKeluar::with('dokumen_kategori')->with('instansi')->orderBy('disetujui', 'asc')->orderBy('sifat_dokumen', 'desc')->orderBy('tanggal_keluar', 'desc')->get();

        return view('pimpinan.Monitor_arsipKeluar.arsipKeluar', compact('arsip_keluar'));
    }

    public function insertAlasan(Request $request, $id)
    {

        $validate = $request->validate([
            'rejectionReason' => 'required',
        ], [
            'rejectionReason.required' => 'Alasan penolakan wajib diisi!',
        ]);

        $arsip_keluar = DokumenKeluar::findOrFail($id);

        $arsip_keluar->update([
            'alasan' => $request->rejectionReason,
            'status' => 'Ditolak',
            'disetujui' => '1',
        ]);

        return redirect()->back()->with('pesan', 'Dokumen di tolak!, alasan penolakan berhasil ditambahkan');
    }

    public function persetujuanArsipKeluar($id)
    {
        $arsip_keluar = DokumenKeluar::findOrFail($id);

        // cek file
        if (! Storage::disk('public')->exists($arsip_keluar->lampiran)) {
            return redirect()->back()->with('error', 'Oops!, Sepertinya file terhapus / tidak ditemukan pada server!');
        }

        // Cek apakah dokumen keluar memiliki tanda tangan
        if (
            $this->checkVariableInTable('ttd', $arsip_keluar->lampiran) ||
            $this->checkVariableInElements('ttd', $arsip_keluar->lampiran) ||
            $this->checkVariableInTable('TTD', $arsip_keluar->lampiran) ||
            $this->checkVariableInElements('TTD', $arsip_keluar->lampiran) ||
            $this->checkVariableInTable('barcode', $arsip_keluar->lampiran) ||
            $this->checkVariableInElements('barcode', $arsip_keluar->lampiran) ||
            $this->checkVariableInTable('BARCODE', $arsip_keluar->lampiran) ||
            $this->checkVariableInElements('BARCODE', $arsip_keluar->lampiran)
        ) {
            try {
                $hasilTtd = $this->__templateProcessorImage($arsip_keluar);
            } catch (\Exception $e) {
                return redirect()->back()->with('error', 'Gagal memproses barcode!, Error: ' . mb_strcut($e->getMessage(), 0, 100));
            }

            // Get file name
            $file_name = pathinfo($arsip_keluar->lampiran, PATHINFO_FILENAME);

            // dd($hasilTtd);

            // Mengonversi file DOCX yang dirubah ke PDF
            $convert = new OfficeConverter(storage_path('app/public/' . $hasilTtd));
            $pdfFileName = pathinfo($convert->convertTo($file_name . '.pdf'), PATHINFO_FILENAME) . '.pdf';

            // Menghapus file DOCX yang dirubah
            Storage::disk('public')->delete($hasilTtd);

            // Mengompres dan mengoptimalkan file PDF yang telah dikonversi
            // $pdfFileCompress = new PdfOptimzer(storage_path('app/public/dokumen/keluar/' . $pdfFileName), storage_path('app/public/dokumen/keluar'));
            // $pdfCompressName = $pdfFileCompress->convertPdf();

            // Menghapus file PDF yang telah dikonversi
            // Storage::disk('public')->delete('dokumen/keluar/' . $pdfFileName);

            // Menyimpan file PDF yang telah dikompres
            $lampiran = 'dokumen/keluar/' . pathinfo($pdfFileName, PATHINFO_FILENAME) . '.pdf';

            // Get content from pdf
            $content = Pdf::getText(
                Storage::disk('public')->path($lampiran),
                config('libpath.pdf_to_text_path')
            );
            // Remove special characters
            $content = preg_replace('/[^A-Za-z0-9\s]/', '', $content);

            $content = Str::limit($content, 60000);

            // Update status dokumen keluar
            $arsip_keluar->update([
                'status' => 'Dikirimkan',
                'disetujui' => '2',
                'lampiran' => $lampiran,
                'pdf_content' => $content,
            ]);

            return redirect()->back()->with('pesan', 'Data berhasil disetujui!');
        }

        return redirect()->back()->with('error', 'Placeholder barcode tidak ditemukan pada dokumen!');
    }

    protected function __generateQrCode($arsip_keluar)
    {
        // make directory if not exists
        if (! Storage::disk('public')->exists('dokumen/keluar/qr-code')) {
            mkdir(storage_path('app/public/dokumen/keluar/qr-code'), 0755, true);
        }

        $writter = new PngWriter();

        $qr_code = new QrCode(
            data: route('verifikasi_dokumen', ['nomor_surat' => Crypt::encryptString($arsip_keluar->nomor_surat)]),
            encoding: new Encoding('UTF-8'),
            errorCorrectionLevel: ErrorCorrectionLevel::Medium,
            size: 250,
            margin: 5,
            roundBlockSizeMode: RoundBlockSizeMode::Margin,
            foregroundColor: new Color(0, 0, 0),
            backgroundColor: new Color(255, 255, 255, 100)
        );

        $logo = new Logo(
            path: public_path('logo/logoPST.png'),
            resizeToWidth: 100,
            punchoutBackground: true,
        );

        $result = $writter->write($qr_code);

        $storage_path = 'dokumen/keluar/qr-code/' . $arsip_keluar->nama_dokumen . '.png';
        $result->saveToFile(storage_path('app/public/' . $storage_path));

        return $storage_path;
    }

    protected function __templateProcessorImage($arsip_keluar)
    {
        $file = $arsip_keluar->lampiran;
        // Membuat instance TemplateProcessor baru dengan file template yang ditentukan
        $template = new \PhpOffice\PhpWord\TemplateProcessor(storage_path('app/public/' . $file));

        try {
            $qr_code = $this->__generateQrCode($arsip_keluar);
        } catch (\Exception $e) {
            throw new \Exception('Gagal membuat QR Code!, Error: ' . $e->getMessage());
        }

        // Ambil gambar tanda tangan dari user yang sedang login
        // $ttd = auth()->user()->ttd_path;

        // if ($ttd == null) {
        //     throw new \Exception('Tanda tangan tidak ditemukan!, Silahkan upload tanda tangan terlebih dahulu pada profil anda.');
        // }

        // Mengatur nilai gambar untuk placeholder 'TTD' dengan path, lebar, tinggi, dan rasio yang ditentukan
        $template->setImageValue('BARCODE', [
            'path' => storage_path('app/public/' . $qr_code),
            'width' => 150,
            'height' => 150,
            'ratio' => false,
        ]);

        // Menyimpan template yang telah dimodifikasi ke path file yang ditentukan
        try {
            $template->saveAs(storage_path('app/public/' . $file));
        } catch (\Exception $e) {
            throw new \Exception('Gagal menyimpan file!, Error: ' . $e->getMessage());
        }

        // Mengembalikan path file dari template yang telah disimpan
        return $file;
    }

    protected function __prosesTemplateDokumen(Request $request, $nama_dokumen): string|RedirectResponse
    {
        $fileTemplate = DokumenTemplate::findOrFail($request->pilihTemplate)->file;

        // cek jika file template tidak ditemukan
        if (! Storage::disk('public')->exists($fileTemplate)) {
            return redirect()->back()->with('error', 'File template tidak ditemukan!')->withInput();
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
                if ($key === 'KONTEN' || $key === 'ISI_SURAT' || $key === 'ISI-SURAT' || $key === 'ISI SURAT' || $key === 'ISISURAT' || $key === 'CONTENT') {
                    $template->setComplexBlock($key, $htmlSection);
                } else {
                    $template->setValue($key, $value);
                }
            }
        }
        $lokasiFile = 'dokumen/keluar/' . $nama_dokumen . '.docx';
        try {
            // cek folder dokumen keluar
            if (! Storage::disk('public')->exists('dokumen/keluar')) {
                Storage::disk('public')->makeDirectory('dokumen/keluar');
            }
            // simpan file
            $template->saveAs(storage_path('app/public/' . $lokasiFile));
            chmod(storage_path('app/public/' . $lokasiFile), 0777);

            // buat file pdf dari file docx
            $convert = new OfficeConverter(
                storage_path('app/public/' . $lokasiFile)
            );
            $convert->convertTo($nama_dokumen . '.pdf');
            // chmod(storage_path('app/public/' . $nama . '.pdf'), 0777);
        } catch (\Exception $e) {
            // Mengembalikan redirect dengan pesan kesalahan
            return redirect()->back()->with('error', 'Gagal memproses dokumen!, Error: ' . $e)->withInput();
        }

        // return nama file
        return $lokasiFile;
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
