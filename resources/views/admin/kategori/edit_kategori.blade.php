@extends('layout.index')
@section('title', 'Kelola kategori')
@section('content')

<div class="main-content side-content pt-0">

    <div class="main-container container-fluid">
        <div class="inner-body">

            <!-- Page Header -->
            <div class="page-header">
                <div>
                    <h2 class="main-content-title tx-24 mg-b-5">Kelola Kategori</h2>

                </div>
            </div>

            <div class="card custom-card">
                <div class="card-header">
                    Tambah Data
                </div>
                <div class="card-body">

                    <form action="/admin/kelola_kategori/update/{{ $kategori->id }}" method="POST" enctype="multipart/form-data">
                        {{-- enctype wajib seperti itu untuk mengupload file  --}}
                        @csrf

                        @method('PUT')

                        @if ($errors->any())
                        <div class="alert alert-danger text-center">
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </div>
                        @endif


                        <div class="content">
                            <div class="row">
                                <div class="col-sm-15">

                                    <div class="form-group">
                                        <label>Nama Kategori</label>
                                        <input type="text" name="nama_kategori" class="form-control" value="{{ old('nama_kategori')??$kategori->nama_kategori }}" >
                                        <div class="text-danger">
                                            @error('nama_kategori')
                                            {{ $message }}
                                            @enderror
                                        </div>
                                        {{-- untuk menampilkan pesan error --}}
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">Simpan</button>
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

@endsection
