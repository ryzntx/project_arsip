@extends('layout.index')
@section('title', 'Edit Arsip Dokumen Keluar')
@section('content')

<div class="pt-0 main-content side-content">

    <div class="main-container container-fluid">
        <div class="inner-body">
            <!-- Page Header -->
            <div class="text-center page-header" style="margin-bottom: 20px;">
                <div>
                    <h2 class="main-content-label tx-24 mg-b-5"
                        style="color: darkslateblue; font-weight: bold; text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.3);">
                        <i class="fas fa-edit" style="margin-right: 10px; font-size: 28px;"></i>
                        Edit Dokumen
                    </h2>
                </div>
            </div>
            <div class="card custom-card">
                <div class="card-header">
                    Dokumen Keluar
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <form action="/admin/arsip_keluar/update/{{ $arsip_keluar->id }}" method="POST"
                                enctype="multipart/form-data">
                                {{-- enctype wajib seperti itu untuk mengupload file  --}}
                                @csrf
                                @method('PUT')

                                @if ($errors->any())
                                <div class="alert alert-danger">
                                    <strong>Oops!</strong> Sepertinya ada yang salah dengan inputan anda.
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
                                                <label class="tx-medium">Tanggal</label>
                                                <input type="date" class="form-control" name="tanggal_keluar"
                                                    id="tanggal_keluar"
                                                    value="{{ old('tanggal_keluar') ?? $arsip_keluar->tanggal_keluar }}"
                                                    required>
                                                @error('tanggal_keluar')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="namaDinas" class="tx-medium">Dinas</label>
                                                <select id="namaDinas" name="dinas_id" class="form-control">
                                                    <!-- Option list remains unchanged -->
                                                    <option value="" selected>Pilih</option>
                                                    @foreach ($instansi as $data)
                                                    <option value="{{ $data->id }}"
                                                        {{ old('instansi_id', $arsip_keluar->instansi_id) == $data->id ? 'selected' : '' }}>
                                                        {{ $data->nama_instansi }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label class="tx-medium">Penerima</label>
                                                <input type="text" class="form-control" name="nama_penerima"
                                                    id="nama_penerima"
                                                    value="{{ old('penerima') ?? $arsip_keluar->penerima }}">
                                            </div>
                                            <div class="form-group">
                                                <label class="tx-medium">Nama Dokumen</label>
                                                <input type="text" class="form-control" name="nama_dokumen"
                                                    id="nama_dokumen"
                                                    value="{{ old('nama_dokumen') ?? $arsip_keluar->nama_dokumen }}"
                                                    required>
                                            </div>
                                            <div class=" form-group">
                                                <label>Kategori Dokumen:</label>
                                                @foreach ($kategori as $data)
                                                <div>
                                                    <input type="radio" id="pilihan{{ $data->id }}" name="kategori_id"
                                                        value="{{ $data->id }}"
                                                        {{ old('dokumen_kategori_id', $arsip_keluar->dokumen_kategori_id) == $data->id ? 'checked' : '' }}>
                                                    <label
                                                        for="pilihan{{ $data->id }}">{{ $data->nama_kategori }}</label>
                                                </div>
                                                @endforeach
                                            </div>
                                            @if ($arsip_keluar->status != 'Dikirimkan')
                                            <div class="form-group">
                                                <label class="tx-medium">Perlu Pengajuan ke Pimpinan?</label>
                                                <select name="pengajuan_ke_pimpinan" class="form-control"
                                                    id="pengajuan_ke_pimpinan">
                                                    <option value="tidak" @selected(old('pengajuan_ke_pimpinan') ??
                                                        $arsip_keluar->persetujuan == 'tidak')>Tidak
                                                    </option>
                                                    <option value="ya" @selected(old('pengajuan_ke_pimpinan') ??
                                                        $arsip_keluar->persetujuan == 'ya')>Ya</option>
                                                </select>
                                                @error('pengajuan_ke_pimpinan')
                                                <small class="text-danger text-bold">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label class="tx-medium d-block">Lampiran Dokumen</label>
                                                <input type="file" name="file_dokumen" id="file_dokumen_keluar"
                                                    class="form-control {{ old('pengajuan_ke_pimpinan') ?? $arsip_keluar->persetujuan == 'ya' ? 'd-none' : '' }}"
                                                    accept=".pdf, .doc, .docx">
                                                <button type="button"
                                                    class="{{ old('pengajuan_ke_pimpinan') ?? $arsip_keluar->persetujuan == 'ya' ? '' : 'd-none' }} btn btn-primary"
                                                    data-bs-toggle="modal" id="btnLampiran"
                                                    data-bs-target="#modalLampiran">
                                                    Tambahkan Lampiran dari Template </button>
                                                @error('file_dokumen')
                                                <small class="text-danger text-bold">{{ $message }}</small>
                                                @enderror
                                                @error('pilihTemplate')
                                                <div class="text-danger text-bold">{{ $message }}</div>
                                                @enderror
                                                @if ($errors->any())
                                                <div class="text-danger text-bold">
                                                    @foreach ($errors->toArray() as $key => $error)
                                                    @if (strpos($key, 'var_') !== false)
                                                    Lampiran template wajib diisi semua!
                                                    @break
                                                    @endif
                                                    @endforeach
                                                </div>
                                                @endif
                                            </div>
                                            @endif
                                            @if ($arsip_keluar->status == 'Dikirimkan')
                                            <div class="form-group">
                                                <label class="tx-medium">Bukti Diterima</label>
                                                <br>
                                                @if ($arsip_keluar->bukti_dikirimkan)
                                                <img src="{{ asset('storage/' . $arsip_keluar->bukti_dikirimkan) }}"
                                                    class="img-thumbnail" width="20%" height="20%" />
                                                @else
                                                <span class="text-danger">Tidak ada bukti</span>
                                                @endif
                                                <input type="file" class="form-control" name="bukti_dikirimkan"
                                                    id="bukti_dikirimkan" value="{{ $arsip_keluar->bukti_dikirimkan }}">
                                            </div>
                                            @endif
                                            <div class="form-group">
                                                <label class="tx-medium">Keterangan</label>
                                                <textarea name="keterangan" rows="3"
                                                    class="form-control">{{ old('keterangan') }}</textarea>
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary">Simpan</button>
                                            </div>
                                        </div>
                                    </div>
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
                                                @if ($template_dok->isEmpty())
                                                <div class="alert alert-warning">
                                                    Tidak ada template dokumen yang tersedia.
                                                </div>
                                                @endif
                                                @if ($errors->any())
                                                <div class="alert alert-danger">
                                                    <strong>Oops!</strong> Sepertinya ada yang salah dengan inputan
                                                    anda.
                                                    <ul>
                                                        @foreach ($errors->toArray() as $key => $error)
                                                        @if (strpos($key, 'var_') !== false)
                                                        <li>Lampiran template wajib diisi semua!</li>
                                                        @break
                                                        @endif
                                                        @endforeach
                                                    </ul>
                                                </div>

                                                @endif
                                                <div class="form-group">
                                                    <label for="pilihTemplate" class="tx-medium">Pilih
                                                        Template</label>
                                                    <select id="pilihTemplate" name="pilihTemplate"
                                                        class="form-control">
                                                        <option value="">Pilih Template Dokumen</option>
                                                        @foreach ($template_dok as $data)
                                                        <option value="{{ $data->id }}"
                                                            @selected(old('pilihTemplate')==$data->id)>
                                                            {{ $data->nama }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('pilihTemplate')
                                                    <small class="text-danger text-bold">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                                <div class="text-center d-none align-content-center justify-content-center"
                                                    id="form-loading">
                                                    <div class="spinner-border" role="status">
                                                        <span class="sr-only">Loading...</span>
                                                    </div>
                                                </div>
                                                <div id="fieldSet"></div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-outline btn-primary pull-left"
                                                    data-bs-dismiss="modal">Tutup!</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.modal-content -->
                            </form>
                        </div>
                        <div class="col-6" style="margin-top: 30px">
                            <div class="pdf-viewer-container">
                                <iframe id="pdf-viewer"
                                    src="{{ asset('/laraview/#../storage/' . $arsip_keluar->lampiran) }}" width="100%"
                                    height="950px" style="border: none;" allowfullscreen webkitallowfullscreen></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @endsection

    @push('scripts')
    <!-- Script to toggle between forms based on document type -->
    <script>
    let pilihTemplate = document.getElementById('pilihTemplate');
    let fieldSet = document.getElementById('fieldSet');
    let uploadFileInput = document.getElementById('file_dokumen_keluar');
    let form_loading = document.getElementById('form-loading')
    let pengajuan_ke_pimpinan = document.getElementById('pengajuan_ke_pimpinan');
    let btnLampiran = document.getElementById('btnLampiran');
    let modalLampiran = new bootstrap.Modal(document.getElementById('modalLampiran'));

    let isi_surat = false;
    var quill;

    @if(old('pilihTemplate'))
    if (pilihTemplate.value === '{{ old('
        pilihTemplate ') }}') {
        document.addEventListener('DOMContentLoaded', function() {
            // Your code to run since DOM is loaded and ready
            fetching({
                {
                    old('pilihTemplate')
                }
            });
        });
    }
    @endif

    pengajuan_ke_pimpinan.addEventListener('change', function() {
        if (this.value === 'ya') {
            uploadFileInput.classList.add('d-none');
            uploadFileInput.removeAttribute('required');
            btnLampiran.classList.remove('d-none');
        } else {
            uploadFileInput.classList.remove('d-none');
            uploadFileInput.setAttribute('required', true);
            btnLampiran.classList.add('d-none');
        }
    });

    const fetching = async (id) => {
        fetch('/admin/tambah_dokumen/ambiltemplate/' + id)
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
                    let element;
                    if (item == 'KONTEN' || item == 'ISISURAT' || item == 'isi_surat' || item ==
                        'konten') {
                        input = document.createElement('input');
                        element = document.createElement('div');
                        element.setAttribute('id', 'quill');
                        // input.classList.add('form-control');
                        // element.classList.add('quill')
                        input.setAttribute('id', 'isi_surat');
                        input.setAttribute('name', "var_" + item);
                        input.setAttribute('type', 'hidden');
                        // input.setAttribute('required', false);

                        isi_surat = true;
                    } else if (item == 'TANGGAL' || item == 'TANGGAL_SURAT' || item == 'tanggal' ||
                        item == 'tanggal_surat') {
                        input = document.createElement('input');
                        input.classList.add('form-control');
                        input.setAttribute('name', "var_" + item);
                        input.setAttribute('type', 'date');
                        @foreach(old() as $old => $value)
                        @if(strpos($old, 'var_') !== false)
                        if ('{{ $old }}' === 'var_' + item) input.setAttribute(
                            'value', '{{ $value }}');
                        @endif
                        @endforeach
                        // input.setAttribute('required', false);
                    } else {
                        input = document.createElement('input');
                        input.classList.add('form-control');
                        input.setAttribute('name', "var_" + item);
                        input.setAttribute('type', 'text');
                        @foreach(old() as $old => $value)
                        @if(strpos($old, 'var_') !== false)
                        if ('{{ $old }}' === 'var_' + item) input.setAttribute(
                            'value', '{{ $value }}');
                        @endif
                        @endforeach
                        // input.setAttribute('required', false);
                    }

                    // append label and input to form group
                    formGroup.appendChild(label);
                    formGroup.appendChild(input);
                    if (element) formGroup.appendChild(element);

                    // append form group to fieldset
                    fieldSet.appendChild(formGroup);
                });

            }).finally(() => {
                form_loading.classList.replace('d-flex', 'd-none')
            });
    }

    pilihTemplate.addEventListener('change', function() {
        fieldSet.innerHTML = '';
        //fetch data from server
        if (this.value === '') {
            form_loading.classList.replace('d-flex', 'd-none')
            return;
        }

        form_loading.classList.replace('d-none', 'd-flex')

        fetching(this.value);

    });


    let previousIsiSurat = isi_surat;

    const observer = new MutationObserver(() => {
        if (isi_surat && !previousIsiSurat) {
            quill = new Quill('#quill', {
                theme: 'snow'
            });

            quill.on('text-change', function() {
                document.getElementById('isi_surat').value = quill.root.innerHTML;
            });
            previousIsiSurat = isi_surat;
            @foreach(old() as $old => $value)
            @if(strpos($old, 'var_') !== false)
            if ('{{ $old }}' === 'var_' + 'isi_surat' || '{{ $old }}' === 'var_' +
                'konten' || '{{ $old }}' === 'var_' + 'KONTEN' || '{{ $old }}' ===
                'var_' + 'ISISURAT') {
                quill.setText('{{ html_entity_decode($value) }}');
            }
            @endif
            @endforeach
        }
    });

    observer.observe(fieldSet, {
        childList: true,
        subtree: true
    });
    </script>
    @endpush
