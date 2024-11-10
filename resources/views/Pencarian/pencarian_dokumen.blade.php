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
                                        Value="{{ request()->query('query') }}" placeholder="Pencarian Dokumen.....">

                                    <button class="btn ripple btn-primary" type="button"><i class="fa fa-search"></i> Cari
                                        Data</button>
                                </div>

                            </div>
                        </div>
                        @foreach ($pencarian as $item)
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
                        @endforeach
                    </div>
                    <!-- /row -->
                </div>
            </div>
        </div>
    </div>

@endsection
