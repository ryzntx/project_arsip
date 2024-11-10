@extends('layout.index')
@section('title', 'Pencarian Dokumen')
@section('content')
<div class="main-content side-content pt-0">

    <div class="main-container container-fluid">
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
                        <div class="card-body">
                            <div class="mb-2 d-flex flex-column">
                                <h2 class="font-weight-bold text-primary">{{$dokumen->nama_dokumen}}</h2>
                                <h6 class="tx-16 font-weight-semibold text-gray-500">
                                    {{$dokumen->dokumen_kategori->nama_kategori}} &mdash;
                                    {{$dokumen->instansi->nama_instansi}}</h6>
                                <span class="tx-14 text-muted">
                                    {{$jenis_dokumen}} &mdash;
                                    {{$dokumen->tanggal_masuk ?? $dokumen->tanggal_keluar}}
                                </span>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /row -->
            </div>
        </div>
    </div>
</div>

@endsection


<!-- <p>{{$dokumen->penerima}}</p>
    <p>{{$dokumen->pengirim}}</p>
    <p>{{$dokumen->lampiran}}</p>
    <p>{{$dokumen->keterangan}}</p>
    <p>{{$dokumen->status}}</p>
    <p>{{$dokumen->persetujuan}}</p>
    <p>{{$dokumen->bukti_diterima}}</p> -->