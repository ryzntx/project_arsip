@extends('layout.index')
@section('title', 'Rekapan Dokumen')
@section('content')

<div class="main-content side-content pt-0">

    <div class="main-container container-fluid">
        <div class="inner-body">

            <!-- Page Header -->
            <div class="page-header">
                <div>
                    <h2 class="main-content-label tx-24 mg-b-5" style="color:darkslateblue">LAPORAN DOKUMEN</h2>
                </div>
                <div class="d-flex">
                    <div class="justify-content-center">
                        <button type="button" class="btn btn-white btn-icon-text my-2 me-2">
                            <i class="fe fe-filter me-2"></i> Filter
                        </button>
                        <button type="button" class="btn btn-primary my-2 btn-icon-text">
                            <i class="fe fe-download-cloud me-2"></i> Cetak Rekapan
                        </button>
                    </div>
                </div>
            </div>
            <!-- End Page Header -->

            <!-- Row -->
            <div class="row row-sm">
                <!-- Left Panel (Daftar Dokumen) -->
                <div class="col-md-12" id="left-panel">
                    <div class="card custom-card">
                        <div class="card-header  border-bottom-0 pb-0">
                            <div>
                                <div class="d-flex">
                                    <label class="main-content-label my-auto pt-2">Rekap dokumen</label>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table mb-0" id="rekapDokumen-tabel" style="width: 100%">
                                    <thead>
                                        <tr class="border-bottom" style="text-align: center;">
                                            <th>No</th>
                                            <th>Nama Dokumen</th>
                                            <th>Dinas</th>
                                            <th>Kategori</th>
                                            <th>Pengirim</th>
                                            <th>Penerima</th>
                                            <th>Tanggal</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($dokumen_rekapan as $data)
                                        <tr style="text-align: center;">
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $data->nama_dokumen }}</td>
                                            <td>{{ $data->instansi->singkatan_instansi }}</td>
                                            <td>{{ $data->dokumen_kategori->nama_kategori }}</td>
                                            <td>{{ $data->nama_pengirim }}</td>
                                            <td>{{ $data->nama_penerima }}</td>
                                            <td>{{ $data->tanggal_masuk }}</td>
                                            <td>
                                                <div class="d-flex justify-content-center gap-1">
                                                    <a href="#"
                                                        target="_blank" class="btn btn-primary btn-sm">Cetak</a>
                                                </div>
                                            </td>
                                        </tr>

                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                <!-- End Row -->
        </div>
    </div>
</div>





    @endsection
