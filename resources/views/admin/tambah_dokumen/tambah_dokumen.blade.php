@extends('layout.index')
@section('title', 'Sekretaris')
@section('content')

    <div class="pt-0 main-content side-content">
        @if (session('pesan'))
            <div class="alert alert-primary">
                {{ session('pesan') }}
            </div>
        @endif
        @if (session('error'))
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
                        <option value="pus_">Pilih</option>
                        <option value="masuk" @selected(old('jenis_dokumen') === 'dokumen_masuk')>Dokumen Masuk</option>
                        <option value="keluar" @selected(old('jenis_dokumen') === 'dokumen_keluar')>Dokumen Keluar</option>
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
                                <input type="hidden" name="jenis_dokumen" value="dokumen_masuk">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label class="tx-medium">Tanggal</label>
                                        <input type="date" class="form-control" name="tanggal_masuk" id="tanggal_masuk"
                                            value="{{ old('tanggal_masuk') }}">
                                        @error('tanggal_masuk')
                                            <small class="text-danger text-bold">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="tx-medium">Nama Dokumen</label>
                                        <input type="text" class="form-control" name="nama_dokumen" id="nama_dokumen"
                                            value="{{ old('nama_dokumen') }}">
                                        @error('nama_dokumen')
                                            <small class="text-danger text-bold">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="namaDinas" class="tx-medium">Dinas / Instansi</label>
                                        <select id="namaDinas" name="dinas_id" class="form-control">
                                            <!-- Option list remains unchanged -->
                                            <option selected>Pilih Dinas / Instansi</option>
                                            @foreach ($instansi as $data)
                                                <option value="{{ $data->id }}" @selected(old('dinas_id') == $data->id)>
                                                    {{ $data->nama_instansi }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('dinas_id')
                                            <small class="text-danger text-bold">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="tx-medium">Pengirim</label>
                                        <input type="text" class="form-control" name="nama_pengirim" id="nama_pengirim"
                                            value="{{ old('nama_pengirim') }}">
                                        @error('nama_pengirim')
                                            <small class="text-danger text-bold">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="tx-medium">Penerima</label>
                                        <input type="text" class="form-control" name="nama_penerima" id="nama_penerima"
                                            value="{{ old('nama_penerima') }}">
                                        @error('nama_penerima')
                                            <small class="text-danger text-bold">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class=" form-group">
                                        <label>Kategori Dokumen</label>
                                        <select name="kategori_id" id="kategori_dokumen_masuk" class="form-control">
                                            <option value="">Pilih Kategori Dokumen</option>
                                            @foreach ($kategori as $item)
                                                <option value="{{ $item->id }}" @selected(old('kategori_id') == $data->id)>
                                                    {{ $item->nama_kategori }}</option>
                                            @endforeach
                                        </select>
                                        @error('kategori_id')
                                            <small class="text-danger text-bold">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="tx-medium">Lampiran Dokumen</label>
                                        <input type="file" name="file_dokumen" id="file_dokumen" class="form-control"
                                            accept=".pdf, .doc, .docx">
                                        @error('file_dokumen')
                                            <small class="text-danger text-bold">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="tx-medium">Keterangan</label>
                                        <textarea name="keterangan" rows="3" class="form-control">{{ old('keterangan') }}</textarea>
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
                                <input type="hidden" name="jenis_dokumen" value="dokumen_keluar">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label class="tx-medium">Tanggal</label>
                                        <input type="date" class="form-control" name="tanggal_keluar"
                                            id="tanggal_keluar" value="{{ old('tanggal_keluar') }}">
                                        @error('tanggal_keluar')
                                            <small class="text-danger text-bold">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="namaDinas" class="tx-medium">Dinas</label>
                                        <select id="namaDinas" name="dinas_id" class="form-control">

                                            <!-- Option list remains unchanged -->
                                            <option value="" selected>Pilih</option>
                                            @foreach ($instansi as $data)
                                                <option value="{{ $data->id }}" @selected(old('dinas_id') == $data->id)>
                                                    {{ $data->nama_instansi }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('dinas_id')
                                            <small class="text-danger text-bold">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="tx-medium">Penerima</label>
                                        <input type="text" class="form-control" name="nama_penerima"
                                            id="nama_penerima" value="{{ old('nama_penerima') }}">
                                        @error('nama_penerima')
                                            <small class="text-danger text-bold">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="tx-medium">Nama Dokumen</label>
                                        <input type="text" class="form-control" name="nama_dokumen" id="nama_dokumen"
                                            value="{{ old('nama_dokumen') }}">
                                        @error('nama_dokumen')
                                            <small class="text-danger text-bold">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Kategori Dokumen</label>
                                        <select name="kategori_id" id="kategori_dokumen_keluar" class="form-control">
                                            <option value="">Pilih Kategori Dokumen</option>
                                            @foreach ($kategori as $item)
                                                <option value="{{ $item->id }}" @selected(old('kategori_id') == $item->id)>
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
                                            <option value="0" @selected(old('sifat_dokumen') == '0')>Biasa</option>
                                            <option value="1" @selected(old('sifat_dokumen') == '1')>Penting</option>
                                        </select>
                                        @error('sifat_dokumen')
                                            <small class="text-danger text-bold">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="tx-medium d-block">Lampiran Dokumen</label>
                                        {{-- <input type="file" name="file_dokumen" id="file_dokumen_keluar"
                                            class="form-control {{ old('pengajuan_ke_pimpinan') == 'ya' ? 'd-none' : '' }}"
                                            accept=".pdf, .doc, .docx"> --}}
                                        <button type="button" class=" btn btn-primary" data-bs-toggle="modal"
                                            id="btnLampiran" data-bs-target="#modalLampiran" disabled>
                                            Tambahkan Lampiran dari Template </button>
                                        <small class="text-danger d-block" id="file_dokumen_keluar_error">
                                            <i>*Harap pilih kategori dokumen terlebih dahulu untuk menambahkan lampiran.</i>
                                        </small>
                                        {{-- @error('file_dokumen')
                                            <small class="text-danger text-bold">{{ $message }}</small>
                                        @enderror --}}
                                        @error('pilihTemplate')
                                            <small class="text-danger text-bold">{{ $message }}</small>
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
                                    <div class="form-group">
                                        <label class="tx-medium">Keterangan</label>
                                        <textarea name="keterangan" class="form-control">{{ old('keterangan') }}</textarea>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Simpan Dokumen</button>
                                    <button type="reset" class="btn btn-danger">Reset</button>
                                </div>
                                {{-- Modal Lampiran Dokumen --}}
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
                                                    <select id="pilihTemplate" name="pilihTemplate" class="form-control">
                                                        {{-- <option value="">Pilih Template Dokumen</option> --}}
                                                        {{-- @foreach ($template_dok as $data)
                                                            <option value="{{ $data->id }}"
                                                                @selected(old('pilihTemplate') == $data->id)>
                                                                {{ $data->nama }}</option>
                                                        @endforeach --}}
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
                                    <!-- /.modal-content -->
                                </div>
                                <input type="hidden" name="nomor_surat" id="h_nomor_surat">
                                <input type="hidden" name="nomor_urut" id="h_nomor_urut">
                            </form>
                            <!-- Submit Buttons -->
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
        let btnLampiran = document.getElementById('btnLampiran');
        let kategoriDokKeluar = document.getElementById('kategori_dokumen_keluar');
        let modalLampiran = document.getElementById('modalLampiran');

        let file_dokumen_keluar_error = document.getElementById('file_dokumen_keluar_error');

        var kategoriDokKeluarValue = '{{ old('kategori_id') }}';

        let isi_surat = false;
        var quill;

        var formMasuk = document.getElementById('formMasuk');
        var formKeluar = document.getElementById('formKeluar');

        @if (old('jenis_dokumen') == 'dokumen_masuk')
            formMasuk.style.display = 'block';
        @elseif (old('jenis_dokumen') == 'dokumen_keluar')
            formKeluar.style.display = 'block';
        @endif

        @if (old('kategori_id'))
            if (kategoriDokKeluar.value === '{{ old('kategori_id') }}') {
                document.addEventListener('DOMContentLoaded', function() {
                    // Your code to run since DOM is loaded and ready
                    fetchListTemplate();
                    pilihTemplate.value = '{{ old('pilihTemplate') }}';
                });
                document.getElementById('btnLampiran').removeAttribute('disabled');
            }
        @endif

        @if (old('pilihTemplate'))
            if (pilihTemplate.value === '{{ old('pilihTemplate') }}') {
                document.addEventListener('DOMContentLoaded', function() {
                    // Your code to run since DOM is loaded and ready
                    fetching({{ old('pilihTemplate') }});
                });
            }
        @endif

        kategoriDokKeluar.addEventListener('change', function() {
            kategoriDokKeluarValue = this.value;
            if (this.value !== '') {
                document.getElementById('btnLampiran').removeAttribute('disabled');
                file_dokumen_keluar_error.classList.replace('d-block', 'd-none');

            } else {
                document.getElementById('btnLampiran').setAttribute('disabled', true);
                file_dokumen_keluar_error.classList.replace('d-none', 'd-block');
            }
            fieldSet.innerHTML = '';
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
                    form_loading.classList.replace('d-flex', 'd-none')
                });
            fetch('/admin/tambah_dokumen/ambilnomorsurat/' + kategoriDokKeluarValue)
                .then(response => response.json())
                .then(data => {
                    var dataNomorSurat = data.nomor_surat;
                    var nomorSuratEl = document.getElementById('NOMOR_SURAT');
                    var nomorSuratHidden = document.getElementById('h_nomor_surat');
                    var nomorUrutHidden = document.getElementById('h_nomor_urut');
                    if (nomorSuratEl) {
                        nomorSuratEl.value = dataNomorSurat;
                    }
                    if (nomorSuratHidden) {
                        nomorSuratHidden.value = dataNomorSurat;
                    }
                    if (nomorUrutHidden) {
                        nomorUrutHidden.value = data.nomor_urut;
                    }
                });
        }

        const fetchListTemplate = async () => {
            fetch('/admin/tambah_dokumen/list_template/' + kategoriDokKeluarValue)
                .then(response => response.json())
                .then(data => {
                    pilihTemplate.innerHTML = '';
                    if (data.length === 0) {
                        alert('Tidak ada template yang tersedia untuk kategori dokumen ini.');
                        pilihTemplate.innerHTML = '<option value="">Tidak ada template yang tersedia</option>';
                        return;
                    }
                    pilihTemplate.innerHTML = '<option value="">Pilih Template Dokumen</option>';
                    data.forEach(item => {
                        pilihTemplate.innerHTML += `<option value="${item.id}">${item.nama}</option>`;
                    });
                })
        }

        btnLampiran.addEventListener('click', function() {
            fetchListTemplate();
            pilihTemplate.value = '{{ old('pilihTemplate') }}';
        });

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


        document.getElementById('jenis_dokumen').addEventListener('change', function() {
            var type = this.value;

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
@endpush
