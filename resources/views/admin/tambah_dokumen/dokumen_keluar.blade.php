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

                <!-- Template Form Dokumen Keluar -->
                <div class="row row-sm form-container" id="formKeluar">
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
                                        <select id="pilihTemplate" name="pilihTemplate" class="form-control" disabled>
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
                                <div class="card-footer">
                                    <button type="button" class=" btn btn-primary" data-bs-toggle="modal" id="btnLampiran"
                                        data-bs-target="#modalSimpan">
                                        Simpan </button>
                                    <button type="reset" class="btn btn-danger">Reset</button>
                                </div>
                                {{-- Modal Lampiran Dokumen --}}
                                <div class="modal modal-danger fade" id="modalSimpan">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Lampiran File</h4>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                {{--  --}}
                                                <div class="form-group">
                                                    <label for="namaDinas" class="tx-medium">Dinas</label>
                                                    <select id="namaDinas" name="dinas_id" class="form-control">

                                                        <!-- Option list remains unchanged -->
                                                        <option value="" selected>Pilih</option>
                                                        @foreach ($instansi as $data)
                                                            <option value="{{ $data->id }}"
                                                                @selected(old('dinas_id') == $data->id)>
                                                                {{ $data->nama_instansi }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('dinas_id')
                                                        <small class="text-danger text-bold">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                                {{-- <div class="form-group">
                                                    <label class="tx-medium">Penerima</label>
                                                    <input type="text" class="form-control" name="nama_penerima"
                                                        id="nama_penerima" value="{{ old('nama_penerima') }}">
                                                    @error('nama_penerima')
                                                        <small class="text-danger text-bold">{{ $message }}</small>
                                                    @enderror
                                                </div> --}}
                                                <div class="form-group">
                                                    <label class="tx-medium">Nama Dokumen</label>
                                                    <input type="text" class="form-control" name="nama_dokumen"
                                                        id="nama_dokumen" value="{{ old('nama_dokumen') }}">
                                                    @error('nama_dokumen')
                                                        <small class="text-danger text-bold">{{ $message }}</small>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label class="tx-medium">Sifat Dokumen</label>
                                                    <select name="sifat_dokumen" class="form-control" id="sifat_dokumen">
                                                        <option value="0" @selected(old('sifat_dokumen') == '0')>Biasa</option>
                                                        <option value="1" @selected(old('sifat_dokumen') == '1')>Penting
                                                        </option>
                                                    </select>
                                                    @error('sifat_dokumen')
                                                        <small class="text-danger text-bold">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label class="tx-medium">Keterangan</label>
                                                    <textarea name="keterangan" class="form-control">{{ old('keterangan') }}</textarea>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary">Simpan Dokumen</button>
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

        @if (old('kategori_id'))
            if (kategoriDokKeluar.value === '{{ old('kategori_id') }}') {
                document.addEventListener('DOMContentLoaded', function() {
                    // Your code to run since DOM is loaded and ready
                    fetchListTemplate();
                    pilihTemplate.value = '{{ old('pilihTemplate') }}';
                });
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

        document.addEventListener('DOMContentLoaded', function() {
            if (kategoriDokKeluarValue !== '') {
                kategoriDokKeluar.value = kategoriDokKeluarValue;
                pilihTemplate.removeAttribute('disabled');
                pilihTemplate.value = '{{ old('pilihTemplate') }}';
            }
            setTimeout(() => {
                if (kategoriDokKeluar.value !== '') {
                    fetchListTemplate();
                    pilihTemplate.value = '{{ old('pilihTemplate') }}';
                }
            }, 1000);

        });

        kategoriDokKeluar.addEventListener('change', function() {
            kategoriDokKeluarValue = this.value;
            if (this.value !== '') {
                fetchListTemplate();
                pilihTemplate.removeAttribute('disabled');
                pilihTemplate.value = '{{ old('pilihTemplate') }}';
            } else {
                pilihTemplate.setAttribute('disabled', true);
            }
            fieldSet.innerHTML = '';
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
