@extends('layout.index')
@section('title', 'Pimpinan')
@section('content')

<div class="main-content side-content pt-0">
    @if (session('pesan'))
    <div class="alert alert-primary">
        {{ session('pesan') }}
    </div>
    @endif
    @if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif
    <div class="main-container container-fluid">
        <div class="inner-body">

            <!-- Page Header -->
            <div class="page-header text-center" style="margin-bottom: 20px;">
                <div>
                    <h2 class="main-content-label tx-24 mg-b-5"
                        style="color: darkslateblue; font-weight: bold; text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.3);">
                        <i class="fas fa-folder-open" style="margin-right: 10px; font-size: 28px;"></i>
                        ARSIP DOKUMEN
                    </h2>
                </div>
            </div>
            <!-- End Page Header -->

            <!-- Row -->
            <div class="row row-sm">
                <!-- Left Panel (Daftar Dokumen) -->
                <div class="col-md-12" id="left-panel">
                    <div class="card custom-card">
                        <div class="card-header  border-bottom-0 pb-0">
                            <div>
                                <div class="d-flex">
                                    <label class="main-content-label my-auto pt-2">DOKUMEN MASUK</label>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table mb-0" id="dokumenMasuk-tabel" style="width: 100%">
                                    <thead>
                                        <tr class="border-bottom" style="text-align: center;">
                                            <th>No</th>
                                            <th>Nama Dokumen</th>
                                            <th>Dinas</th>
                                            <th>Kategori</th>
                                            <th>Tanggal</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($arsip_masuk as $item)
                                        <tr style="text-align: center;">
                                            <td>{{ $loop->iteration }}</td>
                                            <td class="text-wrap"
                                                onclick="showDetails('{{ $item->dokumen_kategori->nama_kategori }}','{{ $item->nama_dokumen }}', '{{ $item->pengirim }}', '{{ $item->penerima }}', '{{ $item->instansi->nama_instansi }}', '{{ $item->tanggal_keluar }}', '{{ $item->lampiran }}')">
                                                {{ $item->nama_dokumen }}</td>
                                            <td>{{ $item->instansi->singkatan_instansi }}</td>
                                            <td>{{ $item->dokumen_kategori->nama_kategori }}</td>
                                            <td>{{ $item->tanggal_masuk }}</td>
                                            <td class="d-flex justify-content-center gap-1">
                                                <a href="{{ route('pimpinan.arsipMasuk.print', $item->id) }}"
                                                    target="_blank" class="btn btn-primary btn-sm">Cetak</a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Row -->
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="lihatPDF" tabindex="-1" aria-labelledby="lihatPDFLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="lihatPDFLabel">Detail Dokumen</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Add your modal content here -->
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="kategori_dokumen" class="form-label">Kategori Dokumen</label>
                            <input type="text" name="kategori_dokumen" id="kategori_dokumen" class="form-control"
                                readonly>
                        </div>
                        <div class="form-group">
                            <label for="nama_dokumen" class="form-label">Nama Dokumen</label>
                            <input type="text" name="nama_dokumen" id="nama_dokumen" class="form-control" readonly>
                        </div>
                        <div class="form-group">
                            <label for="pengirim" class="form-label">Pengirim</label>
                            <input type="text" name="pengirim" id="pengirim" class="form-control" readonly>
                        </div>
                        <div class="form-group">
                            <label for="penerima" class="form-label">Penerima</label>
                            <input type="text" name="penerima" id="penerima" class="form-control" readonly>
                        </div>
                        <div class="form-group">
                            <label for="dinas" class="form-label">Dinas</label>
                            <input type="text" name="dinas" id="dinas" class="form-control" readonly>
                        </div>
                        <div class="form-group">
                            <label for="tanggal_masuk" class="form-label">Tanggal</label>
                            <input type="text" name="tanggal_masuk" id="tanggal_masuk" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="pdf-viewer-container">
                            <iframe id="pdf-viewer" src="" width="100%" height="500px" style="border: none;"
                                allowfullscreen webkitallowfullscreen></iframe>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a id="btnDownloadPDF" href="" target="_blank" class="btn btn-danger"><i
                        class="fa fa-file-download me-2"></i>Unduh PDF</a>
            </div>
        </div>
    </div>
</div>

<script>
$('#dokumenMasuk-tabel').DataTable({
    "responsive": true,
    "autowidth": true,
});

function showDetails(kategori_dokumen, nama_dokumen, penerima, pengirim, dinas, tanggal, pdfUrl) {
    // kita siapin dulu nih variabel nya
    var tabel = document.getElementById(
        'dokumenMasuk-tabel'); // buat dapetin element dengan dokumenMasuk-tabel
    var modal = new bootstrap.Modal(document.getElementById('lihatPDF'));

    // Fungsi untuk menampilkan/menutup right-panel
    // Kita cek dulu nih di element dengan id dokumenMasuk-tabel itu ada class selected ga?
    if (tabel.classList.contains('selected')) {
        // Toggle modal to show
        modal.hide();
        // Kalau ada kita hapus dulu
        tabel.classList.remove('selected');
    } else {
        modal.show();
        // Kalau tidak ada, kita cek lagi di element id dokumenMasuk-tabel itu ada gasih class selected?
        // tapi dengan cara kita cek di setiap baris tabel nya
        document.querySelectorAll('#dokumenMasuk-tabel tbody tr.selected').forEach(function(row) {
            // kalau di setiap baris tabel itu ada class selected, maka kita hapus class nya
            row.classList.remove('selected');
        });
        // trus tambahin lagi class selected nya deh
        // loh buat kenapa di tambahin lagi? biar nanti ketika baris data lain di klik itu, tetep muncul right-panel nya
        tabel.classList.add('selected');

    }

    // trus kita tampilin deh data nya ke right-panel
    document.getElementById('kategori_dokumen').value = kategori_dokumen;
    document.getElementById('nama_dokumen').value = nama_dokumen;
    document.getElementById('penerima').value = penerima;
    document.getElementById('pengirim').value = pengirim;
    document.getElementById('dinas').value = dinas;
    document.getElementById('tanggal_masuk').value = tanggal;

    // Menampilkan PDF di iframe
    var viewer = document.getElementById('pdf-viewer');
    viewer.src = "{{ asset('/laraview/#../storage/') }}/" + pdfUrl;

    // Set href for download button
    var downloadBtn = document.getElementById('btnDownloadPDF');
    downloadBtn.href = "/storage/" + pdfUrl;

    // udah deh segitu aja
}
</script>

@endsection