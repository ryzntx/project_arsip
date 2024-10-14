<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\DokumenKategori;
use App\Models\DokumenKeluar;
use App\Models\DokumenMasuk;
use App\Models\Instansi;
use DateTime;
use DateTimeZone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TambahDokumenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // TAMBAH DOKUMEN
    public function tambah_dokumen()
    {
        $instansi = Instansi::all();
        $kategori = DokumenKategori::all();
        return view('admin.tambah_dokumen.tambah_dokumen', compact('instansi', 'kategori'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function simpan(Request $request) {

        // Mendapatkan tanggal dan waktu saat ini di zona waktu Asia/Jakarta
        $dateTime = new DateTime('now', new DateTimeZone('Asia/Jakarta'));
        $dtFormat = $dateTime->format('dmY_His');

        // Mendapatkan nilai dari field 'jenis_dokumen' dari request
        $jenis = $request->jenis_dokumen;

        // Memeriksa apakah jenis yang dipilih adalah 'dokumen_masuk'
        if ($jenis == 'dokumen_masuk') {
            // Membuat array dengan data yang akan disimpan ke database untuk 'dokumen_masuk'
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

            // Memeriksa apakah file diunggah dan merupakan file dokumen yang valid
            if ($request->hasFile('file_dokumen') && $request->file('file_dokumen')->isValid()) {
                // Mendapatkan file yang diunggah dari request
            $file = $request->file('file_dokumen');

            // Mendapatkan nama asli file yang diunggah
            $original_name = $file->getClientOriginalName();

            // Membuat nama file baru dengan format tanggal dan waktu saat ini
            $file_name = $dtFormat . '_' . $original_name;

                // Memeriksa apakah file yang diunggah adalah file dokumen yang valid (DOC atau DOCX)
                if ($this->isValidDocumentFile($file)) {

                    // Mengunggah file DOCX ke penyimpanan publik
                    $uploadPath = $file->storeAs('dokumen/masuk', $file_name, 'public');

                    // Mengonversi file DOCX yang diunggah ke PDF
                    $pdfFileName = $this->convertDocxToPdf(storage_path("app/public/" . $uploadPath), storage_path('app/public/dokumen/masuk'));

                    // Menghapus file DOCX yang diunggah
                    Storage::disk('public')->delete($uploadPath);

                    // Mengompres dan mengoptimalkan file PDF yang telah dikonversi
                    $pdfCompress = $this->compressAndOptimizePdf(storage_path('app/public/dokumen/masuk/' . $pdfFileName), storage_path('app/public/dokumen/masuk'));

                    // Menghapus file PDF yang telah dikonversi
                    Storage::disk('public')->delete('dokumen/masuk/' . $pdfFileName);

                    // Mengatur field 'lampiran' dalam array data ke nama file PDF yang telah dikompres dan dioptimalkan
                    $data['lampiran'] = "dokumen/masuk/" . pathinfo($pdfCompress, PATHINFO_FILENAME) . '.pdf';
                } else if ($file->getClientOriginalExtension() == 'pdf') {
                    // Mengunggah file PDF ke penyimpanan publik
                    $uploadPath = $file->storeAs('dokumen/masuk', $file_name, 'public');

                    // Mengompres dan mengoptimalkan file PDF yang diunggah
                    $pdfCompress = $this->compressAndOptimizePdf(storage_path('app/public/' . $uploadPath), storage_path('app/public/dokumen/masuk'));

                    // Menghapus file PDF yang diunggah
                    Storage::disk('public')->delete($uploadPath);

                    // Mengatur field 'lampiran' dalam array data ke nama file PDF yang telah dikompres dan dioptimalkan
                    $data['lampiran'] = "dokumen/masuk/" . pathinfo($pdfCompress, PATHINFO_FILENAME) . '.pdf';
                } else {
                    // Mengembalikan redirect dengan pesan kesalahan
                    return redirect()->back()->with('error', 'File yang diunggah harus berupa file dokumen (DOC, DOCX, atau PDF)!')->withInput();
                }
            } else {
                // Mengembalikan redirect dengan pesan kesalahan
                return redirect()->back()->with('error', 'File dokumen harus diunggah!')->withInput();
            }
            // Membuat record 'DokumenMasuk' baru di database dengan array data
            DokumenMasuk::create($data);

        } elseif ($jenis == 'dokumen_keluar') {
            // Membuat array dengan data yang akan disimpan ke database untuk 'dokumen_keluar'
            $data = [
                'nama_dokumen' => $request->nama_dokumen,
                'penerima' => $request->nama_penerima,
                'pengirim' => $request->nama_pengirim,
                'tanggal_keluar' => $request->tanggal_keluar,
                'keterangan' => $request->keterangan,
                'status' => ($request->pengajuan_ke_pimpinan=='ya')?'Menunggu Persetujuan':'Menunggu Dikirim',
                'persetujuan' => $request->pengajuan_ke_pimpinan,
                'instansi_id' => $request->dinas_id,
                'dokumen_kategori_id' => $request->kategori_id,
                'user_id' => auth()->user()->id,
            ];


            // Memeriksa apakah file diunggah dan merupakan file dokumen yang valid
            if ($request->hasFile('file_dokumen') && $request->file('file_dokumen')->isValid()) {
                // Mendapatkan file yang diunggah dari request
                $file = $request->file('file_dokumen');

                // Mendapatkan nama asli file yang diunggah
                $original_name = $file->getClientOriginalName();

                // Membuat nama file baru dengan format tanggal dan waktu saat ini
                $file_name = $dtFormat . '_' . $original_name;

                // Memeriksa apakah file yang diunggah adalah file dokumen yang valid (DOC atau DOCX)
                if ($this->isValidDocumentFile($file)) {

                    // Mengunggah file DOCX ke penyimpanan publik
                    $uploadPath = $file->storeAs('dokumen/keluar', $file_name, 'public');

                    // Mengonversi file DOCX yang diunggah ke PDF
                    $pdfFileName = $this->convertDocxToPdf(storage_path("app/public/" . $uploadPath), storage_path('app/public/dokumen/keluar'));

                    // Menghapus file DOCX yang diunggah
                    Storage::disk('public')->delete($uploadPath);

                    // Mengompres dan mengoptimalkan file PDF yang telah dikonversi
                    $pdfCompress = $this->compressAndOptimizePdf(storage_path('app/public/dokumen/keluar/' . $pdfFileName), storage_path('app/public/dokumen/keluar'));

                    // Menghapus file PDF yang telah dikonversi
                    Storage::disk('public')->delete('dokumen/keluar/' . $pdfFileName);

                    // Mengatur field 'lampiran' dalam array data ke nama file PDF yang telah dikompres dan dioptimalkan
                    $data['lampiran'] = "dokumen/keluar/" . pathinfo($pdfCompress, PATHINFO_FILENAME) . '.pdf';
                } else if ($file->getClientOriginalExtension() == 'pdf') {
                    // Mengunggah file PDF ke penyimpanan publik
                    $uploadPath = $file->storeAs('dokumen/keluar', $file_name, 'public');

                    // Mengompres dan mengoptimalkan file PDF yang diunggah
                    $pdfCompress = $this->compressAndOptimizePdf(storage_path('app/public/' . $uploadPath), storage_path('app/public/dokumen/keluar'));

                    // Menghapus file PDF yang diunggah
                    Storage::disk('public')->delete($uploadPath);

                    // Mengatur field 'lampiran' dalam array data ke nama file PDF yang telah dikompres dan dioptimalkan
                    $data['lampiran'] = "dokumen/keluar/" . pathinfo($pdfCompress, PATHINFO_FILENAME) . '.pdf';
                } else {
                    // Mengembalikan redirect dengan pesan kesalahan
                    return redirect()->back()->with('error', 'File yang diunggah harus berupa file dokumen (DOC, DOCX, atau PDF)!')->withInput();
                }
            } else {
                // Mengembalikan redirect dengan pesan kesalahan
                return redirect()->back()->with('error', 'File dokumen harus diunggah!')->withInput();
            }
            // Membuat record 'DokumenKeluar' baru di database dengan array data
            DokumenKeluar::create($data);
        }


        // Redirect ke route 'admin.tambah_dokumen' dengan pesan sukses
        return redirect()->route('admin.tambah_dokumen')->with('pesan', 'Data berhasil di simpan!');
    }

    /**
     * Mengonversi file DOCX ke PDF menggunakan LibreOffice.
     *
     * @param string $docxFilePath Path dari file DOCX yang akan dikonversi.
     * @param string $outputDir Direktori tempat file PDF yang dikonversi akan disimpan.
     * @return string|int Nama file PDF yang dikonversi jika konversi berhasil, jika tidak maka kode error.
     */
    private function convertDocxToPdf($docxFilePath, $outputDir) {
        // Memastikan direktori output ada
        if (!is_dir($outputDir)) {
            mkdir($outputDir, 0777, true);
        }

        // Mendefinisikan path file output
        $pdfFilePath = $outputDir . '/' . pathinfo($docxFilePath, PATHINFO_FILENAME) . '.pdf';

        $pdfFileName = pathinfo($docxFilePath, PATHINFO_FILENAME) . '.pdf';

        // Perintah untuk mengonversi DOCX ke PDF menggunakan LibreOffice
        $command = 'soffice --headless --convert-to pdf ' . escapeshellarg($docxFilePath) . ' --outdir ' . escapeshellarg($outputDir);

        // Menjalankan perintah
        exec($command, $output, $res);

        // Memeriksa apakah konversi berhasil
        if ($res == 0) {
            return $pdfFileName;
        } else {
            return $res;
        }

    }

    /**
     * Memeriksa apakah file dokumen valid.
     *
     * @param  \Illuminate\Http\UploadedFile  $file
     * @return bool
     */
    private function isValidDocumentFile($file) {
        $validExtensions = ['doc', 'docx'];

        $extension = $file->getClientOriginalExtension();

        return in_array($extension, $validExtensions);
    }

    /**
     * Mengompres dan mengoptimalkan file PDF menggunakan Ghostscript.
     *
     * @param string $pdfFilePath Path dari file PDF yang akan dikompres dan dioptimalkan.
     * @param string $outputDir Direktori tempat file PDF yang dikompres dan dioptimalkan akan disimpan.
     * @return string Path dari file PDF yang dikompres dan dioptimalkan.
     */
    private function compressAndOptimizePdf($pdfFilePath, $outputDir) {
        // Memastikan direktori output ada
        if (!is_dir($outputDir)) {
            mkdir($outputDir, 0777, true);
        }

        // Mendefinisikan path file output
        $compressedPdfFilePath = $outputDir . '/' . pathinfo($pdfFilePath, PATHINFO_FILENAME) . '_compressed.pdf';

        // Perintah untuk mengompres dan mengoptimalkan PDF menggunakan Ghostscript
        $command = 'gswin64c -sDEVICE=pdfwrite -dPDFSETTINGS=/screen -dNOPAUSE -dQUIET -dBATCH -sOutputFile=' . escapeshellarg($compressedPdfFilePath) . ' ' . escapeshellarg($pdfFilePath) . ' 2>&1';

        // Menjalankan perintah
        exec($command, $output, $res);

        // Memeriksa apakah kompresi dan optimasi berhasil
        if ($res == 0) {
            return $compressedPdfFilePath;
        } else {
            return $res;
        }
    }
}
