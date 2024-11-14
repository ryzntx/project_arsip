@extends('layout.index')
@section('title', 'Sekertaris')
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
                    <h2 class="main-content-title tx-24 mg-b-5">Tabel User</h2>

                </div>
                <div class="d-flex">
                    <a href="/admin/kelola_user/add">
                        <button type="button" class="btn btn-primary my-2 btn-icon-text">
                            <i class="fe fe-user-plus"></i>
                            Tambah User</button>
                    </a>
                    </div>
                </div>
            </div>
            <!-- End Page Header -->

            <!-- Row -->
            <div class="row row-sm">
                <div class="col-md-12" id="left-panel">
                    <div class="card custom-card">
                        <div class="card-header  border-bottom-0 pb-0">
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table mb-0" id="kelolaUser-table" style="width: 100%">
                                    <thead>
                                        <tr class="border-bottom" style="text-align: center;">
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Email</th>
                                            <th>Role</th>
                                            {{-- <th>Password</th> --}}
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1; ?>
                                        @foreach ($user as $data)
                                        <tr style="text-align: center;">
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $data->name }}</td>
                                            <td>{{ $data->email }}</td>
                                            <td>{{ $data->role }}</td>
                                            {{-- <td>{{ $data->password }}</td> --}}
                                            <td>
                                                <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#delete{{ $data->id }}">
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
        @foreach ($user as $data)
        <div class="modal modal-danger fade" id="delete{{ $data->id }}">
            <div class="modal-dialog modal-l">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title">{{ $data->name }}</h4>
                </div>
                <div class="modal-body">
                  <p>Apakah anda yakin ingin menghapus data ini?</p>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-outline btn-primary pull-left" data-dismiss="modal">No</button>
                  <a href="{{ url('/admin/kelola_user/delete/'.$data->id ) }}" class="btn btn-outline btn-danger">Yes</a>
                </div>
              </div>
              <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
          </div>
    </div>
    @endforeach

@endsection
