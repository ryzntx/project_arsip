@extends('layout.index')
@section('title', 'Pencarian Dokumen')
@section('content')
    <div class="main-content side-content pt-0">

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
                        <h4 class="align-content-center my-2" style="color: rgba(109, 109, 109, 0.484)">Masukkan kata kunci atau filter pencarian Anda</h4>
                    </div>
                </div>
                    <div class="d-flex">
                        <div class="justify-content-center">
                            @if (request()->query() != null)
                                <a href="{{ route('pencarian') }}" class="btn btn-danger btn-icon-text my-2 me-2">
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

                <!-- row -->
                <div class="row row-sm">
                    <div class="col-sm-12 col-md-12">
                        <div class="card custom-card search-page">
                            <div class="card-body pb-2">
                                <form action="{{ route('pencarian') }}" method="get">
                                    <div class="input-group mb-2">
                                        <input type="text" class="form-control border-end-0" name="kata_kunci"
                                            Value="{{ request()->query('kata_kunci') }}"
                                            placeholder="Pencarian Dokumen.....">

                                        <button class="btn ripple btn-primary" type="submit"><i class="fa fa-search"></i>
                                            Cari
                                            Data</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        @forelse ($pencarian as $item)
                            <div class="card custom-card">
                                <div class="card-body">
                                    <div class="mb-2">
                                        <p class="tx-18 font-weight-semibold text-primary">{{ $item->title }}</p>
                                    </div>
                                    <p class="mb-0 text-muted">{{ mb_strimwidth($item->content, 0, 1000, '...') }}</p>
                                    <div class="mt-2">
                                        <a href="{{ route('pencarian.detail', str_replace('+', '-', urlencode(strtolower($item->title)))) }}"
                                            class="text-primary tx-15"><i class="fe fe-arrow-right me-2"></i>Lihat
                                            Selengkapnya</a>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="card custom-card">
                                <div class="card-body">
                                    <div class="mb-2">
                                        <p class="tx-18 font-weight-semibold text-primary text-center">Data Tidak Ditemukan
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforelse
                    </div>
                    <!-- /row -->
                </div>
                {{ $pencarian->links() }}
            </div>
        </div>
    </div>


@endsection
