@extends('layout.index')
@section('title', 'Kelola Template Dokumen')
@section('content')

    <div class="main-content side-content pt-0">

        <div class="main-container container-fluid">
            <div class="inner-body">

                <!-- Page Header -->
                <div class="page-header">
                    <div>
                        <h2 class="main-content-title tx-24 mg-b-5">Kelola Template Dokumen</h2>

                    </div>
                </div>

                <div class="card custom-card">
                    <div class="card-header">
                        Tambah Data
                    </div>
                    <div class="card-body">

                        <form action="{{ route('admin.template_dokumen.insert') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <strong>Ups!</strong> Ada beberapa masalah dengan input Anda.<br>
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif


                            <div class="content">
                                <div class="row">
                                    <div class="col-sm-15">

                                        <div class="form-group">
                                            <label>Nama Dokumen</label>
                                            <input type="text" name="nama_dokumen" class="form-control" required
                                                value="{{ old('nama_dokumen') }}">
                                            <div class="text-danger">
                                                @error('nama_dokumen')
                                                    {{ $message }}
                                                @enderror
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <label>Kategori Dokumen</label>
                                            <select name="kategori_dokumen" id="kategori_dokumen" class="form-control"
                                                required>
                                                <option value="">Pilih Kategori</option>
                                                @foreach ($kategori as $item)
                                                    <option value="{{ $item->id }}">{{ $item->nama_kategori }}</option>
                                                @endforeach
                                            </select>
                                            <div class="text-danger">
                                                @error('kategori_dokumen')
                                                    {{ $message }}
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>File Template</label>
                                            <input type="file" name="file_template" class="form-control" required
                                                value="{{ old('file_template') }}">
                                            <div class="text-danger">
                                                @error('file_template')
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
