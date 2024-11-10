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
                        Detail Template
                    </div>
                    <div class="card-body">

                        <div class="content">
                            <div class="row">
                                <div class="col-sm-15 col-md-6">

                                    <div class="form-group">
                                        <label>Nama Dokumen</label>
                                        <input type="text" name="nama_dokumen" class="form-control" readonly
                                            value="{{ $data->nama ?? old('nama_dokumen') }}">
                                        <div class="text-danger">
                                            @error('nama_dokumen')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <label>Kategori Dokumen</label>
                                        <select name="kategori_dokumen" id="kategori_dokumen" class="form-control" readonly>
                                            <option value="">Pilih Kategori</option>
                                            @foreach ($kategori as $item)
                                                <option value="{{ $item->id }}"
                                                    {{ $data->dokumen_kategori_id == $item->id ? 'selected' : '' }}>
                                                    {{ $item->nama_kategori }}</option>
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
                                        <input type="file" name="file_template" class="form-control" readonly
                                            value="{{ old('file_template') }}">
                                        <div class="text-danger">
                                            @error('file_template')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <a href="{{ route('admin.template_dokumen') }}"
                                            class="btn btn-sm btn-secondary">Kembali</a>
                                        <a href="{{ route('admin.template_dokumen.edit', $data->id) }}"
                                            class="btn btn-sm btn-warning">Edit</a>
                                        <a href="#" data-bs-toggle="modal"
                                            data-bs-target="#delete{{ $data->id }}"
                                            class="btn btn-sm btn-danger">Hapus</a>
                                    </div>

                                </div>
                                <div class="col-md-6">

                                    <div class="flex-grow-1 d-flex flex-row">
                                        {{-- <details class="docx-thumbnails h-100">
                                            <summary></summary>
                                            <div id="thumbnails-container" class="docx-thumbnails-container"></div>
                                        </details> --}}
                                        <div id="document-container" class="overflow-auto flex-grow-1 h-100"></div>
                                    </div>

                                    <!-- Frame -->
                                    {{-- <iframe src="{{ asset('/laraview/#../storage/' . $data->file) }}" width="100%"
                                        height="500px"></iframe> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal modal-danger fade" id="delete{{ $data->id }}">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Hapus {{ $data->nama }}</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Apakah anda yakin ingin menghapus data ini?</p>
                </div>
                <div class="modal-footer">
                    <a href="{{ route('admin.template_dokumen.delete', $data->id) }}"
                        class="btn btn-outline btn-danger">Ya, Hapus!</a>
                    <button type="button" class="btn btn-outline btn-primary pull-left"
                        data-bs-dismiss="modal">Tidak!</button>
                </div>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->

    <script type="module">
        let currentDocument = null;
        const docxOptions = Object.assign(docx.defaultOptions, {
            debug: true,
            experimental: true,
            breakPages: true,
            inWrapper: true,
            useBase64URL: true,
            ignoreHeight: true,
            // ignoreWidth: true,
            trimXmlDeclaration: true,
            ignoreLastRenderedPageBreak: true,
            renderHeaders: true,
            renderFooters: true,
            renderFootnotes: true,
            renderEndnotes: true,
        });

        const container = document.querySelector("#document-container");

        async function renderDocx(file) {
            currentDocument = file;

            if (!currentDocument)
                return;

            // optional, find and convert all tiff images
            let docxBlob = preprocessTiff(currentDocument);
            // render document
            let res = await docx.renderAsync(docxBlob, container, null, docxOptions)
            // optional - render thumbnails
            renderThumbnails(container, document.querySelector("#thumbnails-container"));
            // console.log(res);
        }


        fetch("{{ Storage::url($data->file) }}")
            .then(response => response.blob())
            .then(blob => {
                // console.log("Fetched the file:", blob);
                const file = new File([blob],
                    "{{ pathinfo($data->file, PATHINFO_FILENAME) . '.' . pathinfo($data->file, PATHINFO_EXTENSION) }}", {
                        type: blob.type
                    });
                // console.log("Created a file:", file);

                // const reader = new FileReader();
                // reader.onloadend = () => {
                //     const base64data = reader.result;
                // };
                // reader.readAsDataURL(blob);
                renderDocx(file);
            })
            .catch(error => console.error('Error fetching the file:', error));
    </script>
@endsection
