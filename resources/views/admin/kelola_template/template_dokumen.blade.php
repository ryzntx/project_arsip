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
                    <div class="d-flex">
                        <a href="/admin/template_dokumen/add" class="btn btn-primary my-2 btn-icon-text">
                            <i class="fe fe-plus"></i>
                            Tambah Template
                        </a>
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
                                        <label class="main-content-label my-auto pt-2">TEMPLATE DOKUMEN</label>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table mb-0" id="templateDokumen-table" style="width: 100%">
                                        <thead>
                                            <tr class="border-bottom">
                                                <th style="text-align: center;">No</th>
                                                <th style="text-align: center;">Nama Dokumen</th>
                                                <th style="text-align: center;">Kategori Template</th>
                                                <th style="text-align: center;">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data as $items)
                                                <tr>
                                                    <td style="text-align: center;">{{ $loop->iteration }}</td>
                                                    <td style="text-align: center;">{{ $items->nama }}</td>
                                                    <td style="text-align: center;">{{ $items->kategori->nama_kategori }}
                                                    </td>
                                                    <td>
                                                        <a href="/admin/template_dokumen/lihat/{{ $items->id }}"
                                                            class="btn btn-primary btn-sm">
                                                            <i class="fe fe-eye"></i>
                                                        </a>
                                                        <a href="/admin/template_dokumen/edit/{{ $items->id }}"
                                                            class="btn btn-warning btn-sm">
                                                            <i class="fe fe-edit"></i>
                                                        </a>
                                                        <a href="#" data-bs-toggle="modal"
                                                            data-bs-target="#delete{{ $items->id }}"
                                                            class="btn btn-danger btn-sm">
                                                            <i class="fe fe-trash"></i>
                                                        </a>
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

    @foreach ($data as $item)
        <div class="modal modal-danger fade" id="delete{{ $item->id }}">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Hapus {{ $item->nama }}</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Apakah anda yakin ingin menghapus data ini?</p>
                    </div>
                    <div class="modal-footer">
                        <a href="{{ route('admin.template_dokumen.delete', $item->id) }}"
                            class="btn btn-outline btn-danger">Ya, Hapus!</a>
                        <button type="button" class="btn btn-outline btn-primary pull-left"
                            data-bs-dismiss="modal">Tidak!</button>
                    </div>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    @endforeach


    <script type="module">
        $('#templateDokumen-table').DataTable({
            "responsive": true,
            "autowidth": true,
        });
    </script>

@endsection
