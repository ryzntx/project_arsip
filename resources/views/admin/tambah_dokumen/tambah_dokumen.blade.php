@extends('layout.index')
@section('title', 'Sekretaris')
@section('content')

<div class="pt-0 main-content side-content">
    @if(session('pesan'))
    <div class="alert alert-primary">
        {{ session('pesan') }}
    </div>
    @endif
    @if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif

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
                                    <label class="tx-medium">Tanggal</label>
                                    <input type="date" class="form-control" name="tanggal_masuk" id="tanggal_masuk"
                                        required value="{{old('tanggal_masuk')}}">
                                </div>
                                <div class="form-group">
                                    <label class="tx-medium">Nama Dokumen</label>
                                    <input type="text" class="form-control" name="nama_dokumen" id="nama_dokumen"
                                        value="{{ old('nama_dokumen') }}" required>
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
                                        value="{{ old('nama_pengirim') }}" required>
                                </div>
                                <div class="form-group">
                                    <label class="tx-medium">Penerima</label>
                                    <input type="text" class="form-control" name="nama_penerima" id="nama_penerima"
                                        value="{{ old('nama_penerima') }}" required>
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
                                <!-- <div class="form-group">
                                    <label class="tx-medium">Pengirim</label>
                                    <input type="text" class="form-control" name="nama_pengirim" id="nama_pengirim">
                                </div> -->
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
                                    <label class="tx-medium d-block">Lampiran Dokumen</label>
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#modalLampiran">
                                        Tambahkan Lampiran </button>
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
                                    <textarea name="keterangan" class="form-control">{{ old('keterangan') }}</textarea>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Simpan Dokumen</button>
                                <button type="reset" class="btn btn-danger">Reset</button>
                            </div>
                            <div class="modal modal-danger fade" id="modalLampiran">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Lampiran File</h4>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <ul class="nav nav-pills" id="myTab" role="tablist">
                                                <li class="nav-item" role="presentation">
                                                    <button class="nav-link active" id="uploadFile-tab"
                                                        data-bs-toggle="tab" data-bs-target="#uploadFile-tab-pane"
                                                        type="button" role="tab" aria-controls="uploadFile-tab-pane"
                                                        aria-selected="true">Upload Dokumen</button>
                                                </li>
                                                <li class="nav-item" role="presentation">
                                                    <button class="nav-link" id="templateFile-tab" data-bs-toggle="tab"
                                                        data-bs-target="#templateFile-tab-pane" type="button" role="tab"
                                                        aria-controls="templateFile-tab-pane"
                                                        aria-selected="false">Template Dokumen</button>
                                                </li>
                                            </ul>
                                            <div class="mt-3 tab-content" id="myTabContent">
                                                <div class="tab-pane fade show active" id="uploadFile-tab-pane"
                                                    role="tabpanel" aria-labelledby="uploadFile-tab" tabindex="0">
                                                    <input type="file" name="file_dokumen" id="file_dokumen_keluar"
                                                        class="form-control" required>
                                                    <!-- <input type="file" name="file_dokumen" id="file_dokumen"
                                                        class="form-control" required> -->
                                                </div>
                                                <div class="tab-pane fade" id="templateFile-tab-pane" role="tabpanel"
                                                    aria-labelledby="templateFile-tab" tabindex="0">

                                                    <div class="form-group">
                                                        <label for="pilihTemplate" class="tx-medium">Pilih
                                                            Template</label>
                                                        <select id="pilihTemplate" name="pilihTemplate"
                                                            class="form-control">
                                                            <option value="">Pilih Template Dokumen</option>
                                                            @foreach ($template_dok as $data)
                                                            <option value="{{ $data->id }}">
                                                                {{ $data->nama }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="text-center d-none align-content-center justify-content-center"
                                                        id="form-loading">
                                                        <div class="spinner-border" role="status">
                                                            <span class="sr-only">Loading...</span>
                                                        </div>
                                                    </div>
                                                    <div id="fieldSet"></div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-outline btn-primary pull-left"
                                                data-bs-dismiss="modal">Tutup!</button>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.modal-content -->
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
let pilihTemplate = document.getElementById('pilihTemplate');
let fieldSet = document.getElementById('fieldSet');
let uploadFileInput = document.getElementById('file_dokumen_keluar');
let form_loading = document.getElementById('form-loading')

pilihTemplate.addEventListener('change', function() {
    fieldSet.innerHTML = '';
    //fetch data from server
    if (this.value === '') {
        uploadFileInput.disabled = false;
        form_loading.classList.replace('d-flex', 'd-none')
        return;
    }

    uploadFileInput.disabled = true;
    form_loading.classList.replace('d-none', 'd-flex')


    fetch('/admin/tambah_dokumen/ambiltemplate/' + this.value)
        .then(response => response.json())
        .then(data => {
            var dataTemplates = data.data;
            let dataTemplate = JSON.parse(dataTemplates);

            dataTemplate.forEach(item => {
                // create form group element inside fieldset
                let formGroup = document.createElement('div');
                formGroup.classList.add('form-group');

                // create label element
                let label = document.createElement('label');
                label.classList.add('tx-medium');
                label.textContent = RegExp('(/[^A-Za-z0-9\-]/)', 'g').test(item) ? item : item
                    .replace(/_/g,
                        ' ');


                // create input element
                let input;
                if (item == 'KONTEN' || item == 'ISISURAT') {
                    input = document.createElement('textarea');
                    input.classList.add('form-control');
                    input.classList.add('summernote')
                    input.setAttribute('name', "var_" + item);
                    input.setAttribute('required', false);
                } else if (item == 'TANGGAL') {
                    input = document.createElement('input');
                    input.classList.add('form-control');
                    input.setAttribute('name', "var_" + item);
                    input.setAttribute('type', 'date');
                    input.setAttribute('required', false);
                } else {
                    input = document.createElement('input');
                    input.classList.add('form-control');
                    input.setAttribute('name', "var_" + item);
                    input.setAttribute('type', 'text');
                    input.setAttribute('required', false);
                }

                // append label and input to form group
                formGroup.appendChild(label);
                formGroup.appendChild(input);

                // append form group to fieldset
                fieldSet.appendChild(formGroup);

                //init textarea with summernote
                $('.summernote').summernote({
                    height: 150
                });

            });

        }).finally(() => {
            form_loading.classList.replace('d-flex', 'd-none')
        });
});

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