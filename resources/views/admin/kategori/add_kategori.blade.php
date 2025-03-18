@extends('layout.index')
@section('title', 'Kelola Kategori')
@section('content')

    <div class="pt-0 main-content side-content">

        <div class="main-container container-fluid">
            <div class="inner-body">

                <!-- Page Header -->
                <div class="page-header">
                    <div>
                        <h2 class="main-content-title tx-24 mg-b-5">Tambah Kategori</h2>

                    </div>
                </div>

                <div class="card custom-card">
                    <div class="card-body">

                        <form action="/admin/kelola_kategori/insert" method="POST" enctype="multipart/form-data">
                            {{-- enctype wajib seperti itu untuk mengupload file  --}}
                            @csrf

                            <div class="content">
                                <div class="row">
                                    <div class="col-sm-15">
                                        <div class="form-group">
                                            <label>Nama kategori</label>
                                            <input type="text" name="nama_kategori" class="form-control"
                                                value="{{ old('nama_kategori') }}">
                                            <div class="text-danger">
                                                @error('nama_kategori')
                                                    {{ $message }}
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Nomor Surat</label>
                                            <input type="text" name="nomor_surat" class="form-control"
                                                value="{{ old('nomor_surat') }}" placeholder="Contoh: PST-MOU/11">
                                            <div class="text-danger">
                                                @error('nomor_surat')
                                                    {{ $message }}
                                                @enderror
                                            </div>
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
