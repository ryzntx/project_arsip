@extends('layout.index')
@section('title', 'Kelola Template Dokumen')
@section('content')

<div class="main-content side-content pt-0">
    @if (session('pesan'))
    <div class="alert alert-primary">
        {{ session('pesan') }}
    </div>
    @endif
    @if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif
    <div class="main-container container-fluid">
        <div class="inner-body">
            <!-- Page Header -->
            <div class="page-header text-center" style="margin-bottom: 20px;">
                <div>
                    <h2 class="main-content-label tx-24 mg-b-5"
                        style="color: darkslateblue; font-weight: bold; text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.3);">
                        <i class="fe fe-file-text" style="margin-right: 10px; font-size: 24px;"></i>
                        TEMPLATE DOKUMEN
                    </h2>
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
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table mb-0" id="templateDokumen-table" style="width: 100%">
                                    <thead>
                                        <tr class="border-bottom" style="text-align: center;">
                                            <th>No</th>
                                            <th>Nama Dokumen</th>
                                            <th>Kategori Template</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $items)
                                        <tr style="text-align: center;">
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $items->nama }}</td>
                                            <td>{{ $items->kategori->nama_kategori }}</td>
                                            <td>
                                                <a href="/admin/template_dokumen/lihat/{{ $items->id }}"
                                                    class="btn btn-primary btn-sm">
                                                    <i class="fe fe-eye"></i>
                                                </a>
                                                <a href="/admin/template_dokumen/edit/{{ $items->id }}"
                                                    class="btn btn-warning btn-sm">
                                                    <i class="fe fe-edit"></i>
                                                </a>
                                                <a href="#" class="btn btn-sm btn-danger"
                                                    onclick="showDelete({{ $items->id }}, '{{ $items->nama }}')">
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

{{-- @foreach ($data as $item)
    <div class="modal" id="delete{{ $item->id }}" data-bs-backdrop="static" data-bs-keyboard="false">
<div class="modal-dialog modal-l">
    <div class="modal-content">
        <div class="modal-header">
            <h4>Hapus Data</h4>
        </div>
        <div class="modal-body">
            <h5>Hapus {{ $item->nama }}</h5>
            <p>Apakah anda yakin ingin menghapus data ini?</p>
        </div>
        <div class="modal-footer">
            <a href="{{ url('/admin/template_dokumen/delete/'.$item->id ) }}" class="btn btn-outline btn-danger">Yes</a>
            <button type="button" class="btn btn-outline btn-primary pull-left" data-bs-dismiss="modal">No</button>
        </div>
    </div>
</div>
<!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
@endforeach --}}

<script>
function showDelete(id, nama_template) {
    Swal.fire({
        title: "Apakah Anda yakin?",
        text: "Menghapus Data" + " " + nama_template,
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Ya",
        backdrop: true, // Mengaktifkan backdrop
        allowOutsideClick: false // Mencegah penutupan jika klik di luar modal
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "{{ url('/admin/template_dokumen/delete/') }}/" + id;
            Swal.fire({
                title: "Hapus Data!",
                text: "Data berhasil dihapus",
                icon: "success",
                timer: 1500, // Menampilkan pesan selama 1.5 detik
                showConfirmButton: false // Sembunyikan tombol konfirmasi
            });
        }
    });
}
</script>
<script type="module">
$('#templateDokumen-table').DataTable({
    "responsive": true,
    "autowidth": true,
});
</script>

@endsection