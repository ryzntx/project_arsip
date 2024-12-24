@extends('layout.index')
@section('title', 'Sekertaris')
@section('content')

<div class="main-content side-content pt-0">

    <div class="main-container container-fluid">
        <div class="inner-body">

            <!-- Page Header -->
            <div class="page-header">
                <div>
                    <h2 class="main-content-title tx-24 mg-b-5">Tabel User</h2>

                </div>
            </div>

            <div class="row row-sm">
                <div class="col-lg-12">
                    <div class="card custom-card">
                        <div class="card-body">
                            <form action="/admin/kelola_user/insert" method="POST" enctype="multipart/form-data">
                                {{-- enctype wajib seperti itu untuk mengupload file  --}}
                                @csrf

                                <div class="content">
                                    <div class="row">
                                        <div class="col-sm-15">

                                            <div class="form-group">
                                                <label>Nama</label>
                                                <input type="text" name="name" class="form-control"
                                                    value="{{ old('name') }}">
                                                <div class="text-danger">
                                                    @error('name')
                                                    {{ $message }}
                                                    @enderror
                                                </div>
                                                {{-- untuk menampilkan pesan error --}}
                                            </div>


                                            <div class="form-group">
                                                <label>Email</label>
                                                <input type="text" name="email" class="form-control"
                                                    value="{{ old('email') }}">
                                                <div class="text-danger">
                                                    @error('email')
                                                    {{ $message }}
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label>Password</label>
                                                <input type="password" name="password" class="form-control"
                                                    value="{{ old('password') }}">
                                                <div class="text-danger">
                                                    @error('password')
                                                    {{ $message }}
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label>Pilih Role</label>
                                                <select type="dropdown" name="role" class="form-control"
                                                    value="{{ old('role') }}">
                                                    <option value="admin">Admin</option>
                                                    <option value="pimpinan">Pimpinan</option>
                                                </select>
                                                <div class="text-danger">
                                                    @error('role')
                                                    {{ $message }}
                                                    @enderror
                                                </div>
                                            </div>


                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary">Tambah</button>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection