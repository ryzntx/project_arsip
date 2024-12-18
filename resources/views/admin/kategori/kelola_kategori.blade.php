@extends('layout.index')
@section('title', 'Kelola Kategori')
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
                        <i class="fe fe-bookmark" style="margin-right: 10px; font-size: 28px;"></i>
                        TABEL KATEGORI DOKUMEN
                    </h2>
                </div>
                <div class="d-flex">
                    <a href="/admin/kelola_kategori/add">
                        <button type="button" class="btn btn-primary my-2 btn-icon-text">
                            <i class="fe fe-plus"></i>
                            Tambah Kategori</button>
                    </a>
                </div>
            </div>
        </div>
        <!-- End Page Header -->

        <!-- Row -->
        <div class="row row-sm">
            <div class="col-md-12">
                <div class="card custom-card">
                    <div class="card-header">
                        <div class="card-body">
                            <div class="table-responsive border">
                                <table class="table text-nowrap text-md-nowrap mg-b-0">
                                    <thead>
                                        <tr style="text-align: center;">
                                            <th>No</th>
                                            <th>Nama Kategori</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($kategori as $data)
                                        <tr style="text-align: center;">
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $data->nama_kategori }}</td>
                                            <td>
                                                <a href="/admin/kelola_kategori/edit/{{ $data->id }}"
                                                    class="btn btn-warning btn-sm"><i class="fe fe-edit"></i></a>
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

        {{-- @foreach ($kategori as $data)
        <div class="modal" id="delete{{ $data->id }}" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-l">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Hapus Data</h4>
                </div>
                <div class="modal-body">
                    <h5>Hapus {{ $data->nama_kategori }}</h5>
                    <p>Apakah anda yakin ingin menghapus data ini?</p>
                </div>
                <div class="modal-footer">
                    <a href="{{ url('/admin/kelola_kategori/delete/'.$data->id ) }}"
                        class="btn btn-outline btn-danger">Yes</a>
                    <button type="button" class="btn btn-outline btn-primary pull-left"
                        data-bs-dismiss="modal">No</button>
                </div>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
    @endforeach --}}
</div>
</div>
<script>
function showDelete(id, nama_kategori) {
    Swal.fire({
        title: "Apakah Anda yakin?",
        text: "Menghapus Data" + " " + nama_kategori,
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Ya",
        backdrop: true, // Mengaktifkan backdrop
        allowOutsideClick: false // Mencegah penutupan jika klik di luar modal
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "{{ url('/admin/kelola_kategori/delete/') }}/" + id;
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
</script>



@endsection