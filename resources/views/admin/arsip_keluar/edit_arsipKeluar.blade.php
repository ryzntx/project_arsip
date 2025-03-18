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
                                                <div class="form-group">
                                                    <label>Kategori Dokumen</label>
                                                    <select name="kategori_id" id="kategori_dokumen_keluar"
                                                        class="form-control">
                                                        <option value="">Pilih Kategori Dokumen</option>
                                                        @foreach ($kategori as $item)
                                                            <option value="{{ $item->id }}"
                                                                {{ old('kategori_id', $arsip_keluar->dokumen_kategori_id) == $item->id ? 'selected' : '' }}>
                                                                {{ $item->nama_kategori }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('kategori_id')
                                                        <small class="text-danger text-bold">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label class="tx-medium">Sifat Dokumen</label>
                                                    <select name="sifat_dokumen" class="form-control" id="sifat_dokumen">
                                                        <option value="0"
                                                            {{ old('sifat_dokumen', $arsip_keluar->sifat_dokumen) == '0' ? 'selected' : '' }}>
                                                            Biasa</option>
                                                        <option value="1"
                                                            {{ old('sifat_dokumen', $arsip_keluar->sifat_dokumen) == '1' ? 'selected' : '' }}>
                                                            Penting</option>
                                                    </select>
                                                    @error('sifat_dokumen')
                                                        <small class="text-danger text-bold">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                                @if ($arsip_keluar->disetujui == 0)
                                                    <div class="form-group">
                                                        <label class="tx-medium d-block">Lampiran Dokumen</label>
                                                        {{-- <input type="file" name="file_dokumen" id="file_dokumen_keluar"
                                                            class="form-control {{ old('pengajuan_ke_pimpinan') ?? $arsip_keluar->persetujuan == 'ya' ? 'd-none' : '' }}"
                                                            accept=".pdf, .doc, .docx"> --}}
                                                        <button type="button" class=" btn btn-primary"
                                                            data-bs-toggle="modal" id="btnLampiran"
                                                            data-bs-target="#modalLampiran">
                                                            Tambahkan Lampiran dari Template </button>
                                                        {{-- @error('file_dokumen')
                                                            <small class="text-danger text-bold">{{ $message }}</small>
                                                        @enderror --}}
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
                                                @if ($arsip_keluar->status == 'Dikirimkan' || $arsip_keluar->status == 'Selesai')
                                                    <div class="form-group">
                                                        <label class="tx-medium">Bukti Diterima</label>
                                                        <br>
                                                        @if ($arsip_keluar->bukti_dikirimkan)
                                                            <img src="{{ asset('storage/' . $arsip_keluar->bukti_dikirimkan) }}"
                                                                class="img-thumbnail" width="20%" height="20%" />
                                                        @else
                                                            <input type="file" class="form-control"
                                                                name="bukti_dikirimkan" id="bukti_dikirimkan"
                                                                value="{{ $arsip_keluar->bukti_dikirimkan }}">
                                                        @endif
                                                    </div>
                                                @endif
                                                <div class="form-group">
                                                    <label class="tx-medium">Keterangan</label>
                                                    <textarea name="keterangan" rows="3" class="form-control">{{ old('keterangan') }}</textarea>
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
                                                                    @selected(old('pilihTemplate') == $data->id)>
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
                                    <input type="hidden" name="nomor_surat" id="h_nomor_surat"
                                        value="{{ $arsip_keluar->nomor_surat }}">
                                    <input type="hidden" name="nomor_urut" id="h_nomor_urut"
                                        value="{{ $arsip_keluar->nomor_urut }}">
                                </form>
                            </div>
                            <div class="col-6" style="margin-top: 30px">
                                <div class="pdf-viewer-container">
                                    <iframe id="pdf-viewer"
                                        src="{{ asset('/laraview/#../storage/' . str_replace('.docx', '.pdf', $arsip_keluar->lampiran)) }}"
                                        width="100%" height="950px" style="border: none;" allowfullscreen
                                        webkitallowfullscreen></iframe>
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
            // let pengajuan_ke_pimpinan = document.getElementById('pengajuan_ke_pimpinan');
            // let btnLampiran = document.getElementById('btnLampiran');
            let kategoriDokKeluar = document.getElementById('kategori_dokumen_keluar');
            let modalLampiran = new bootstrap.Modal(document.getElementById('modalLampiran'));

            var kategoriDokKeluarValue = '{{ old('kategori_id', $arsip_keluar->dokumen_kategori_id) }}';

            let isi_surat = false;
            var quill;

            @if (old('pilihTemplate'))
                if (pilihTemplate.value ===
                    '{{ old(' pilihTemplate ') }}') {
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

            kategoriDokKeluar.addEventListener('change', function() {
                kategoriDokKeluarValue = this.value;
            });

            // pengajuan_ke_pimpinan.addEventListener('change', function() {
            //     if (this.value === 'ya') {
            //         uploadFileInput.classList.add('d-none');
            //         uploadFileInput.removeAttribute('required');
            //         btnLampiran.classList.remove('d-none');
            //     } else {
            //         uploadFileInput.classList.remove('d-none');
            //         uploadFileInput.setAttribute('required', true);
            //         btnLampiran.classList.add('d-none');
            //     }
            // });

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
                                'konten' || item == 'CONTENT' || item == 'content') {
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
                                @foreach (old() as $old => $value)
                                    @if (strpos($old, 'var_') !== false)
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
                                input.setAttribute('id', item);
                                @foreach (old() as $old => $value)
                                    @if (strpos($old, 'var_') !== false)
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
                        form_loading.classList.replace('d-flex', 'd-none');
                        var nomorSuratEl = document.getElementById('NOMOR_SURAT');
                        if (nomorSuratEl) {
                            nomorSuratEl.value = "{{ $arsip_keluar->nomor_surat }}";
                        }
                    });
                // fetch('/admin/tambah_dokumen/ambilnomorsurat/' + kategoriDokKeluarValue)
                //     .then(response => response.json())
                //     .then(data => {
                //         var dataNomorSurat = data.nomor_surat;
                //         var nomorSuratEl = document.getElementById('NOMOR_SURAT');
                //         var nomorSuratHidden = document.getElementById('h_nomor_surat');
                //         var nomorUrutHidden = document.getElementById('h_nomor_urut');
                //         if (nomorSuratEl) {
                //             nomorSuratEl.value = dataNomorSurat;
                //         }
                //         if (nomorSuratHidden) {
                //             nomorSuratHidden.value = dataNomorSurat;
                //         }
                //         if (nomorUrutHidden) {
                //             nomorUrutHidden.value = data.nomor_urut;
                //         }
                //     });
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
                    @foreach (old() as $old => $value)
                        @if (strpos($old, 'var_') !== false)
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
