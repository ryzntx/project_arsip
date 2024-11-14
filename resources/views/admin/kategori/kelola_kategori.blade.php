@extends('layout.index')
@section('title', 'Kelola Kategori')
@section('content')

<div class="main-content side-content pt-0">

    @if(session('pesan'))
    <div class="alert alert-primary">
        {{ session('pesan') }}
    </div>
    @endif
    <div class="main-container container-fluid">
        <div class="inner-body">

            <!-- Page Header -->
            <div class="page-header">
                <div>
                    <h2 class="main-content-title tx-24 mg-b-5">Tabel Kategori</h2>

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
            <div class="col-md-12" id="left-panel">
                <div class="card custom-card">
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
                                            <a href="/admin/kelola_kategori/edit/{{ $data->id }}" class="btn btn-warning btn-sm"><i class="fe fe-edit"></i></a>
                                            <button  class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                                data-bs-target="#delete{{ $data->id }}">
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

        @foreach ($kategori as $data)

        <div class="modal modal-danger fade" id="delete{{ $data->id }}">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Hapus data?</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Apakah anda yakin ingin menghapus data ini?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline btn-primary pull-left" data-bs-dismiss="modal">No</button>
                        <a href="{{ url('/admin/kelola_kategori/delete/'.$data->id ) }}" class="btn btn-outline btn-danger">Yes</a>
                    </div>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
        @endforeach
    </div>
</div>



@endsection
