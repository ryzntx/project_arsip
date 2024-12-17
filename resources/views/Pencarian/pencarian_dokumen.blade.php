@extends('layout.index')
@section('title', 'Pencarian Dokumen')
@section('content')
    <div class="pt-0 main-content side-content">

        <div class="main-container container-fluid">
            <div class="inner-body">

                <!-- Page Header -->
                <div class="page-header" style="margin-bottom: 1px; display: flex; flex-direction: column; align-items: center;">
                    <div class="text-center">
                        <h2 class="main-content-label" style="font-weight: bold; font-size: 34px; margin-right: 20px; ">
                            <span style="color: #58508d;">C</span>
                            <span style="color: #6259ca;">A</span>
                            <span style="color: #bc5090;">R</span>
                            <span style="color: #ff6361;">I</span>
                            <span style="color: #ffa600;"></span>
                            <span style="color: #58508d;">D</span>
                            <span style="color: #6259ca;">O</span>
                            <span style="color: #bc5090;">K</span>
                            <span style="color: #ff6361;">U</span>
                            <span style="color: #ffa600;">M</span>
                            <span style="color: #58508d;">E</span>
                            <span style="color: #6259ca;">N</span>

                            <i class="ti-search" style="margin-left: 10px; font-size: 30px; color: #4285F4;"></i>
                        </h2>
                        <h4 class="my-2 align-content-center" style="color: rgba(109, 109, 109, 0.484)">Masukkan kata kunci atau filter pencarian Anda</h4>
                    </div>
                </div>

                <!-- End Page Header -->

                <!-- row -->
                <div class="row row-sm">
                    <div class="col-sm-12 col-md-12">
                        <div class="card custom-card search-page">
                            <div class="pb-2 card-body">
                                <form action="{{ request()->fullUrl() }}" method="get">
                                    <div class="mb-2 input-group">
                                        <input type="text" class="form-control" name="kata_kunci"
                                            Value="{{ request()->query('kata_kunci') }}"
                                            placeholder="Pencarian Dokumen.....">

                                        @if (request()->query())
                                            <a class="btn btn-outline-danger" href="{{ route('pencarian') }}"><i
                                                    class="fa fa-close me-2"></i>Reset</a>
                                        @endif
                                        <button class="btn btn-primary" type="submit"><i class="fa fa-search me-2"></i>Cari
                                            Data</button>
                                            <button class="btn btn-outline-secondary ripple" type="button" data-bs-toggle="offcanvas"
                                data-bs-target="#filterCanvas" aria-controls="filterCanvas"><i
                                    class="fa fa-filter me-2"></i>Filter</button>
                                    </div>
                                    <div class="offcanvas offcanvas-end" tabindex="-1" id="filterCanvas"
                                        aria-labelledby="filterCanvasLabel">
                                        <div class="offcanvas-header">
                                            <h5 class="offcanvas-title" id="filterMenuLabel">Filter Laporan</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="offcanvas"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="offcanvas-body">
                                            <div class="overflow-y-auto">
                                                {{-- <form action="{{ request()->fullUrlWithQuery([request()->query()]) }}" method="get"> --}}
                                                <h5 class="m-0">Filter Data</h5>
                                                <hr class="mt-0 border-bottom border-3">
                                                <div class="form-group">
                                                    <label for="jenis_dokumen" class="form-label">Jenis Dokumen</label>
                                                    <select name="jenis_dokumen" id="jenis_dokumen" class="form-control">
                                                        <option value="">Pilih Jenis Arsip</option>
                                                        <option
                                                            {{ request()->query('jenis_dokumen') == 'dokumen_masuk' ? 'selected' : '' }}
                                                            value="dokumen_masuk">Dokumen Masuk</option>
                                                        <option
                                                            {{ request()->query('jenis_dokumen') == 'dokumen_keluar' ? 'selected' : '' }}
                                                            value="dokumen_keluar">Dokumen Keluar</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="kategori_dokumen" class="form-label">Kategori
                                                        dokumen</label>
                                                    <select name="kategori_dokumen" id="kategori_dokumen"
                                                        class="form-control">
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
                                                <hr class="mt-0 border-bottom border-3">
                                                <h5 class="m-0">Filter Waktu</h5>
                                                <small class="text-danger">Pilihlah berdasarkan bulan dan tahun, atau
                                                    berdasarkan tanggal</small>
                                                <hr class="mt-0 border-bottom border-3">
                                                <div class="row">
                                                    <div class="col-6 form-group">
                                                        <label for="bulan" class="form-label">Bulan</label>
                                                        <select name="bulan" id="bulan" class="form-control">
                                                            <option value="">Pilih Bulan</option>
                                                            <option
                                                                {{ request()->query('bulan') == '01' ? 'selected' : '' }}
                                                                value="01">Januari
                                                            </option>
                                                            <option
                                                                {{ request()->query('bulan') == '02' ? 'selected' : '' }}
                                                                value="02">Februari
                                                            </option>
                                                            <option
                                                                {{ request()->query('bulan') == '03' ? 'selected' : '' }}
                                                                value="03">Maret
                                                            </option>
                                                            <option
                                                                {{ request()->query('bulan') == '04' ? 'selected' : '' }}
                                                                value="04">April
                                                            </option>
                                                            <option
                                                                {{ request()->query('bulan') == '05' ? 'selected' : '' }}
                                                                value="05">Mei
                                                            </option>
                                                            <option
                                                                {{ request()->query('bulan') == '06' ? 'selected' : '' }}
                                                                value="06">Juni
                                                            </option>
                                                            <option
                                                                {{ request()->query('bulan') == '07' ? 'selected' : '' }}
                                                                value="07">Juli
                                                            </option>
                                                            <option
                                                                {{ request()->query('bulan') == '08' ? 'selected' : '' }}
                                                                value="08">Agustus
                                                            </option>
                                                            <option
                                                                {{ request()->query('bulan') == '09' ? 'selected' : '' }}
                                                                value="09">
                                                                September</option>
                                                            <option
                                                                {{ request()->query('bulan') == '10' ? 'selected' : '' }}
                                                                value="10">Oktober
                                                            </option>
                                                            <option
                                                                {{ request()->query('bulan') == '11' ? 'selected' : '' }}
                                                                value="11">
                                                                November</option>
                                                            <option
                                                                {{ request()->query('bulan') == '12' ? 'selected' : '' }}
                                                                value="12">
                                                                Desember</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-6 form-group">
                                                        <label for="tahun" class="form-label">Tahun</label>
                                                        <select name="tahun" id="tahun" class="form-control">
                                                            <option value="">Pilih Tahun</option>
                                                            @for ($i = 2021; $i <= date('Y'); $i++)
                                                                <option
                                                                    {{ request()->query('tahun') == $i ? 'selected' : '' }}
                                                                    value="{{ $i }}">{{ $i }}
                                                                </option>
                                                            @endfor
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="tanggal" class="form-label">Tanggal</label>
                                                    <input type="text" name="tanggal" id="tanggal"
                                                        class="form-control daterange"
                                                        value="{{ request()->query('tanggal') }}">
                                                </div>
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-primary"><i
                                                            class="fa fa-filter me-2"></i>Filter</button>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        @forelse ($pencarian as $item)
                            <div class="card custom-card">
                                <div class="card-body">
                                    <div class="mb-2">
                                        <p class="tx-18 font-weight-semibold text-primary">{{ $item->nama_dokumen }}</p>
                                    </div>
                                    <p class="mb-0 text-muted">{{ mb_strimwidth($item->pdf_content, 0, 1000, '...') }}</p>
                                    <div class="mt-2">
                                        <a href="{{ route('pencarian.detail', str_replace('+', '-', urlencode(strtolower($item->nama_dokumen)))) }}"
                                            class="text-primary tx-15"><i class="fe fe-arrow-right me-2"></i>Lihat
                                            Selengkapnya</a>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="card custom-card">
                                <div class="card-body">
                                    <div class="mb-2">
                                        <p class="text-center tx-18 font-weight-semibold text-primary">Data Tidak Ditemukan
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforelse
                    </div>
                    <!-- /row -->
                </div>
                {{ $pencarian->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Date Range Picker
        $('input[name="tanggal"]').on('apply.daterangepicker', function(ev, picker) {
            $(this).val(picker.startDate.format('YYYY-MM-DD') + ' - ' + picker.endDate.format('YYYY-MM-DD'));
        });
    </script>
@endpush
