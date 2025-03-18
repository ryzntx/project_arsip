@extends('layout.index')
@section('title', 'Kelola Sampah Kategori')
@section('content')

    <div class="pt-0 main-content side-content">

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
                <div class="text-center page-header" style="margin-bottom: 20px;">
                    <div>
                        <h2 class="main-content-label tx-24 mg-b-5"
                            style="color: darkslateblue; font-weight: bold; text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.3);">
                            <i class="fe fe-bookmark" style="margin-right: 10px; font-size: 28px;"></i>
                            TABEL KATEGORI DOKUMEN
                        </h2>
                    </div>
                    <div class="d-flex">
                        <a href="/admin/kelola_kategori" class="btn btn-dark">
                            <i class="fa fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>
            </div>
            <!-- End Page Header -->

            <!-- Row -->
            <div class="row row-sm">
                <div class="col-md-12">
                    <div class="card custom-card">
                        <div class="pb-0 card-header border-bottom-0">
                            <div>
                                <div class="d-flex">
                                    <label class="pt-2 my-auto main-content-label">SAMPAH
                                        KATEGORI DOKUMEN
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table text-center text-wrap table-bordered" id="kategori-table"
                                    style="width: 100%">
                                    <thead>
                                        <tr>
                                            <th class="w-auto">No</th>
                                            <th>Nama Kategori</th>
                                            <th>Nomor Surat</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($kategori as $data)
                                            <tr style="text-align: center;">
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $data->nama_kategori }}</td>
                                                <td>{{ $data->nomor_surat }}</td>
                                                <td>
                                                    <button class="btn btn-sm btn-info"
                                                        onclick="showRestore({{ $data->id }}, '{{ $data->nama_kategori }}')">
                                                        <i class="fa fa-undo"></i>
                                                    </button>
                                                    <button class="btn btn-sm btn-danger"
                                                        onclick="showDelete({{ $data->id }}, '{{ $data->nama_kategori }}')">
                                                        <i class="fe fe-trash"></i>
                                                    </button>
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
        </div>
    </div>

@endsection

@push('scripts')
    <script type="module">
        $('#kategori-table').DataTable({
            "responsive": true,
            "autowidth": true,
        });
    </script>
    <script>
        function showDelete(id, nama_kategori) {
            Swal.fire({
                title: "Apakah Anda yakin?",
                text: "Menghapus Data" + " " + nama_kategori + " " + "secara permanen",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya",
                backdrop: true, // Mengaktifkan backdrop
                allowOutsideClick: false // Mencegah penutupan jika klik di luar modal
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "{{ url('/admin/kelola_kategori/sampah/delete/') }}/" + id;
                    Swal.fire({
                        title: "Hapus Data!",
                        text: "Data berhasil dihapus",
                        icon: "success",
                        timer: 1500, // Menampilkan pesan selama 1.5 detik
                        showConfirmButton: false // Sembunyikan tombol konfirmasi
                    });
                }
            });
        }

        function showRestore(id, nama_kategori) {
            Swal.fire({
                title: "Apakah Anda yakin?",
                text: "Mengembalikan Data" + " " + nama_kategori + " " + "ke dalam kategori",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya",
                backdrop: true, // Mengaktifkan backdrop
                allowOutsideClick: false // Mencegah penutupan jika klik di luar modal
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "{{ url('/admin/kelola_kategori/sampah/restore/') }}/" + id;
                    Swal.fire({
                        title: "Kembalikan Data!",
                        text: "Data berhasil dikembalikan",
                        icon: "success",
                        timer: 1500, // Menampilkan pesan selama 1.5 detik
                        showConfirmButton: false // Sembunyikan tombol konfirmasi
                    });
                }
            });
        }
    </script>
@endpush
