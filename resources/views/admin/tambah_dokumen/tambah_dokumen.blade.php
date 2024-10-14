@extends('layout.index')
@section('title', 'Sekretaris')
@section('content')

<div class="main-content side-content pt-0">
    <div class="main-container container-fluid">
        <div class="inner-body">

            <!-- Page Header -->
            <div class="page-header">
                <div>
                    <h2 class="main-content-title tx-24 mg-b-5">Tambah Dokumen</h2>
                </div>
            </div>
            <!-- End Page Header -->

            <!-- Pilihan Jenis Dokumen -->
            <div class="form-group">
                <label for="jenis_dokumen" class="tx-medium">Jenis Dokumen</label>
                <select id="jenis_dokumen" class="form-control" name="jenis_dokumen">
                    <option value="pus_" selected>Pilih</option>
                    <option value="masuk">Dokumen Masuk</option>
                    <option value="keluar">Dokumen Keluar</option>
                </select>
            </div>

            <!-- Template Form Dokumen Masuk -->
            <div class="row row-sm form-container" id="formMasuk" style="display: none;">
                <div class="col-lg-12 col-md-12">
                    <div class="card custom-card">
                        <div class="card-header">
                            <h5>Form Dokumen Masuk</h5>
                        </div>
                        <form action="/admin/tambah_dokumen/insert" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="jenis_dokumen" value="dokumen_masuk" required>
                            <div class="card-body">
                                <div class="form-group">
                                    <label class="tx-medium">Tanggal Dokumen Masuk</label>
                                    <input type="date" class="form-control" name="tanggal_masuk" id="tanggal_masuk"
                                        required value="{{old('tanggal_masuk')}}">
                                </div>
                                <div class="form-group">
                                    <label class="tx-medium">Nama Dokumen</label>
                                    <input type="text" class="form-control" name="nama_dokumen" id="nama_dokumen"
                                        required value="{{ old('nama_dokumen') }}">
                                </div>
                                <div class="form-group">
                                    <label for="namaDinas" class="tx-medium">Dinas / Instansi</label>
                                    <select id="namaDinas" name="dinas_id" class="form-control" required>

                                        <!-- Option list remains unchanged -->
                                        <option selected>Pilih Dinas / Instansi</option>
                                        @foreach ($instansi as $data)
                                        <option value="{{$data->id}}"
                                            {{ old('dinas_id') == $data->id ? 'selected' : '' }}>
                                            {{$data->nama_instansi}}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="tx-medium">Pengirim</label>
                                    <input type="text" class="form-control" name="nama_pengirim" id="nama_pengirim"
                                        value="{{ old('nama_pengirim') }}">
                                </div>
                                <div class="form-group">
                                    <label class="tx-medium">Penerima</label>
                                    <input type="text" class="form-control" name="nama_penerima" id="nama_penerima"
                                        value="{{ old('nama_penerima') }}">
                                </div>
                                <div class="form-group">
                                    <label>Kategori Dokumen:</label>

                                    @foreach ($kategori as $data)
                                    <div>
                                        <input type="radio" id="pilihan{{$data->id}}" name="kategori_id"
                                            value="{{$data->id}}" required
                                            {{ old('kategori_id') == $data->id ? 'checked' : '' }}>
                                        <label for="pilihan{{$data->id}}">{{$data->nama_kategori}}</label>
                                    </div>
                                    @endforeach

                                </div>
                                <div class="form-group">
                                    <label class="tx-medium">Lampiran Dokumen</label>
                                    <input type="file" name="file_dokumen" id="file_dokumen" class="form-control"
                                        required>
                                </div>
                                <div class="form-group">
                                    <label class="tx-medium">Keterangan</label>
                                    <textarea name="keterangan" rows="3"
                                        class="form-control">{{ old('keterangan') }}</textarea>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Simpan Dokumen</button>
                                <button type="reset" class="btn btn-danger">Reset</button>
                            </div>
                        </form>
                        <!-- Submit Buttons -->
                    </div>
                </div>
            </div>

            <!-- Template Form Dokumen Keluar -->
            <div class="row row-sm form-container" id="formKeluar" style="display: none;">
                <div class="col-lg-12 col-md-12">
                    <div class="card custom-card">
                        <div class="card-header">
                            <h5>Form Dokumen Keluar</h5>
                        </div>
                        <form action="/admin/tambah_dokumen/insert" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="jenis_dokumen" value="dokumen_keluar" required>
                            <div class="card-body">
                                <div class="form-group">
                                    <label class="tx-medium">Tanggal</label>
                                    <input type="date" class="form-control" name="tanggal_keluar" id="tanggal_keluar"
                                        required>
                                </div>
                                <div class="form-group">
                                    <label for="namaDinas" class="tx-medium">Dinas</label>
                                    <select id="namaDinas" name="dinas_id" class="form-control">

                                        <!-- Option list remains unchanged -->
                                        <option value="" selected>Pilih</option>
                                        @foreach ($instansi as $data)
                                        <option value="{{$data->id}}">{{$data->nama_instansi}}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="tx-medium">Pengirim</label>
                                    <input type="text" class="form-control" name="nama_pengirim" id="nama_pengirim">
                                </div>
                                <div class="form-group">
                                    <label class="tx-medium">Penerima</label>
                                    <input type="text" class="form-control" name="nama_penerima" id="nama_penerima">
                                </div>
                                <div class="form-group">
                                    <label class="tx-medium">Nama Dokumen</label>
                                    <input type="text" class="form-control" name="nama_dokumen" id="nama_dokumen" " required>
                                </div>
                                <div class=" form-group">
                                    <label>Kategori Dokumen:</label>
                                    @foreach ($kategori as $data)
                                    <div>
                                        <input type="radio" id="pilihan{{$data->id}}" name="kategori_id"
                                            value="{{$data->id}}">
                                        <label for="pilihan{{$data->id}}">{{$data->nama_kategori}}</label>
                                    </div>
                                    @endforeach
                                </div>
                                <div class="form-group">
                                    <label class="tx-medium">Lampiran Dokumen</label>
                                    <input type="file" name="file_dokumen" id="file_dokumen" class="form-control"
                                        required>
                                </div>
                                <div class="form-group">
                                    <label class="tx-medium">Perlu Pengajuan ke Pimpinan?</label>
                                    <select name="pengajuan_ke_pimpinan" class="form-control">
                                        <option value="tidak" selected>Tidak</option>
                                        <option value="ya">Ya</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label class="tx-medium">Keterangan</label>
                                    <textarea name="keterangan" rows="3"
                                        class="form-control">{{ old('keterangan') }}</textarea>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit Dokumen</button>
                                <button type="reset" class="btn btn-danger">Reset</button>
                            </div>
                        </form>
                        <!-- Submit Buttons -->
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>


<!-- Script to toggle between forms based on document type -->
<script>
document.getElementById('jenis_dokumen').addEventListener('change', function() {
    var type = this.value;
    var formMasuk = document.getElementById('formMasuk');
    var formKeluar = document.getElementById('formKeluar');

    // Reset visibility
    formMasuk.style.display = 'none';
    formKeluar.style.display = 'none';

    // Show form based on selected document type
    if (type === 'masuk') {
        formMasuk.style.display = 'block';
    } else if (type === 'keluar') {
        formKeluar.style.display = 'block';
    }
});
</script>

@endsection
