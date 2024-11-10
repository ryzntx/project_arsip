@extends('layout.index')
@section('title', 'Kelola Instansi')
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
                    <h2 class="main-content-title tx-24 mg-b-5">Tabel Instansi</h2>
                </div>
                <div class="d-flex">
                    <a href="/admin/kelola_instansi/add">
                        <button type="button" class="btn btn-primary my-2 btn-icon-text">
                            <i class="fe fe-plus"></i>
                            Tambah Instansi</button>
                    </a>
                </div>
            </div>
        </div>
        <!-- End Page Header -->

        <!-- Row -->
        <div class="row row-sm">
            <div class="col-lg-12">
                <div class="card custom-card">
                    <div class="card-body">
                        <div class="table-responsive border">
                            <table class="table text-nowrap text-md-nowrap mg-b-0">

                                <thead>
                                    <tr>
                                        <th style="text-align: center;">No</th>
                                        <th>Nama Instansi</th>
                                        <th>Singkatan</th>
                                        <th>Alamat</th>
                                        <th style="text-align: center;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($instansi as $data)
                                    <tr>
                                        <td style="text-align: center;">{{ $loop->iteration }}</td>
                                        <td>{{ $data->nama_instansi }}</td>
                                        <td>{{ $data->singkatan_instansi }}</td>
                                        <td>{{ $data->alamat }}</td>
                                        <td style="text-align: center;">
                                            <a href="/admin/kelola_instansi/edit/{{ $data->id }}" class="btn btn-warning btn-sm"><i class="fe fe-edit"></i></a>
                                            <a href="#delete{{$data->id}}" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                                data-bs-target="#delete{{ $data->id }}">
                                                <i class="fe fe-trash"></i>
                                            </a>
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

        @foreach ($instansi as $data)
        <div class="modal modal-danger fade" id="delete{{ $data->id }}">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">{{ $data->nama_instansi }}</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Apakah anda yakin ingin menghapus data ini?</p>
                    </div>
                    <div class="modal-footer">
                        <a href="{{ url('/admin/kelola_instansi/delete/'.$data->id ) }}" class="btn btn-outline btn-danger">Ya, Hapus!</a>
                        <button type="button" class="btn btn-outline btn-primary pull-left" data-bs-dismiss="modal">Tidak!</button>
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
