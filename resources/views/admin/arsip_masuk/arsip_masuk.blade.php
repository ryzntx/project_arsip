@extends('layout.index')
@section('title', 'Sekretaris')
@section('content')

<div class="main-content side-content pt-0">

    <div class="main-container container-fluid">
        <div class="inner-body">

            <!-- Page Header -->
            <div class="page-header">
                <div>
                    <h2 class="main-content-title tx-24 mg-b-5">DAFTAR DOKUMEN MASUK</h2>
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
                                    <label class="main-content-label my-auto pt-2">ARSIP DOKUMEN MASUK</label>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row table-filter">
                                <div class="col-lg-3">
                                    <div class="show-entries d-flex align-items-center">
                                        <span class="me-2">Lihat</span>
                                        <!-- Menambahkan margin kanan untuk mengatur spasi -->
                                        <select class="form-control select2 wd-50">
                                            <option>5</option>
                                            <option>10</option>
                                            <option>15</option>
                                            <option>20</option>
                                        </select>
                                        <span class="ms-2">baris</span>
                                        <!-- Menambahkan margin kiri untuk memisahkan dari dropdown -->
                                    </div>
                                </div>

                                <div class="col-lg-9 d-lg-flex justify-content-end">
                                    <div class="d-flex mt-4 me-4 mt-lg-0">
                                        <div class="filter-group">
                                            <input type="text" class="form-control rounded-end-0"
                                                placeholder="Cari dokumen...">

                                            <button type="button" class="btn btn-primary"><i
                                                    class="fa fa-search"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="table-responsive border border-bottom-0">

                                <div class="list-group">
                                    <table class="table mb-0 text-nowrap text-md-nowrap">

                                    </table>
                                </div>


                                <div class="table-responsive border border-bottom-0">
                                    <table class="table mb-0 text-nowrap text-md-nowrap" id="dokumenMasuk-tabel">
                                        <thead>
                                            <tr class="border-bottom">
                                                <th style="text-align: center;">No</th>
                                                <th style="text-align: center;">Dinas</th>
                                                <th style="text-align: center;">Kategori</th>
                                                <th style="text-align: center;">Nama Dokumen</th>
                                                <th style="text-align: center;">Tanggal</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data as $item)
                                            <tr
                                                onclick="showDetails('{{ $item->dokumen_kategori->nama_kategori }}','{{ $item->nama_dokumen }}', '{{ $item->pengirim }}', '{{ $item->penerima }}', '{{ $item->instansi->nama_instansi }}', '{{ $item->tanggal_masuk }}', '{{ $item->lampiran }}')">
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->instansi->nama_instansi }}</td>
                                                <td>{{ $item->dokumen_kategori->nama_kategori }}</td>
                                                <td>{{ $item->nama_dokumen }}</td>
                                                <td>{{ $item->tanggal_masuk }}</td>
                                            </tr>
                                            @endforeach

                                            {{-- <tr class="border-bottom" onclick="showDetails('BARANG HILANG MENGGUNAKAN METODE PROFILE MATCHING', 'Penerima 1', '00', 'path/to/document1.pdf')">
                                                <td class="font-weight-semibold d-flex">
                                                    <span class="my-auto me-4 mt-1 star-icon" onclick="toggleStar(this)">
                                                        <!-- Menggunakan icon bintang dari Typicons -->
                                                        <i class="typcn typcn-star-outline fa-sm" aria-hidden="true"></i> <!-- Icon bintang outline (tidak terisi) -->
                                                    </span>
                                                </td>                                                <td>KEMENDIKBUD</td>
                                                <td>BARANG HILANG MENGGUNAKAN METODE PROFILE MATCHING</td>
                                                <td>27/09/2024</td>
                                            </tr> --}}
                                            {{-- <tr class="border-bottom" onclick="showDetails('Pengirim 2', 'Penerima 2', 'Isi dokumen 2', 'path/to/document2.pdf')">
                                                <th scope="row">#</th>
                                                <td>KEMENDIKBUD</td>
                                                <td>NIOOLLL</td>
                                                <td>28/09/2024</td>
                                            </tr> --}}
                                            <!-- Tambah row dokumen lain di sini -->


                                            {{-- <td>
                                                <div class="button-list">
                                                    <a href="#" class="btn"><i class="ti ti-files"></i></a>
                                                    <a href="#" class="btn"><i class="ti ti-pencil"></i></a>
                                                    <a href="#" class="btn"><i class="ti ti-trash"></i></a>
                                                </div>
                                            </td> --}}
                                        </tbody>
                                    </table>
                                </div>
                                <nav class="mt-3">
                                    <ul class="pagination justify-content-end">
                                        <li class="page-item disabled"><a class="page-link" href="#">Prev</a></li>
                                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                                        <li class="page-item"><a class="page-link" href="#">4</a></li>
                                        <li class="page-item"><a class="page-link" href="#">5</a></li>
                                        <li class="page-item"><a class="page-link" href="#">Next</a></li>
                                    </ul>
                                </nav>
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
                <a id="btnDownloadPDF" href="" target="_blank" class="btn btn-danger"><i class="fa fa-file-download me-2"></i>Unduh PDF</a>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fa fa-x me-2"></i>Tutup</button>
            </div>
        </div>
    </div>
</div>

<script>
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
            document.querySelectorAll('#dokumenMasuk-tabel tbody tr.selected').forEach(function (row) {
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
