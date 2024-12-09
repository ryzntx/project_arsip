@extends('layout.index')
@section('title', 'Rekapan Dokumen')
@section('content')

    <div class="main-content side-content pt-0">

        <div class="main-container container-fluid">
            <div class="inner-body">

                <!-- Page Header -->
                <div class="page-header text-center" style="margin-bottom: 20px;">

                        <h2 class="main-content-label tx-24 mg-b-5" style="color: darkslateblue; font-weight: bold; text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.3);">
                            <i class="fas fa-book" style="margin-right: 10px; font-size: 28px;"></i>
                            LAPORAN
                        </h2>

                    <div class="d-flex">
                        <div class="justify-content-center">

                            @if (request()->query() != null)
                                <a href="{{ route('admin.rekap_dokumen') }}" class="btn btn-danger btn-icon-text my-2 me-2">
                                    <i class="fa fa-close me-2"></i>Reset Filter
                                </a>
                            @endif
                            <button type="button" class="btn btn-white btn-icon-text my-2 me-2" data-bs-toggle="offcanvas"
                                href="#filterMenu" role="button" aria-controls="filterMenu">
                                <i class="fe fe-filter me-2"></i> Filter
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
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($dokumen_rekapan as $data)
                                                <tr style="text-align: center;">
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $data->nama_dokumen }}</td>
                                                    <td>{{ $data->instansi->singkatan_instansi }}</td>
                                                    <td>{{ $data->dokumen_kategori->nama_kategori }}</td>
                                                    <td>{{ $data->penerima }}</td>
                                                    <td>{{ $data->pengirim }}</td>
                                                    <td>{{ $data->tanggal_masuk ?? $data->tanggal_keluar }}</td>
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

    <!-- Filter Menu -->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="filterMenu" aria-labelledby="filterMenuLabel"
        data-bs-scroll="true">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="filterMenuLabel">Filter Laporan</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div class="overflow-y-auto">
                <form action="" method="get">
                    <h5 class="m-0">Filter Data</h5>
                    <hr class="border-bottom border-3 mt-0">
                    <div class="form-group">
                        <label for="jenis_dokumen" class="form-label">Jenis Dokumen</label>
                        <select name="jenis_dokumen" id="jenis_dokumen" class="form-control">
                            <option value="">Pilih Jenis Arsip</option>
                            <option {{ request()->query('jenis_dokumen') == 'dokumen_masuk' ? 'selected' : '' }}
                                value="dokumen_masuk">Dokumen Masuk</option>
                            <option {{ request()->query('jenis_dokumen') == 'dokumen_keluar' ? 'selected' : '' }}
                                value="dokumen_keluar">Dokumen Keluar</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="kategori_dokumen" class="form-label">Kategori dokumen</label>
                        <select name="kategori_dokumen" id="kategori_dokumen" class="form-control">
                            <option value="">Pilih Kategori dokumen</option>
                            @foreach ($kategori as $item)
                                <option value="{{ $item->id }}"
                                    {{ request()->query('kategori_dokumen') == $item->id ? 'selected' : '' }}>
                                    {{ $item->nama_kategori }}</option>
                            @endforeach

                        </select>
                    </div>
                    <div class="form-group">
                        <label for="instansi" class="form-label">Instansi</label>
                        <select name="instansi" id="instansi" class="form-control">
                            <option value="">Pilih Instansi</option>
                            @foreach ($instansi as $item)
                                <option value="{{ $item->id }}"
                                    {{ request()->query('instansi') == $item->id ? 'selected' : '' }}>
                                    {{ $item->nama_instansi }}</option>
                            @endforeach
                        </select>
                    </div>
                    <hr class="border-bottom border-3 mt-0">
                    <h5 class="m-0">Filter Waktu</h5>
                    <small class="text-danger">Pilihlah berdasarkan bulan dan tahun, atau berdasarkan tanggal</small>
                    <hr class="border-bottom border-3 mt-0">
                    <div class="row">
                        <div class="col-6 form-group">
                            <label for="bulan" class="form-label">Bulan</label>
                            <select name="bulan" id="bulan" class="form-control">
                                <option value="">Pilih Bulan</option>
                                <option {{ request()->query('bulan') == '01' ? 'selected' : '' }} value="01">Januari
                                </option>
                                <option {{ request()->query('bulan') == '02' ? 'selected' : '' }} value="02">Februari
                                </option>
                                <option {{ request()->query('bulan') == '03' ? 'selected' : '' }} value="03">Maret
                                </option>
                                <option {{ request()->query('bulan') == '04' ? 'selected' : '' }} value="04">April
                                </option>
                                <option {{ request()->query('bulan') == '05' ? 'selected' : '' }} value="05">Mei
                                </option>
                                <option {{ request()->query('bulan') == '06' ? 'selected' : '' }} value="06">Juni
                                </option>
                                <option {{ request()->query('bulan') == '07' ? 'selected' : '' }} value="07">Juli
                                </option>
                                <option {{ request()->query('bulan') == '08' ? 'selected' : '' }} value="08">Agustus
                                </option>
                                <option {{ request()->query('bulan') == '09' ? 'selected' : '' }} value="09">
                                    September</option>
                                <option {{ request()->query('bulan') == '10' ? 'selected' : '' }} value="10">Oktober
                                </option>
                                <option {{ request()->query('bulan') == '11' ? 'selected' : '' }} value="11">
                                    November</option>
                                <option {{ request()->query('bulan') == '12' ? 'selected' : '' }} value="12">
                                    Desember</option>
                            </select>
                        </div>
                        <div class="col-6 form-group">
                            <label for="tahun" class="form-label">Tahun</label>
                            <select name="tahun" id="tahun" class="form-control">
                                <option value="">Pilih Tahun</option>
                                @for ($i = 2021; $i <= date('Y'); $i++)
                                    <option {{ request()->query('tahun') == $i ? 'selected' : '' }}
                                        value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="tanggal" class="form-label">Tanggal</label>
                        <input type="text" name="tanggal" id="tanggal" class="form-control daterange"
                            value="{{ request()->query('tanggal') }}">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-filter me-2"></i>Filter</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End Filter Menu -->

@endsection

@push('scripts')
    <script>
        // Date Range Picker
        $('input[name="tanggal"]').on('apply.daterangepicker', function(ev, picker) {
            $(this).val(picker.startDate.format('YYYY-MM-DD') + ' - ' + picker.endDate.format('YYYY-MM-DD'));
        });

        // Message for export button
        var message = '';

        @if (request()->query('bulan'))
            @php
                $bulan = [
                    '01' => 'Januari',
                    '02' => 'Februari',
                    '03' => 'Maret',
                    '04' => 'April',
                    '05' => 'Mei',
                    '06' => 'Juni',
                    '07' => 'Juli',
                    '08' => 'Agustus',
                    '09' => 'September',
                    '10' => 'Oktober',
                    '11' => 'November',
                    '12' => 'Desember',
                ];
            @endphp

            message = 'Rekapan Dokumen Bulan {{ $bulan[request()->query('bulan')] }}',

                @if (request()->query('tahun'))
                    message += ' Tahun {{ request()->query('tahun') }}',
                @endif
        @elseif (request()->query('tahun'))
            message = 'Rekapan Dokumen Tahun {{ request()->query('tahun') }}',
        @elseif (request()->query('tanggal'))
            message = 'Rekapan Dokumen Tanggal {{ request()->query('tanggal') }}',
        @endif

        $(document).ready(function() {
            $('#rekapDokumen-tabel').DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": true,
                "responsive": true,
                // export button
                dom: "<'row'<'col-sm-6'<'row gap-2'<'col-sm-12'B><'col-sm-12'l>>><'col-sm-6 align-self-center'f>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
                buttons: [{
                    extend: 'excel',
                    @if (request()->query('jenis_dokumen') == 'dokumen_masuk')
                        title: 'Rekapan Dokumen Masuk',
                    @elseif (request()->query('jenis_dokumen') == 'dokumen_keluar')
                        title: 'Rekapan Dokumen Keluar',
                    @else
                        title: 'Rekapan Dokumen Masuk dan Keluar',
                    @endif
                    messageTop: message,
                }, {
                    extend: 'print',
                    @if (request()->query('jenis_dokumen') == 'dokumen_masuk')
                        title: 'Rekapan Dokumen Masuk',
                    @elseif (request()->query('jenis_dokumen') == 'dokumen_keluar')
                        title: 'Rekapan Dokumen Keluar',
                    @else
                        title: 'Rekapan Dokumen Masuk dan Keluar',
                    @endif

                    messageTop: message,

                    autoPrint: true,
                }],
            });

        });
    </script>
@endpush
