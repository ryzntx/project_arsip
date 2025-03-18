@extends('layout.index')
@section('title', 'Log Aktivitas Sistem')
@section('content')
    <div class="pt-0 main-content side-content">
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
                <div class="text-center page-header" style="margin-bottom: 20px;">
                    <div>
                        <h2 class="main-content-label tx-24 mg-b-5"
                            style="color: darkslateblue; font-weight: bold; text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.3);">
                            <i class="fe fe-file-text" style="margin-right: 10px; font-size: 24px;"></i>
                            LOG AKTIVITAS SISTEM
                        </h2>
                    </div>
                </div>
                <div class="col-md-12" id="left-panel">
                    <div class="card custom-card">
                        <div class="card-body">
                            <div class="mb-3 row">
                                <div class="col-md-2">
                                    <label for="filterUserId">Pengguna</label>
                                    <select id="filterUserId" class="form-control">
                                        <option value="">Semua</option>
                                        @foreach ($users as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                    {{-- <input type="text" id="filterUserId" class="form-control"
                                        placeholder="Masukkan User ID"> --}}
                                </div>
                                <div class="col-md-2">
                                    <label for="filterTable">Nama Tabel</label>
                                    <select id="filterTable" class="form-control">
                                        <option value="">Semua</option>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label for="filterLog">Jenis Log</label>
                                    <select id="filterLog" class="form-control">
                                        <option value="">Semua</option>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label for="filterDateFrom">Dari Tanggal</label>
                                    <input type="date" id="filterDateFrom" class="form-control">
                                </div>
                                <div class="col-md-2">
                                    <label for="filterDateTo">Sampai Tanggal</label>
                                    <input type="date" id="filterDateTo" class="form-control">
                                </div>
                                <div class="mt-2 col-md-12 text-end">
                                    <button id="applyFilter" class="btn btn-primary">Terapkan Filter</button>
                                    <button id="resetFilter" class="btn btn-secondary">Reset</button>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table mb-0" id="logAktivitas-table" style="width: 100%">
                                    <thead>
                                        <tr class="border-bottom" style="text-align: center;">
                                            <th>No</th>
                                            <th>Waktu</th>
                                            <th>Jenis Log</th>
                                            <th>Dilakukan Oleh</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Detail Log -->
    <div class="modal fade" id="logDetailModal" tabindex="-1" aria-labelledby="logDetailModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="logDetailModalLabel">Detail Log Aktivitas</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>ID Log</th>
                            <td id="logId"></td>
                        </tr>
                        <tr>
                            <th>User</th>
                            <td id="logUser"></td>
                        </tr>
                        <tr>
                            <th>Waktu</th>
                            <td id="logDatetime"></td>
                        </tr>
                        <tr>
                            <th>Jenis Log</th>
                            <td id="logType"></td>
                        </tr>
                        <tr>
                            <th>IP Address</th>
                            <td id="logIp"></td>
                        </tr>
                        <tr>
                            <th>User Agent</th>
                            <td id="logUserAgent"></td>
                        </tr>
                        <tr>
                            <th>Nama Tabel</th>
                            <td id="logTable"></td>
                        </tr>
                        <tr>
                            <th>Data Sebelumnya</th>
                            <td>
                                <div class="log-data-container">
                                    <pre id="logPrevData"></pre>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th>Data Sekarang</th>
                            <td>
                                <div class="log-data-container">
                                    <pre id="logCurrData"></pre>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            // Ambil filter dari API
            $.get("{{ url('api/logs/filter-options') }}", function(response) {
                // Populate Table Names
                response.table_names.forEach(function(table) {
                    $("#filterTable").append(`<option value="${table}">${table}</option>`);
                });

                // Populate Log Types
                response.log_types.forEach(function(log) {
                    $("#filterLog").append(`<option value="${log}">${log}</option>`);
                });
            });

            let table = $('#logAktivitas-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: function(data, callback, settings) {
                    let page = Math.ceil(data.start / data.length) + 1;

                    let params = {
                        page: page,
                        itemsPerPage: data.length,
                        userId: $("#filterUserId").val(),
                        logType: $("#filterLog").val(),
                        tableName: $("#filterTable").val(),
                        dateFrom: $("#filterDateFrom").val(),
                        dateTo: $("#filterDateTo").val()
                    };

                    $.ajax({
                        url: "{{ url('api/logs') }}",
                        type: "GET",
                        data: params,
                        success: function(response) {
                            callback({
                                draw: data.draw,
                                recordsTotal: response.total,
                                recordsFiltered: response.total,
                                data: response.data
                            });
                        }
                    });
                },
                columns: [{
                        data: null,
                        render: function(data, type, row, meta) {
                            return meta.row + 1;
                        }
                    },
                    {
                        data: "log_datetime",
                        render: function(data, type, row) {
                            let formattedDate = new Date(data).toLocaleString("id-ID", {
                                year: "numeric",
                                month: "long",
                                day: "numeric",
                                hour: "2-digit",
                                minute: "2-digit",
                                second: "2-digit"
                            });
                            return `${formattedDate} <br> <small class="text-muted">(${row.humanize_datetime})</small>`;
                        }
                    },
                    {
                        data: "log_type"
                    },
                    {
                        data: "user.name",
                        render: function(data, type, row) {
                            return data +
                                `<br><small class="text-muted">(${row.user.email})</small>`;
                        }
                    },
                    {
                        data: null,
                        render: function(data, type, row) {
                            return `<button class="btn btn-primary btn-sm btn-detail" data-id="${row.id}">Detail</button>`;
                        }
                    }
                ],
                columnDefs: [{
                    className: "text-center",
                    targets: "_all"
                }],
                lengthMenu: [5, 10, 25, 50, 100],
                pageLength: 10,
                order: [
                    [1, 'desc']
                ]
            });

            // Event listener untuk menampilkan modal detail
            $('#logAktivitas-table tbody').on('click', '.btn-detail', function() {
                let logId = $(this).data('id');

                $.ajax({
                    url: `{{ url('api/logs') }}/${logId}`,
                    type: "GET",
                    success: function(response) {
                        let log = response;

                        $('#logId').text(log.id);
                        $('#logUser').html(log.user.name +
                            `<br><small class="text-muted ">(${log.user.email})</small>`);
                        $('#logDatetime').html(new Date(log.log_datetime).toLocaleString(
                                "id-ID") +
                            `<br><small class="text-muted">(${log.humanize_datetime})</small>`
                        );
                        $('#logType').text(log.log_type);
                        $('#logIp').text(log.request_info.ip);
                        $('#logUserAgent').text(log.request_info.user_agent);
                        $('#logTable').text(log.table_name ?? "-");
                        $('#logPrevData').text(JSON.stringify(log.data, null, 2) ?? "-");
                        $('#logCurrData').text(JSON.stringify(log.current_data, null, 2) ??
                            "-");

                        $('#logDetailModal').modal('show');
                    }
                });
            });

            // Event listener untuk filter otomatis tanpa refresh
            $(".filter").on("change", function() {
                table.ajax.reload(); // Reload tabel saat filter berubah
            });

            // Event Listener untuk Tombol Filter
            $("#applyFilter").on("click", function() {
                table.ajax.reload();
            });

            // Reset Filter
            $("#resetFilter").on("click", function() {
                $("#filterUserId").val('');
                $("#filterTable").val('');
                $("#filterLog").val('');
                $("#filterDateFrom").val('');
                $("#filterDateTo").val('');
                table.ajax.reload();
            });
        });
    </script>
@endpush
