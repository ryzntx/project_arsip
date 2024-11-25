@extends('layout.index')
@section('title', 'Pencarian Dokumen')
@section('content')


<div class="main-content side-content pt-0">

    <div class="main-container container-fluid">
        <div class="inner-body">
            <div class="card custom-card">
                <div class="card-body">
                    <div style="background-color: #6259ca;
                        padding: 50px;
                        color: white;
                        text-align: center;
                        position: relative;">

                        <img src="{{ asset('storage/logo/LOGO_PST.png') }}" alt="Logo"
                            style="width: 200px;
                            height: auto;
                            position: absolute;
                            top: 50%;
                            left: 20px;
                            transform: translateY(-50%);">

                        <h1 style="margin: 0; font-size: 1.5rem;">WEB ARSIP DOKUMEN</h1>
                        <h2 style="margin: 0; font-size: 1rem;">PT PRATAMA SOLUSI TEKNOLOGI</h2>

                        <!-- Search Bar -->
                        <div style="margin-top: 15px; position: absolute; top: 30px; right: 20px;">
                            <input type="text" placeholder="e.g. Library and Information"
                                style="padding: 8px;
                                border-radius: 20px;
                                border: none;
                                width: 200px;
                                margin-right: 10px;">

                            <button style="padding: 8px 12px;
                                border-radius: 20px;
                                border: none;
                                background-color: #ffffff;
                                color: #0c7cb6;
                                cursor: pointer;">PENCARIAN</button>
                        </div>
                    </div>

                    <div style="display: flex; align-items: flex-start; margin-top: 30px;">
                        <iframe id="pdf-viewer"
                            src="{{ asset('/laraview/#../storage/' . $dokumen->lampiran) }}" alt="Lampiran dokumen"
                            style="width: 600px; height: 600px; border: 1px solid #ddd; margin-right: 20px;" allowfullscreen
                                webkitallowfullscreen>
                        </iframe>

                        <div style="flex-grow: 1; padding: 10px; background-color: #f2f2f2; border-radius: 8px;">
                            <div style="width: 100%;">
                                <div class="buttons" style="margin-top: 10px;">
                                    <h2>Detail informasi</h2>
                                        <h3>{{ $dokumen->nama_dokumen }}</h3>
                                        <p class="tx-16 font-weight-semibold text-gray-500"><strong>
                                            {{ $dokumen->dokumen_kategori->nama_kategori }} &mdash;
                                            {{ $dokumen->instansi->nama_instansi }}</h6>
                                            </strong></p>
                                        <span class="tx-14 text-muted">
                                            {{ $jenis_dokumen }} &mdash;
                                            {{ $dokumen->tanggal_masuk ?? $dokumen->tanggal_keluar }}
                                            </span>

                                        <div style="margin-top: 30px;">
                                            <span class="tx-14 text-muted"
                                                style="padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer; margin-right: 10px;">
                                                <p>Pengirim : {{ $dokumen->pengirim }}</p>
                                                <p>Penerima : {{ $dokumen->penerima }}</p>
                                            </span>
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div style="margin-top: 20px;">
                        <a href="{{ route("pencarian") }}"
                            style="padding: 10px 20px; background-color: #333; color: white; border: none; border-radius: 5px; cursor: pointer; margin-right: 10px;">KEMBALI KE SEBELUMNYA
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



            {{-- <div class="card custom-card">
                <div class="card-header">
                    <div class="mb-2 d-flex flex-column">
                        <h2 class="font-weight-bold text-primary">{{ $dokumen->nama_dokumen }}</h2>
                        <h6 class="tx-16 font-weight-semibold text-gray-500">
                            {{ $dokumen->dokumen_kategori->nama_kategori }} &mdash;
                            {{ $dokumen->instansi->nama_instansi }}</h6>
                        <span class="tx-14 text-muted">
                            {{ $jenis_dokumen }} &mdash;
                            {{ $dokumen->tanggal_masuk ?? $dokumen->tanggal_keluar }}
                        </span>
                    </div>
                </div>
                <div class="card-body">
                    <div class="d-flex flex-row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="penerima" class="form-label">Penerima Surat</label>
                                <input type="text" class="form-control text-black" id="penerima"
                                    value="{{ $dokumen->penerima }}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="pengirim" class="form-label">Pengirim Surat</label>
                                <input type="text" class="form-control text-black" id="pengirim"
                                    value="{{ $dokumen->pengirim }}" readonly>
                            </div>
                            @if ($dokumen->persetujuan)
                                <div class="form-group">
                                    <label for="persetujuan" class="form-label">Persetujuan</label>
                                    <input type="text" class="form-control text-black" id="persetujuan"
                                        value="{{ $dokumen->persetujuan }}" readonly>
                                </div>
                            @endif
                            @if ($dokumen->status)
                                <div class="form-group">
                                    <label for="status" class="form-label">Status</label>
                                    <input type="text" class="form-control text-black" id="status"
                                        value="{{ $dokumen->status }}" readonly>
                                </div>
                            @endif
                            @if ($dokumen->bukti_diterima)
                                <div class="form-group flex-column">
                                    <label for="butki_diterima" class="form-labe">Bukti Surat Diterima</label>
                                    <img src="{{ $dokumen->bukti_diterima }}" class="img-thumbnail w-25"
                                        alt="Bukti surat {{ $dokumen->nama_dokumen }} diterima">
                                </div>
                            @endif
                        </div>
                        <div class="col-6">
                            <iframe id="pdf-viewer"
                                src="{{ asset('/laraview/#../storage/' . $dokumen->lampiran) }}" width="100%"
                                height="500px" style="border: none;" allowfullscreen
                                webkitallowfullscreen></iframe>
                        </div>
                    </div>
                </div>
            </div> --}}


        <!-- /row -->

@endsection





{{-- <div class="main-content side-content pt-0"> --}}

        {{-- <div class="main-container container-fluid">
            <div class="inner-body">

                <!-- Page Header -->
                <div class="page-header">
                    <div>
                        <h2 class="main-content-title tx-24 mg-b-5">Pencarian Dokumen</h2>
                    </div>
                </div>
                <!-- End Page Header -->

                <!-- row -->
                <div class="row row-sm">
                    <div class="col-sm-12 col-md-12">
                        <div class="card custom-card search-page">
                            <div class="card-body pb-2">

                                <div class="input-group mb-2">
                                    <input type="text" class="form-control border-end-0"
                                        placeholder="Pencarian Dokumen.....">

                                    <button class="btn ripple btn-primary" type="button"><i class="fa fa-search"></i> Cari
                                        Data</button>
                                </div>

                            </div>
                        </div>

                        <div class="card custom-card">
                            <div class="card-header">
                                <div class="mb-2 d-flex flex-column">
                                    <h2 class="font-weight-bold text-primary">{{ $dokumen->nama_dokumen }}</h2>
                                    <h6 class="tx-16 font-weight-semibold text-gray-500">
                                        {{ $dokumen->dokumen_kategori->nama_kategori }} &mdash;
                                        {{ $dokumen->instansi->nama_instansi }}</h6>
                                    <span class="tx-14 text-muted">
                                        {{ $jenis_dokumen }} &mdash;
                                        {{ $dokumen->tanggal_masuk ?? $dokumen->tanggal_keluar }}
                                    </span>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="d-flex flex-row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="penerima" class="form-label">Penerima Surat</label>
                                            <input type="text" class="form-control text-black" id="penerima"
                                                value="{{ $dokumen->penerima }}" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="pengirim" class="form-label">Pengirim Surat</label>
                                            <input type="text" class="form-control text-black" id="pengirim"
                                                value="{{ $dokumen->pengirim }}" readonly>
                                        </div>
                                        @if ($dokumen->persetujuan)
                                            <div class="form-group">
                                                <label for="persetujuan" class="form-label">Persetujuan</label>
                                                <input type="text" class="form-control text-black" id="persetujuan"
                                                    value="{{ $dokumen->persetujuan }}" readonly>
                                            </div>
                                        @endif
                                        @if ($dokumen->status)
                                            <div class="form-group">
                                                <label for="status" class="form-label">Status</label>
                                                <input type="text" class="form-control text-black" id="status"
                                                    value="{{ $dokumen->status }}" readonly>
                                            </div>
                                        @endif
                                        @if ($dokumen->bukti_diterima)
                                            <div class="form-group flex-column">
                                                <label for="butki_diterima" class="form-labe">Bukti Surat Diterima</label>
                                                <img src="{{ $dokumen->bukti_diterima }}" class="img-thumbnail w-25"
                                                    alt="Bukti surat {{ $dokumen->nama_dokumen }} diterima">
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-6">
                                        <iframe id="pdf-viewer"
                                            src="{{ asset('/laraview/#../storage/' . $dokumen->lampiran) }}" width="100%"
                                            height="500px" style="border: none;" allowfullscreen
                                            webkitallowfullscreen></iframe>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- /row -->
                </div>
            </div>
        </div> --}}
    {{-- </div> --}}

{{-- @endsection --}}


