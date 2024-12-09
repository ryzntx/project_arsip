@extends('layout.index')
@section('title', 'Sekertaris')
@section('content')

<div class="main-content side-content pt-0">

    <div class="main-container container-fluid">
        <div class="inner-body">

            <!-- Page Header -->
            <div class="page-header">
                <div>
                    <h2 class="main-content-title tx-24 mg-b-5">Tambah Instansi</h2>

                </div>
            </div>

            <div class="card custom-card">
                <div class="card-header">
                    Tambah Data
                </div>
                    <div class="card-body">
                        <form action="/admin/kelola_instansi/insert" method="POST" enctype="multipart/form-data">
                    {{-- enctype wajib seperti itu untuk mengupload file  --}}
                        @csrf

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
                                            <label>Nama Instansi</label>
                                            <input type="text" name="nama_instansi" class="form-control" value="{{ old('nama_instansi')}}">
                                            <div class="text-danger">
                                                @error('nama_instansi')
                                                {{ $message }}
                                                @enderror
                                            </div>
                                            {{-- untuk menampilkan pesan error --}}
                                        </div>


                                        <div class="form-group">
                                            <label>Inisial Instansi</label>
                                            <input type="text" name="singkatan_instansi" class="form-control" value="{{ old('singkatan_instansi')}}">
                                            <div class="text-danger">
                                                @error('singkatan_instansi')
                                                {{ $message }}
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Alamat Instansi</label>
                                            <input type="text" name="alamat" class="form-control" value="{{ old('alamat')}}">
                                            <div class="text-danger">
                                                @error('alamat')
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
{{-- 1.Gunakan content jika itu adalah kelas yang Anda buat sendiri atau berasal dari kerangka kerja khusus.
2.Gunakan row untuk mengelompokkan elemen dalam tata letak berbasis grid.
3.Gunakan col-sm-6 (atau variasi lainnya) untuk mengatur lebar kolom. --}}








@endsection
