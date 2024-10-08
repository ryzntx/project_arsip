<?php

namespace App\Http\Controllers;

use App\Models\DokumenKategori;
use App\Models\DokumenKeluar;
use App\Models\DokumenMasuk;
use App\Models\Instansi;
use DateTime;
use DateTimeZone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TambahDokumenController extends Controller {
    /**
     * Display a listing of the resource.
     */
    public function index() {
        $instansi = Instansi::all();
        $kategori = DokumenKategori::all();
        return view('admin.tambah_dokumen.add_dokumen', compact('instansi', 'kategori'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {

        // Get the current date and time in the Asia/Jakarta timezone
        $dateTime = new DateTime('now', new DateTimeZone('Asia/Jakarta'));
        $dtFormat = $dateTime->format('dmY_His');

        // Get the value of the 'jenis_dokumen' field from the request
        $jenis = $request->jenis_dokumen;

        // Check if the selected jenis is 'dokumen_masuk'
        if ($jenis == 'dokumen_masuk') {
            // Create an array with the data to be stored in the database for 'dokumen_masuk'
            $data = [
                'no_dokumen' => $request->no_dokumen,
                'nama_dokumen' => $request->nama_dokumen,
                'penerima' => $request->nama_penerima,
                'pengirim' => $request->nama_pengirim,
                'tanggal_masuk' => $request->tanggal_masuk,
                'keterangan' => $request->keterangan,
                'instansi_id' => $request->dinas_id,
                'dokumen_kategori_id' => $request->kategori_id,
                'user_id' => auth()->user()->id,
            ];

            // Check if a file is uploaded and it is a valid document file
            if ($request->hasFile('file_dokumen') && $request->file('file_dokumen')->isValid()) {
                $file = $request->file('file_dokumen');
                $original_name = $file->getClientOriginalName();
                $file_name = $dtFormat . '_' . $original_name;

                // Check if the uploaded file is a valid document file (DOC or DOCX)
                if ($this->isValidDocumentFile($file)) {

                    // Upload the DOCX file to the public storage
                    $uploadPath = $file->storeAs('dokumen/masuk', $file_name, 'public');

                    // Convert the uploaded DOCX file to PDF
                    $pdfFileName = $this->convertDocxToPdf(storage_path("app/public/" . $uploadPath), storage_path('app/public/dokumen/masuk'));

                    // Delete the uploaded DOCX file
                    Storage::disk('public')->delete($uploadPath);

                    // Compress and optimize the converted PDF file
                    $pdfCompress = $this->compressAndOptimizePdf(storage_path('app/public/dokumen/masuk/' . $pdfFileName), storage_path('app/public/dokumen/masuk'));

                    // Delete the converted PDF file
                    Storage::disk('public')->delete('dokumen/masuk/' . $pdfFileName);

                    // Set the 'lampiran' field in the data array to the compressed and optimized PDF file name
                    $data['lampiran'] = "dokumen/masuk/" . pathinfo($pdfCompress, PATHINFO_FILENAME) . '.pdf';
                } else if ($file->getClientOriginalExtension() == 'pdf') {
                    // Upload the PDF file to the public storage
                    $uploadPath = $file->storeAs('dokumen/masuk', $file_name, 'public');

                    // Compress and optimize the uploaded PDF file
                    $pdfCompress = $this->compressAndOptimizePdf(storage_path('app/public/' . $uploadPath), storage_path('app/public/dokumen/masuk'));

                    // Delete the uploaded PDF file
                    Storage::disk('public')->delete($uploadPath);

                    // Set the 'lampiran' field in the data array to the compressed and optimized PDF file name
                    $data['lampiran'] = "dokumen/masuk/" . pathinfo($pdfCompress, PATHINFO_FILENAME) . '.pdf';
                } else {
                    // Return redirect back with an error message
                    return redirect()->back()->with('error', 'File yang diunggah harus berupa file dokumen (DOC, DOCX, atau PDF)!')->withInput();
                }
            } else {
                // Return redirect back with an error message
                return redirect()->back()->with('error', 'File dokumen harus diunggah!')->withInput();
            }
            // Create a new 'DokumenMasuk' record in the database with the data array
            DokumenMasuk::create($data);

        } elseif ($jenis == 'dokumen_keluar') {
            // Create an array with the data to be stored in the database for 'dokumen_keluar'
            $data = [
                'no_dokumen' => $request->no_dokumen ?? '',
                'nama_dokumen' => $request->nama_dokumen,
                'penerima' => $request->nama_penerima,
                'pengirim' => $request->nama_pengirim,
                'tanggal_keluar' => $request->tanggal_masuk,
                'instansi_id' => $request->dinas_id,
                'dokumen_kategori_id' => $request->kategori_id,
                'user_id' => auth()->user()->id,
            ];

            // Check if a file is uploaded and it is a valid document file
            if ($request->hasFile('file_dokumen') && $request->file('file_dokumen')->isValid()) {
                $file = $request->file('file_dokumen');
                $original_name = $file->getClientOriginalName();
                $file_name = $dtFormat . '_' . $original_name;

                // Check if the uploaded file is a valid document file (DOC or DOCX)
                if ($this->isValidDocumentFile($file)) {

                    // Upload the DOCX file to the public storage
                    $uploadPath = $file->storeAs('dokumen/keluar', $file_name, 'public');

                    // Convert the uploaded DOCX file to PDF
                    $pdfFileName = $this->convertDocxToPdf(storage_path("app/public/" . $uploadPath), storage_path('app/public/dokumen/keluar'));

                    // Delete the uploaded DOCX file
                    Storage::disk('public')->delete($uploadPath);

                    // Compress and optimize the converted PDF file
                    $pdfCompress = $this->compressAndOptimizePdf(storage_path('app/public/dokumen/keluar/' . $pdfFileName), storage_path('app/public/dokumen/keluar'));

                    // Delete the converted PDF file
                    Storage::disk('public')->delete('dokumen/keluar/' . $pdfFileName);

                    // Set the 'lampiran' field in the data array to the compressed and optimized PDF file name
                    $data['lampiran'] = "dokumen/keluar/" . pathinfo($pdfCompress, PATHINFO_FILENAME) . '.pdf';
                } else if ($file->getClientOriginalExtension() == 'pdf') {
                    // Upload the PDF file to the public storage
                    $uploadPath = $file->storeAs('dokumen/keluar', $file_name, 'public');

                    // Compress and optimize the uploaded PDF file
                    $pdfCompress = $this->compressAndOptimizePdf(storage_path('app/public/' . $uploadPath), storage_path('app/public/dokumen/keluar'));

                    // Delete the uploaded PDF file
                    Storage::disk('public')->delete($uploadPath);

                    // Set the 'lampiran' field in the data array to the compressed and optimized PDF file name
                    $data['lampiran'] = "dokumen/keluar/" . pathinfo($pdfCompress, PATHINFO_FILENAME) . '.pdf';
                } else {
                    // Return redirect back with an error message
                    return redirect()->back()->with('error', 'File yang diunggah harus berupa file dokumen (DOC, DOCX, atau PDF)!')->withInput();
                }
            } else {
                // Return redirect back with an error message
                return redirect()->back()->with('error', 'File dokumen harus diunggah!')->withInput();
            }
            // Create a new 'DokumenKeluar' record in the database with the data array
            DokumenKeluar::create($data);
        }

        // Redirect to the 'admin.tambah_dokumen' route with a success message
        return redirect()->route('admin.tambah_dokumen')->with('pesan', 'Data berhasil di simpan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id) {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id) {
        //
    }

    /**
     * Converts a DOCX file to PDF using LibreOffice.
     *
     * @param string $docxFilePath The path of the DOCX file to be converted.
     * @param string $outputDir The directory where the converted PDF file will be saved.
     * @return string|int The name of the converted PDF file if the conversion was successful, otherwise the error code.
     */
    private function convertDocxToPdf($docxFilePath, $outputDir) {
        // Ensure the output directory exists
        if (!is_dir($outputDir)) {
            mkdir($outputDir, 0777, true);
        }

        // Define the output file path
        $pdfFilePath = $outputDir . '/' . pathinfo($docxFilePath, PATHINFO_FILENAME) . '.pdf';

        $pdfFileName = pathinfo($docxFilePath, PATHINFO_FILENAME) . '.pdf';

        // Command to convert DOCX to PDF using LibreOffice
        $command = 'soffice --headless --convert-to pdf ' . escapeshellarg($docxFilePath) . ' --outdir ' . escapeshellarg($outputDir);

        // Execute the command
        exec($command, $output, $res);

        // Check if the conversion was successful
        if ($res == 0) {
            return $pdfFileName;
        } else {
            return $res;
        }

    }

    /**
     * Check if the document file is valid.
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
     * Compress and optimize a PDF file using Ghostscript.
     *
     * @param string $pdfFilePath The path of the PDF file to be compressed and optimized.
     * @param string $outputDir The directory where the compressed and optimized PDF file will be saved.
     * @return string The path of the compressed and optimized PDF file.
     */
    private function compressAndOptimizePdf($pdfFilePath, $outputDir) {
        // Ensure the output directory exists
        if (!is_dir($outputDir)) {
            mkdir($outputDir, 0777, true);
        }

        // Define the output file path
        $compressedPdfFilePath = $outputDir . '/' . pathinfo($pdfFilePath, PATHINFO_FILENAME) . '_compressed.pdf';

        // Command to compress and optimize PDF using Ghostscript
        $command = 'gswin64c -sDEVICE=pdfwrite -dPDFSETTINGS=/screen -dNOPAUSE -dQUIET -dBATCH -sOutputFile=' . escapeshellarg($compressedPdfFilePath) . ' ' . escapeshellarg($pdfFilePath) . ' 2>&1';

        // Execute the command
        exec($command, $output, $res);

        // Check if the compression and optimization was successful
        if ($res == 0) {
            return $compressedPdfFilePath;
        } else {
            return $res;
        }
    }
}