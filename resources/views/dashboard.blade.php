@extends('layout.index')
@section('title', 'Dashboard')

@section('content')
    <!-- Main Content-->
    <div class="pt-0 main-content side-content">

        <div class="main-container container-fluid">
            <div class="inner-body">

                <!-- Page Header -->
                <div class="page-header">
                    <div>
                        <h2 class="main-content-title tx-24 mg-b-5">Dashboard</h2>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Beranda</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                        </ol>
                    </div>
                </div>
                <!-- End Page Header -->

                <!--Row-->
                <div class="row row-sm">
                    <div class="col-sm-12 col-lg-12 col-xl-14">

                        <!--Row-->
                        <div class="row row-sm mt-lg-4">
                            <div class="col-sm-12 col-lg-12 col-xl-12">
                                <div class="card bg-primary custom-card card-box">
                                    <div class="p-4 card-body">
                                        <div class="row align-items-center">
                                            <div class="offset-xl-3 offset-sm-6 col-xl-8 col-sm-6 col-12 img-bg ">
                                                <h4 class="mb-3 d-flex">
                                                    <span class="text-white font-weight-bold ">Selamat Datang,
                                                        {{ auth()->user()->name }}!</span>
                                                </h4>
                                                <p class="mb-1 tx-white-7">You have two projects to finish, you had
                                                    completed <b class="text-warning">57%</b> from your montly
                                                    level,
                                                    Keep going to your level
                                            </div>
                                            <img src="{{ asset('assets/img/pngs/29.png') }}" alt="user-img">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--Row -->

                        <!--Overview Data-->
                        <div class="row row-sm">
                            <div class="col-sm-12 col-md-6 col-lg-6 col-xl-4">
                                <div class="card custom-card">
                                    <div class="card-body">
                                        <div class="card-item">
                                            <div class="card-item-icon card-icon">
                                                <svg class="text-primary" xmlns="http://www.w3.org/2000/svg"
                                                    enable-background="new 0 0 24 24" height="24" viewBox="0 0 24 24"
                                                    width="24">
                                                    <g>
                                                        <rect height="14" opacity=".3" width="14" x="5" y="5" />
                                                        <g>
                                                            <rect fill="none" height="24" width="24" />
                                                            <g>
                                                                <path
                                                                    d="M19,3H5C3.9,3,3,3.9,3,5v14c0,1.1,0.9,2,2,2h14c1.1,0,2-0.9,2-2V5C21,3.9,20.1,3,19,3z M19,19H5V5h14V19z" />
                                                                <rect height="5" width="2" x="7" y="12" />
                                                                <rect height="10" width="2" x="15" y="7" />
                                                                <rect height="3" width="2" x="11" y="14" />
                                                                <rect height="2" width="2" x="11" y="10" />
                                                            </g>
                                                        </g>
                                                    </g>
                                                </svg>
                                            </div>
                                            <div class="mb-2 card-item-title">
                                                <label class="mb-1 main-content-label tx-13 font-weight-bold">Total
                                                    Arsip</label>
                                                <span class="mb-0 d-block tx-12 text-muted"></span>
                                            </div>
                                            <div class="card-item-body">
                                                <div class="card-item-stat">
                                                    <h4 class="font-weight-bold">{{ $total_dokumen }}</h4>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-4">
                                <div class="card custom-card">
                                    <div class="card-body">
                                        <div class="card-item">
                                            <div class="card-item-icon card-icon">
                                                <svg class="text-primary" xmlns="http://www.w3.org/2000/svg" height="24"
                                                    viewBox="0 0 24 24" width="24">
                                                    <path d="M0 0h24v24H0V0z" fill="none" />
                                                    <path
                                                        d="M12 4c-4.41 0-8 3.59-8 8s3.59 8 8 8 8-3.59 8-8-3.59-8-8-8zm1.23 13.33V19H10.9v-1.69c-1.5-.31-2.77-1.28-2.86-2.97h1.71c.09.92.72 1.64 2.32 1.64 1.71 0 2.1-.86 2.1-1.39 0-.73-.39-1.41-2.34-1.87-2.17-.53-3.66-1.42-3.66-3.21 0-1.51 1.22-2.48 2.72-2.81V5h2.34v1.71c1.63.39 2.44 1.63 2.49 2.97h-1.71c-.04-.97-.56-1.64-1.94-1.64-1.31 0-2.1.59-2.1 1.43 0 .73.57 1.22 2.34 1.67 1.77.46 3.66 1.22 3.66 3.42-.01 1.6-1.21 2.48-2.74 2.77z"
                                                        opacity=".3" />
                                                    <path
                                                        d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm.31-8.86c-1.77-.45-2.34-.94-2.34-1.67 0-.84.79-1.43 2.1-1.43 1.38 0 1.9.66 1.94 1.64h1.71c-.05-1.34-.87-2.57-2.49-2.97V5H10.9v1.69c-1.51.32-2.72 1.3-2.72 2.81 0 1.79 1.49 2.69 3.66 3.21 1.95.46 2.34 1.15 2.34 1.87 0 .53-.39 1.39-2.1 1.39-1.6 0-2.23-.72-2.32-1.64H8.04c.1 1.7 1.36 2.66 2.86 2.97V19h2.34v-1.67c1.52-.29 2.72-1.16 2.73-2.77-.01-2.2-1.9-2.96-3.66-3.42z" />
                                                </svg>
                                            </div>
                                            <div class="mb-2 card-item-title">
                                                <label class="mb-1 main-content-label tx-13 font-weight-bold">Total Arsip
                                                    Masuk</label>
                                            </div>
                                            <div class="card-item-body">
                                                <div class="card-item-stat">
                                                    <h4 class="font-weight-bold">{{ $total_dokumen_masuk }}</h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-4">
                                <div class="card custom-card">
                                    <div class="card-body">
                                        <div class="card-item">
                                            <div class="card-item-icon card-icon">
                                                <svg class="text-primary" xmlns="http://www.w3.org/2000/svg" height="24"
                                                    viewBox="0 0 24 24" width="24">
                                                    <path d="M0 0h24v24H0V0z" fill="none" />
                                                    <path
                                                        d="M12 4c-4.41 0-8 3.59-8 8s3.59 8 8 8 8-3.59 8-8-3.59-8-8-8zm1.23 13.33V19H10.9v-1.69c-1.5-.31-2.77-1.28-2.86-2.97h1.71c.09.92.72 1.64 2.32 1.64 1.71 0 2.1-.86 2.1-1.39 0-.73-.39-1.41-2.34-1.87-2.17-.53-3.66-1.42-3.66-3.21 0-1.51 1.22-2.48 2.72-2.81V5h2.34v1.71c1.63.39 2.44 1.63 2.49 2.97h-1.71c-.04-.97-.56-1.64-1.94-1.64-1.31 0-2.1.59-2.1 1.43 0 .73.57 1.22 2.34 1.67 1.77.46 3.66 1.22 3.66 3.42-.01 1.6-1.21 2.48-2.74 2.77z"
                                                        opacity=".3" />
                                                    <path
                                                        d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm.31-8.86c-1.77-.45-2.34-.94-2.34-1.67 0-.84.79-1.43 2.1-1.43 1.38 0 1.9.66 1.94 1.64h1.71c-.05-1.34-.87-2.57-2.49-2.97V5H10.9v1.69c-1.51.32-2.72 1.3-2.72 2.81 0 1.79 1.49 2.69 3.66 3.21 1.95.46 2.34 1.15 2.34 1.87 0 .53-.39 1.39-2.1 1.39-1.6 0-2.23-.72-2.32-1.64H8.04c.1 1.7 1.36 2.66 2.86 2.97V19h2.34v-1.67c1.52-.29 2.72-1.16 2.73-2.77-.01-2.2-1.9-2.96-3.66-3.42z" />
                                                </svg>
                                            </div>
                                            <div class="mb-2 card-item-title">
                                                <label class="mb-1 main-content-label tx-13 font-weight-bold">Total Arsip
                                                    Keluar</label>
                                            </div>
                                            <div class="card-item-body">
                                                <div class="card-item-stat">
                                                    <h4 class="font-weight-bold">{{ $total_dokumen_keluar }}</h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--End row-->

                        <!-- Grafik Arsip -->
                        <div class="row row-sm">
                            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                                {{-- Grafik Per Bulan --}}
                                <div class="card custom-card">
                                    <div class="card-header">
                                        <div
                                            class="flex-row align-middle card-item-title d-flex justify-content-between align-content-center align-items-center">
                                            <label class="main-content-label tx-13 font-weight-bold">Rekap Arsip Per bulan
                                                Tahun
                                                {{ date('Y') }}</label>
                                            <div class="flex">
                                                <div class="dropend">
                                                    <button class="btn" type="button" data-bs-toggle="dropdown"
                                                        aria-expanded="false">
                                                        <i class="fa fa-ellipsis-h"></i>
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li>
                                                            <h6 class="dropdown-header">Filter Tahun</h6>
                                                        </li>
                                                        @foreach ($tahun as $item)
                                                            <li><a class="dropdown-item"
                                                                    href="?tahun={{ $item }}">{{ $item }}</a>
                                                            </li>
                                                        @endforeach
                                                        @if (request()->query('tahun'))
                                                            <li>
                                                                <hr class="dropdown-divider">
                                                            </li>
                                                            <li><a class="dropdown-item" href="">Reset</a></li>
                                                        @endif
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <canvas id="chartDokumenPerBulan"></canvas>
                                    </div>
                                </div>
                                {{-- Grafik Per Tahun --}}
                                <div class="card custom-card">
                                    <div class="card-header">
                                        <div
                                            class="flex-row align-middle card-item-title d-flex justify-content-between align-content-center align-items-center">
                                            <label class="main-content-label tx-13 font-weight-bold">Rekap Arsip per
                                                Tahun</label>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <canvas id="chartDokumenPerTahun"></canvas>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                                {{-- Daftar Arsip Masuk & Keluar Terbaru --}}
                                <div class="card custom-card">
                                    <div class="card-body">
                                        <label class="main-content-label tx-13 font-weight-bold">Dokumen Arsip
                                            Terkini</label>
                                        <span class="mb-2 d-block fs-12 text-muted">
                                            {{ date('d M Y') }}
                                        </span>
                                        <div class="table-responsive" style="max-height: 300px; overflow-y: auto;">
                                            <table class="table mt-2 m-b-0 transcations">
                                                <tbody>
                                                    @forelse ($dokumen_today as $item)
                                                        <tr>
                                                            <td>
                                                                <div class="align-middle d-flex ms-3">
                                                                    <div class="d-inline-block">
                                                                        <h6 class="mb-1">{{ $item->nama_dokumen }}</h6>
                                                                        <p class="mb-0 fs-13 text-muted">
                                                                            {{ $item->nama_kategori }}</p>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td class="text-end">
                                                                <div class="d-inline-block">
                                                                    <h6 class="mb-2 fs-15 fw-semibold">
                                                                        {{ $item->type }}<i
                                                                            class="fas {{ $item->type === 'Dokumen Masuk' ? 'fa-level-down-alt' : 'fa-level-up-alt' }} ms-2 text-success m-l-10"></i>
                                                                    </h6>
                                                                    <p class="mb-0 tx-11 text-muted">
                                                                        {{ $item->created_at->format('d M Y') }}</p>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @empty
                                                        <p class="text-center">Tidak ada data</p>
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                </div>

                                <div class="card custom-card">
                                    <div class="pb-0 card-header border-bottom-0">
                                        <div>
                                            <div class="d-flex"> <label class="pt-2 my-auto main-content-label">
                                                    Dokumen per Instansi
                                                </label> </div> <span class="mt-2 mb-0 d-block fs-12 text-muted">
                                                Total keseluruhan dokumen per instansi
                                            </span>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="overflow-y-auto" style="max-height: 300px;">

                                            @foreach ($dokumen_instansi as $instansis)
                                                <div class="mt-4 row justify-content-between">
                                                    <div class="flex-column col-5 d-flex">
                                                        <span
                                                            class="">{{ $instansis['instansi']->nama_instansi }}</span>
                                                        <small
                                                            class="">{{ $instansis['instansi']->singkatan_instansi }}</small>
                                                    </div>
                                                    {{-- <div class="my-auto col-3">
                                                        <div class="my-1 progress ht-6 progress-animate">
                                                            <div class="bg-info ht-6 wd-5p" role="progressbar"
                                                                aria-valuenow="{{ $instansis['total_keluar'] }}"
                                                                aria-valuemin="0"
                                                                aria-valuemax="{{ $instansis['total_keluar'] * 100 }}">
                                                            </div>
                                                        </div>
                                                        <div class="my-1 progress ht-6 progress-animate">
                                                            <div class="bg-success ht-6 wd-70p" role="progressbar"
                                                                aria-valuenow="{{ $instansis['total_masuk'] }}"
                                                                aria-valuemin="0"
                                                                aria-valuemax="{{ $instansis['total_keluar'] * 100 }}">
                                                            </div>
                                                        </div>
                                                    </div> --}}
                                                    <div class="col-4">
                                                        <div class="d-flex"> <span class="fs-13"><i
                                                                    class="text-info fe fe-arrow-up"></i><b>{{ $instansis['total_keluar'] }}</b></span>
                                                        </div>
                                                        <div class="d-flex"> <span class="fs-13"><i
                                                                    class="text-success fe fe-arrow-down"></i><b>{{ $instansis['total_masuk'] }}</b></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                            <!-- Repeat the row as needed -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- col end -->

                    {{-- Grafik Arsip --}}
                    <div class="row row-sm">
                        <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                            <div class="card custom-card">
                                <div class="card-header">
                                    <div
                                        class="flex-row align-middle card-item-title d-flex justify-content-between align-content-center align-items-center">
                                        <label class="main-content-label tx-13 font-weight-bold">Rekap Arsip per
                                            Kategori</label>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <canvas id="chartDokumenPerKategori"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>

                </div><!-- Row end -->
            </div>
        </div>
    </div>
    <!-- End Main Content-->
@endsection

@push('scripts')
    <script>
        // Initialize Canvas Context
        const ctxDokMonth = document.getElementById('chartDokumenPerBulan');
        const ctxDokYear = document.getElementById('chartDokumenPerTahun');
        const ctxDokKategori = document.getElementById('chartDokumenPerKategori');

        // Initialize Months
        const month = [
            'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        ];

        // Initialize Years
        const years = [];
        for (let year = 2020; year <= new Date().getFullYear(); year++) {
            years.push(year);
        }

        // Initialize data per year
        const dokumenMasukYearData = new Array(2024 - 2020 + 1).fill(0);
        @foreach ($dokumen_masuk_year as $item)
            dokumenMasukYearData[{{ $item->year - 2020 }}] = '{{ $item->total }}';
        @endforeach

        const dokumenKeluarYearData = new Array(2024 - 2020 + 1).fill(0);
        @foreach ($dokumen_keluar_year as $item)
            dokumenKeluarYearData[{{ $item->year - 2020 }}] = '{{ $item->total }}';
        @endforeach

        // Initialize data per month
        const dokumenMasukMonthData = new Array(12).fill(0);
        @foreach ($dokumen_masuk_month as $item)
            dokumenMasukMonthData[{{ $item->month - 1 }}] = '{{ $item->total }}';
        @endforeach

        const dokumenKeluarMonthData = new Array(12).fill(0);
        @foreach ($dokumen_keluar_month as $item)
            dokumenKeluarMonthData[{{ $item->month - 1 }}] = '{{ $item->total }}';
        @endforeach

        // Chart
        new Chart(ctxDokMonth, {
            type: 'line',
            data: {
                labels: month,
                datasets: [{
                    label: '# Total Arsip Masuk',
                    data: dokumenMasukMonthData,
                    borderWidth: 1,
                    barThickness: 20,
                }, {
                    label: '# Total Arsip Keluar',
                    data: dokumenKeluarMonthData,
                    borderWidth: 1,
                    barThickness: 20,
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return Number.isInteger(value) ? value : null;
                            }
                        }
                    }
                }
            }
        });

        new Chart(ctxDokYear, {
            type: 'bar',
            data: {
                labels: years,
                datasets: [{
                    label: '# Total Arsip Masuk',
                    data: dokumenMasukYearData,
                    borderWidth: 1,
                    barThickness: 20,
                }, {
                    label: '# Total Arsip Keluar',
                    data: dokumenKeluarYearData,
                    borderWidth: 1,
                    barThickness: 20,
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return Number.isInteger(value) ? value : null;
                            }
                        }
                    }
                }
            }
        });

        new Chart(ctxDokKategori, {
            type: 'bar',
            data: {
                labels: [
                    @foreach ($kategori_dokumen as $item)
                        '{{ $item->nama_kategori }}',
                    @endforeach
                ],
                datasets: [{
                    label: '# Total Arsip Masuk',
                    data: [
                        @foreach ($dokumen_masuk_kategori as $item)
                            '{{ $item->total }}',
                        @endforeach
                    ],
                    borderWidth: 1,
                }, {
                    label: '# Total Arsip Keluar',
                    data: [
                        @foreach ($dokumen_keluar_kategori as $item)
                            '{{ $item->total }}',
                        @endforeach
                    ],
                    borderWidth: 1,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                aspectRatio: 1,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return Number.isInteger(value) ? value : null;
                            }
                        }
                    }
                }

            }
        });
    </script>
@endpush
