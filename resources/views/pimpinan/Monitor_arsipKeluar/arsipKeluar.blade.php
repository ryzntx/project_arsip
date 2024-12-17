@extends('layout.index')
@section('title', 'Sekretaris')
@section('content')

    <div class="pt-0 main-content side-content">

        <div class="main-container container-fluid">
            <div class="inner-body">

                <!-- Page Header -->
                <div class="text-center page-header" style="margin-bottom: 20px;">
                    <div>
                        <h2 class="main-content-label tx-24 mg-b-5"
                            style="color: darkslateblue; font-weight: bold; text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.3);">
                            <i class="fas fa-folder-open" style="margin-right: 10px; font-size: 28px;"></i>
                            ARSIP DOKUMEN
                        </h2>
                    </div>
                </div>
                <!-- End Page Header -->

                <!-- Row -->
                <div class="row row-sm">
                    <!-- Left Panel (Daftar Dokumen) -->
                    <div class="col-md-12" id="left-panel">
                        <div class="card custom-card">
                            <div class="pb-0 card-header border-bottom-0">
                                <div>
                                    <div class="d-flex">
                                        <label class="pt-2 my-auto main-content-label">DOKUMEN KELUAR</label>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table mb-0" id="dokumenKeluar-tabel" style="width: 100%">
                                        <thead>
                                            <tr class="border-bottom" style="text-align: center;">
                                                <th>No</th>
                                                <th>Nama Dokumen</th>
                                                <th>Dinas</th>
                                                <th>Kategori</th>
                                                <th>Tanggal</th>
                                                <th>Status</th>
                                                <th>Bukti Diterima</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($arsip_keluar as $item)
                                                <tr style="text-align: center;">
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td class="text-wrap"
                                                        onclick="showDetails('{{ $item->dokumen_kategori->nama_kategori }}','{{ $item->nama_dokumen }}', '{{ $item->pengirim }}', '{{ $item->penerima }}', '{{ $item->instansi->nama_instansi }}', '{{ $item->tanggal_keluar }}', '{{ $item->lampiran }}')">
                                                        {{ $item->nama_dokumen }}</td>
                                                    <td>{{ $item->instansi->singkatan_instansi }}</td>
                                                    <td>{{ $item->dokumen_kategori->nama_kategori }}</td>
                                                    <td>{{ $item->tanggal_keluar }}</td>
                                                    <td class="d-flex flex-column">
                                                        @if ($item->persetujuan == 'ya')
                                                            <span
                                                                class="text-white align-middle badge bg-warning align-items-center align-content-center">
                                                                Perlu Tanda Tangan
                                                            </span>
                                                        @endif
                                                        @if ($item->status == 'Menunggu Persetujuan')
                                                            <span
                                                                class="text-white align-middle badge bg-secondary align-items-center align-content-center">
                                                                Menunggu Persetujuan
                                                            </span>
                                                        @elseif ($item->status == 'Disetujui')
                                                            <span
                                                                class="text-white align-middle badge bg-success align-items-center align-content-center">
                                                                Disetujui
                                                            </span>
                                                        @elseif ($item->status == 'Ditolak')
                                                            <span
                                                                class="text-white align-middle badge bg-danger align-items-center align-content-center">
                                                                Ditolak
                                                            </span>
                                                        @elseif ($item->status == 'Menunggu Dikirim')
                                                            <span
                                                                class="text-white align-middle badge bg-info align-items-center align-content-center">
                                                                Menunggu Dikirim
                                                            </span>
                                                        @elseif ($item->status == 'Dikirimkan')
                                                            <span
                                                                class="text-white align-middle badge bg-info align-items-center align-content-center">
                                                                Dikirimkan
                                                            </span>
                                                        @elseif ($item->status == 'Selesai')
                                                            <span
                                                                class="text-white align-middle badge bg-primary align-items-center align-content-center">
                                                                Selesai
                                                            </span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($item->bukti_dikirimkan)
                                                            <img src="{{ asset('storage/' . $item->bukti_dikirimkan) }}"
                                                                alt="Bukti Diterima"
                                                                style="max-width: 100px; max-height: 100px;">
                                                        @else
                                                            <span class="text-danger">Tidak ada bukti</span>
                                                        @endif
                                                    </td>
                                                    <td class="gap-1 d-flex justify-content-center">
                                                        <a href="{{ route('pimpinan.arsipKeluar.print', $item->id) }}"
                                                            target="_blank" class="btn btn-primary btn-sm">Cetak</a>
                                                        @if ($item->persetujuan == 'ya')
                                                            <a class="btn ripple btn-warning btn-sm"
                                                                data-bs-target="#tandatangan{{ $item->id }}"
                                                                data-bs-toggle="modal" href="#">
                                                                Tanda Tangani Dokumen</a>
                                                            {{-- <div class="confirm-dropdown-sm">
                                                        <button aria-expanded="false" aria-haspopup="true" class="btn ripple btn-secondary btn-sm dropdown-toggle" data-bs-toggle="dropdown" id="dropdownConfirm" type="button">Konfirmasi Status<i class="fas fa-caret-down ms-1"></i></button>
                                                            <div  class="dropdown-menu">
                                                                <a class="dropdown-item" data-status="Disetujui" data-bs-toggle="modal"  data-bs-target="#modalConfirmSetuju" href="#">Disetujui</a>
                                                                <a class="dropdown-item" data-status="Ditolak" data-bs-toggle="modal" data-bs-target="#modalConfirmTolak" href="#">Ditolak</a>
                                                            </div>
                                                    </div> --}}

                                                            {{-- <div class="confirm-dropdown-sm">
                                                        <button data-bs-target="#dropdownConfirm" aria-expanded="false" aria-haspopup="true" class="btn ripple btn-secondary btn-sm dropdown-toggle" data-bs-toggle="dropdown" id="dropdownConfirm" type="button">Konfirmasi Status<i class="fas fa-caret-down ms-1"></i></button>
                                                        <div  class="dropdown-menu">
                                                            <a class="dropdown-item" data-status="Disetujui" onclick="openModal(this)" href="#">Disetujui</a>
                                                            <a class="dropdown-item" data-status="Ditolak" onclick="openModal(this)" href="#">Ditolak</a>
                                                        </div>
                                                    </div> --}}

                                                            {{-- <a href="#" target="_blank" class="btn btn-danger btn-sm">
                                                        Konfirmasi status</a> --}}
                                                            <a href="{{ route('pimpinan.arsipKeluar.persetujuan_arsip_keluar', $item->id) }}"
                                                                class="btn btn-warning btn-sm">
                                                                Tanda Tangani Dokumen</a>
                                                        @endif
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

    <!-- Modal -->
    <div class="modal fade" id="lihatPDF" tabindex="-1" aria-labelledby="lihatPDFLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="lihatPDFLabel">Detail Dokumen</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Add your modal content here -->
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="kategori_dokumen" class="form-label">Kategori Dokumen</label>
                                <input type="text" name="kategori_dokumen" id="kategori_dokumen" class="form-control"
                                    readonly>
                            </div>
                            <div class="form-group">
                                <label for="nama_dokumen" class="form-label">Nama Dokumen</label>
                                <input type="text" name="nama_dokumen" id="nama_dokumen" class="form-control" readonly>
                            </div>
                            <div class="form-group">
                                <label for="pengirim" class="form-label">Pengirim</label>
                                <input type="text" name="pengirim" id="pengirim" class="form-control" readonly>
                            </div>
                            <div class="form-group">
                                <label for="penerima" class="form-label">Penerima</label>
                                <input type="text" name="penerima" id="penerima" class="form-control" readonly>
                            </div>
                            <div class="form-group">
                                <label for="dinas" class="form-label">Dinas</label>
                                <input type="text" name="dinas" id="dinas" class="form-control" readonly>
                            </div>
                            <div class="form-group">
                                <label for="tanggal_keluar" class="form-label">Tanggal</label>
                                <input type="text" name="tanggal_keluar" id="tanggal_keluar" class="form-control"
                                    readonly>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="pdf-viewer-container">
                                <iframe id="pdf-viewer" src="" width="100%" height="500px"
                                    style="border: none;" allowfullscreen webkitallowfullscreen></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end modal-->

    <!--modal button tandatangani dokumen-->
    @foreach ($arsip_keluar as $item)
        <div class="modal" id="tandatangan{{ $item->id }}">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content tx-size-sm">
                    <div class="modal-body tx-center">
                        <i class="icon ion-ios-checkmark-circle-outline tx-100 tx-warning lh-1 mg-t-20 d-inline-block"></i>
                        <h4 class="tx-warning tx-semibold mg-b-20">Disetujui</h4>
                        <p class="mg-b-20 mg-x-20" id="modalBodyTextSuccess">Apakah Anda yakin ingin mengubah status
                            menjadi Disetujui?</p>
                        <a href="{{ route('pimpinan.arsipKeluar.persetujuan_arsip_keluar', $item->id) }}"
                            class="btn ripple btn-primary" type="button" href="#"
                            style="margin-right: 10px;">Ya</a>
                        <button aria-label="Close" class="btn ripple btn-danger pd-x-25" data-bs-dismiss="modal"
                            type="button">Tidak</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    {{-- <div class="modal" id="tandatangan">
    <div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content tx-size-sm">
			<div class="modal-body tx-center">
                <div class="modal-header">
                    <h6 class="modal-title">Tandatangani dokumen</h6><button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"></button>
                </div>
            <div class="modal-body">
                <p>Apakah anda yakin ingin menandatangani dokumen keluar ini?</p>
            </div>
            <div class="modal-footer-centered">
                <button class="btn ripple btn-primary" type="button" href="#" style="margin-right: 10px;">Ya</button>
                <button class="btn ripple btn-secondary" type="button" href="#">Tidak</button>
            </div>
        </div>
        </div>
    </div>
</div> --}}
    <!--end modal-->

    <!--modal konfirmasi Disetujui-->
    <div class="modal" id="modalConfirmSetuju">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content tx-size-sm">
                <div class="modal-body tx-center">
                    <i class="icon ion-ios-checkmark-circle-outline tx-100 tx-success lh-1 mg-t-20 d-inline-block"></i>
                    <h4 class="tx-success tx-semibold mg-b-20">Disetujui</h4>
                    <p class="mg-b-20 mg-x-20" id="modalBodyTextSuccess">Apakah Anda yakin ingin mengubah status menjadi
                        Disetujui?</p>
                    <button aria-label="Close" class="btn ripple btn-success pd-x-25" data-bs-dismiss="modal"
                        type="button">Simpan</button>
                    <div class="modal-footer">
                        <a id="btnDownloadPDF" href="" target="_blank" class="btn btn-danger"><i
                                class="fa fa-file-download me-2"></i>Unduh PDF</a>
                    </div>
                </div>
            </div>
        </div>
        <!--end modal-->

        <!--modal konfirmasi Ditolak-->
        <div class="modal" id="modalConfirmTolak">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content tx-size-sm">
                    {{-- <form id="formRejection" action="{{ url('/pimpinan/arsipKeluar/tambahAlasan/' . $item->id) }}" method="POST" enctype="multipart/form-data">
                @csrf <!-- Pastikan untuk menyertakan token CSRF --> --}}
                    <div class="modal-body tx-center pd-y-20 pd-x-20">
                        <button aria-label="Close" class="btn-close float-end" data-bs-dismiss="modal"
                            type="button"></button>
                        <i class="icon ion-ios-close-circle-outline tx-100 tx-danger lh-1 mg-t-20 d-inline-block"></i>
                        <h4 class="tx-danger mg-b-20">Ditolak</h4>
                        <p class="mg-b-20 mg-x-20" id="modalBodyTextError">Silakan isi alasan penolakan di bawah ini:</p>
                        <div class="mb-3">
                            <label for="rejectionReason" class="form-label">Alasan Penolakan (Wajib diisi)</label>
                            <textarea id="rejectionReason" name="rejectionReason" class="form-control" rows="4" required></textarea>
                        </div>
                        <div class="modal-footer-centered">
                            <button class="btn ripple btn-danger pd-x-25" type="submit">Simpan</button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <!--end modal-->

        <!--untuk membuka modal konfirmasi status-->
        {{-- <script>
    function openModal(element) {
        const status = element.getAttribute('data-status');
        if (status === 'Disetujui') {
            document.getElementById('modalBodyTextSuccess').innerText = "Apakah Anda yakin ingin mengubah status menjadi " + status + "?";
            const modal = new bootstrap.Modal(document.getElementById('modalConfirmSetuju'));
            modal.show();

            // Menangani aksi tombol "Simpan" pada modal Disetujui
            document.getElementById('btnConfirmSuccess').onclick = function() {
                confirmedStatus = status; // Simpan status konfirmasi
                modal.hide(); // Sembunyikan modal
                alert('Status telah disetujui: ' + confirmedStatus); // Menampilkan alert atau mengelola logika selanjutnya
            };
        } else if (status === 'Ditolak') {
            document.getElementById('modalBodyTextError').innerText = "Jika ada ingin mengubah status menjadi " + status + " , Harap isi form dibawah!";
            const modal = new bootstrap.Modal(document.getElementById('modalConfirmTolak'));
            modal.show();

            // Menangani aksi tombol "simpan" pada modal Ditolak
            document.getElementById('btnConfirmError').onclick = function() {
                confirmedStatus = status; // Simpan status konfirmasi
                modal.hide(); // Sembunyikan modal
                alert('Status telah ditolak: ' + confirmedStatus); // Menampilkan alert atau mengelola logika selanjutnya
            };
        }
    }
</script> --}}
        <!--end-->


        <script>
            $('#dokumenKeluar-tabel').DataTable({
                "responsive": true,
                "autoWidth": true,
            });

            function showDetails(kategori_dokumen, nama_dokumen, penerima, pengirim, dinas, tanggal, pdfUrl) {
                // kita siapin dulu nih variabel nya
                var tabel = document.getElementById(
                    'dokumenKeluar-tabel'); // buat dapetin element dengan dokumenMasuk-tabel
                var modal = new bootstrap.Modal(document.getElementById('lihatPDF'));

                // Fungsi untuk menampilkan/menutup right-panel
                // Kita cek dulu nih di element dengan id dokumenMasuk-tabel itu ada class selected ga?
                if (tabel.classList.contains('selected')) {
                    // Toggle modal to show
                    modal.hide();
                    // Kalau ada kita hapus dulu
                    tabel.classList.remove('selected');
                } else {
                    modal.show();
                    // Kalau tidak ada, kita cek lagi di element id dokumenMasuk-tabel itu ada gasih class selected?
                    // tapi dengan cara kita cek di setiap baris tabel nya
                    document.querySelectorAll('#dokumenKeluar-tabel tbody tr.selected').forEach(function(row) {
                        // kalau di setiap baris tabel itu ada class selected, maka kita hapus class nya
                        row.classList.remove('selected');
                    });
                    // trus tambahin lagi class selected nya deh
                    // loh buat kenapa di tambahin lagi? biar nanti ketika baris data lain di klik itu, tetep muncul right-panel nya
                    tabel.classList.add('selected');

                }

                // trus kita tampilin deh data nya ke right-panel
                document.getElementById('kategori_dokumen').value = kategori_dokumen;
                document.getElementById('nama_dokumen').value = nama_dokumen;
                document.getElementById('penerima').value = penerima;
                document.getElementById('pengirim').value = pengirim;
                document.getElementById('dinas').value = dinas;
                document.getElementById('tanggal_keluar').value = tanggal;


                // Menampilkan PDF di iframe
                var viewer = document.getElementById('pdf-viewer');
                viewer.src = "{{ asset('/laraview/#../storage/') }}/" + pdfUrl;

                // udah deh segitu aja
            }
        </script>
    @endsection
