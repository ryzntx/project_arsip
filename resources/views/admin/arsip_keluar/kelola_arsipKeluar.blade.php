@extends('layout.index')
@section('title', 'Sekretaris')
@section('content')

    <div class="main-content side-content pt-0">

        <div class="main-container container-fluid">
            <div class="inner-body">

                <!-- Page Header -->
                <div class="page-header">
                    <div>
                        <h2 class="main-content-title tx-24 mg-b-5">DAFTAR DOKUMEN KELUAR</h2>
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
                                        <label class="main-content-label my-auto pt-2">ARSIP DOKUMEN KELUAR</label>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table mb-0" id="dokumenKeluar-tabel" style="width: 100%">
                                        <thead>
                                            <tr class="border-bottom" style="text-align: center;">
                                                <th>No</th>
                                                <th>Nama Dokumen</th>
                                                <th>Dinas</th>
                                                <th>Kategori</th>
                                                <th>Tanggal</th>
                                                <th>Bukti Diterima</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($arsip_keluar as $item)
                                                <tr style="text-align: center;">
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td class="text-wrap"
                                                        onclick="showDetails('{{ $item->dokumen_kategori->nama_kategori }}','{{ $item->nama_dokumen }}', '{{ $item->pengirim }}', '{{ $item->penerima }}', '{{ $item->instansi->nama_instansi }}', '{{ $item->tanggal_keluar }}', '{{ $item->lampiran }}')">
                                                        {{ $item->nama_dokumen }}</td>
                                                    <td>{{ $item->instansi->singkatan_instansi }}</td>
                                                    <td>{{ $item->dokumen_kategori->nama_kategori }}</td>
                                                    <td>{{ $item->tanggal_keluar }}</td>
                                                    <td>
                                                        <a href="#" class="btn btn-warning btn-sm" id="BuktiTerima"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#tambahBuktiterima{{ $item->id }}">
                                                            Bukti Terima</a>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex justify-content-center gap-1">
                                                            <div class="dropdown shadow-sm">
                                                                <a class="btn btn-info btn-sm dropdown-toggle"
                                                                    href="#" role="button" data-bs-toggle="dropdown"
                                                                    aria-expanded="false">
                                                                    Status
                                                                </a>
                                                                <ul
                                                                    class="dropdown-menu text-center align-middle shadow-sm rounded-5">
                                                                    <p>{{ $item->status }}</p>
                                                                </ul>
                                                            </div>
                                                            <a href="{{ route('admin.arsip_keluar.print', $item->id) }}"
                                                                target="_blank" class="btn btn-primary btn-sm">Cetak</a>
                                                            <a href="{{ route('admin.arsip_keluar.edit', $item->id) }}"
                                                                class="btn btn-warning btn-sm"><i
                                                                    class="fe fe-edit"></i></a>
                                                            <a href="{{ route('admin.arsip_keluar.delete', $item->id) }}"
                                                                class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                                                data-bs-target="#delete{{ $item->id }}">
                                                                <i class="fe fe-trash"></i>
                                                            </a>
                                                        </div>
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

            @foreach ($arsip_keluar as $item)
                <div class="modal modal-danger fade" id="delete{{ $item->id }}">
                    <div class="modal-dialog modal-l">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">{{ $item->nama_dokumen }}</h4>
                            </div>
                            <div class="modal-body">
                                <p>Apakah anda yakin ingin menghapus data ini?</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline btn-primary pull-left"
                                    data-bs-dismiss="modal">No</button>
                                <a href="{{ url('/admin/arsip_keluar/delete/' . $item->id) }}"
                                    class="btn btn-outline btn-danger">Yes</a>
                            </div>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            @endforeach
        </div>
    </div>

    @foreach ($arsip_keluar as $item)
        <!-- Modal Tambah Bukti-->
        <div class="modal fade" id="tambahBuktiterima{{ $item->id }}" tabindex="-1"
            aria-labelledby="tambahBuktiTerimaModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-l">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="tambahBuktiterima">Bukti Dikirmkan / Terima</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ url('/admin/arsip_keluar/tambah_bukti/' . $item->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf <!-- Pastikan untuk menyertakan token CSRF -->
                            <div class="row">
                                <div class="col-12">
                                    @if ($item->bukti_dikirimkan == null)
                                        <div class="form-group">
                                            <label for="foto_bukti" class="form-label">Lampiran Bukti Terima</label>
                                            <input type="file" class="form-control" id="foto_bukti" name="foto_bukti"
                                                required>
                                        </div>
                                    @else
                                        <img src={{ asset('storage/' . $item->bukti_dikirimkan) }} class="img-thumbnail" />
                                    @endif

                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                @if ($item->bukti_dikirimkan == null)
                                    <button type="submit" class="btn btn-outline btn-danger">Tambah</button>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach


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
                                <input type="text" name="nama_dokumen" id="nama_dokumen" class="form-control"
                                    readonly>
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
                                <label for="tanggal_keluar" class="form-label">Tanggal</label>
                                <input type="text" name="tanggal_keluar" id="tanggal_keluar" class="form-control"
                                    readonly>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="pdf-viewer-container">
                                <iframe id="pdf-viewer" src="" width="100%" height="500px"
                                    style="border: none;" allowfullscreen webkitallowfullscreen></iframe>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a id="btnDownloadPDF" href="" target="_blank" class="btn btn-danger"><i
                            class="fa fa-file-download me-2"></i>Unduh PDF</a>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function showDetails(kategori_dokumen, nama_dokumen, penerima, pengirim, dinas, tanggal, pdfUrl) {
            // kita siapin dulu nih variabel nya
            var tabel = document.getElementById(
                'dokumenKeluar-tabel'); // buat dapetin element dengan dokumenMasuk-tabel
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
                document.querySelectorAll('#dokumenKeluar-tabel tbody tr.selected').forEach(function(row) {
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
            document.getElementById('tanggal_keluar').value = tanggal;


            // Menampilkan PDF di iframe
            var viewer = document.getElementById('pdf-viewer');
            viewer.src = "{{ asset('/laraview/#../storage/') }}/" + pdfUrl;

            // udah deh segitu aja
        }
    </script>
    <script type="module">
        $('#dokumenKeluar-tabel').DataTable({
            "responsive": true,
            "autoWidth": true,
        });
    </script>
@endsection
