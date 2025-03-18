@extends('layout.index')
@section('title', 'Kelola Instansi')
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
                            <i class="fas fa-building" style="margin-right: 10px; font-size: 28px;"></i>
                            TABEL INSTANSI
                        </h2>
                    </div>
                    <div class="d-flex">
                        <a href="/admin/kelola_instansi">
                            <button type="button" class="my-2 btn btn-dark btn-icon-text">
                                <i class="fe fe-arrow-left"></i>
                                Kembali</button>
                        </a>
                    </div>
                </div>
            </div>
            <!-- End Page Header -->

            <!-- Row -->
            <div class="card custom-card">
                <div class="card-header">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table text-wrap table-bordered" id="instansi-table" style="width: 100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Instansi</th>
                                        <th>Singkatan</th>
                                        <th>Alamat</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($instansi as $data)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $data->nama_instansi }}</td>
                                            <td>{{ $data->singkatan_instansi }}</td>
                                            <td class="text-wrap">{{ $data->alamat }}</td>
                                            <td>
                                                <button class="btn btn-sm btn-info"
                                                    onclick="showRestore({{ $data->id }}, '{{ $data->nama_instansi }}')">
                                                    <i class="fa fa-undo"></i>
                                                </button>
                                                <button class="btn btn-sm btn-danger"
                                                    onclick="showDelete({{ $data->id }}, '{{ $data->nama_instansi }}')">
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

@endsection

@push('scripts')
    <script type="module">
        $('#instansi-table').DataTable({
            "responsive": true,
            "autowidth": true,
        });
    </script>

    <script>
        function showDelete(id, nama_instansi) {
            Swal.fire({
                title: "Apakah Anda yakin?",
                text: "Menghapus Data" + " " + nama_instansi + " " + "akan menghapus data yang bersangkutan",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya",
                backdrop: true, // Mengaktifkan backdrop
                allowOutsideClick: false // Mencegah penutupan jika klik di luar modal
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "{{ url('/admin/kelola_instansi/sampah/delete/') }}/" + id;
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

        function showRestore(id, nama_instansi) {
            Swal.fire({
                title: "Apakah Anda yakin?",
                text: "Mengembalikan Data" + " " + nama_instansi + " " +
                    "akan mengembalikan data yang bersangkutan",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya",
                backdrop: true, // Mengaktifkan backdrop
                allowOutsideClick: false // Mencegah penutupan jika klik di luar modal
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "{{ url('/admin/kelola_instansi/sampah/restore/') }}/" + id;
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
