@extends('_layouts.app')
@section('css')
    <link href="{{ asset('komponen/app') }}/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <style>
        .trans-page {
            --ink: #1e2340;
            --muted: #8a90a8;
            --line: #eef0f6;
            --soft: #f7f8fc;
            --green: #12b886;
            --green-soft: #e6f8f1;
            --red: #f0565b;
            --red-soft: #fdecec;
            --violet: #7048e8;
            color: var(--ink);
        }

        .trans-page .d-label {
            font-size: .72rem;
            font-weight: 700;
            letter-spacing: .08em;
            text-transform: uppercase;
            color: var(--muted);
        }

        .trans-page .d-amount {
            font-weight: 800;
            font-variant-numeric: tabular-nums;
        }

        .trans-page .d-card {
            background: #fff;
            border: 1px solid var(--line);
            border-radius: 18px;
            box-shadow: 0 6px 24px rgba(30, 35, 64, .06);
        }

        /* Hero */
        .trans-page .hero {
            position: relative;
            overflow: hidden;
            border-radius: 18px;
            padding: 24px 28px;
            color: #fff;
            background: linear-gradient(135deg, #4c6ef5 0%, #7048e8 55%, #ae3ec9 100%);
            box-shadow: 0 12px 30px rgba(112, 72, 232, .3);
        }

        .trans-page .hero::before {
            content: '';
            position: absolute;
            width: 240px;
            height: 240px;
            right: -70px;
            top: -100px;
            border-radius: 50%;
            background: rgba(255, 255, 255, .1);
            pointer-events: none;
        }

        .trans-page .hero .d-label {
            color: rgba(255, 255, 255, .75);
        }

        .trans-page .hero-amount {
            font-size: clamp(1.5rem, 5vw, 2.1rem);
            line-height: 1.15;
            margin: 6px 0 4px;
            overflow-wrap: anywhere;
        }

        .trans-page .add-btn {
            position: relative;
            z-index: 1;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 11px 20px;
            border: 0;
            border-radius: 12px;
            background: #fff;
            color: #5b4be0;
            font-weight: 700;
            white-space: nowrap;
            transition: transform .15s ease;
        }

        .trans-page .add-btn:hover {
            transform: translateY(-2px);
        }

        /* Month pills */
        .trans-page .months {
            display: flex;
            gap: 6px;
            overflow-x: auto;
            padding: 4px 2px 8px;
            margin: 18px 0 6px;
            scrollbar-width: thin;
        }

        .trans-page .month {
            flex-shrink: 0;
            padding: 7px 14px;
            border-radius: 999px;
            border: 1px solid var(--line);
            background: #fff;
            color: var(--ink);
            font-size: .82rem;
            font-weight: 700;
            transition: all .15s ease;
        }

        .trans-page .month:hover {
            text-decoration: none;
            border-color: var(--violet);
            color: var(--violet);
        }

        .trans-page .month.active {
            background: var(--ink);
            border-color: var(--ink);
            color: #fff;
        }

        /* Stat tiles */
        .trans-page .stat {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 16px 18px;
            height: 100%;
        }

        .trans-page .stat-icon {
            width: 44px;
            height: 44px;
            border-radius: 14px;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .trans-page .stat .d-amount {
            font-size: 1.1rem;
            overflow-wrap: anywhere;
        }

        /* Table card */
        .trans-page .tbl-toolbar {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            padding: 18px 20px;
            border-bottom: 1px solid var(--line);
        }

        .trans-page .seg {
            display: inline-flex;
            padding: 4px;
            border-radius: 12px;
            background: var(--soft);
        }

        .trans-page .seg button {
            border: 0;
            background: transparent;
            padding: 6px 14px;
            border-radius: 9px;
            font-size: .82rem;
            font-weight: 700;
            color: var(--muted);
            cursor: pointer;
        }

        .trans-page .seg button.active {
            background: #fff;
            color: var(--ink);
            box-shadow: 0 2px 8px rgba(30, 35, 64, .08);
        }

        .trans-page .search {
            position: relative;
            flex: 0 1 260px;
            min-width: 200px;
        }

        .trans-page .search i {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--muted);
            font-size: .85rem;
        }

        .trans-page .search input {
            width: 100%;
            padding: 9px 14px 9px 38px;
            border-radius: 12px;
            border: 1px solid var(--line);
            background: var(--soft);
            font-size: .88rem;
            color: var(--ink);
        }

        .trans-page .search input:focus {
            outline: none;
            background: #fff;
            border-color: var(--violet);
            box-shadow: 0 0 0 3px rgba(112, 72, 232, .12);
        }

        .trans-page .tbl-wrap {
            padding: 6px 12px 12px;
            overflow-x: auto;
        }

        .trans-page table.dataTable {
            margin: 0 !important;
            border-collapse: separate !important;
            border-spacing: 0;
            font-size: .88rem;
        }

        .trans-page table.dataTable thead th {
            border: 0;
            border-bottom: 1px solid var(--line);
            color: var(--muted);
            font-size: .72rem;
            font-weight: 700;
            letter-spacing: .06em;
            text-transform: uppercase;
            padding: 12px 10px;
            white-space: nowrap;
        }

        .trans-page table.dataTable tbody td {
            border-top: 1px solid var(--line);
            padding: 12px 10px;
            vertical-align: middle;
        }

        .trans-page table.dataTable tbody tr:first-child td {
            border-top: 0;
        }

        .trans-page table.dataTable tbody tr:hover td {
            background: var(--soft);
        }

        .trans-page .col-no {
            color: var(--muted);
            width: 36px;
        }

        .trans-page .col-desc {
            font-weight: 600;
        }

        .trans-page .col-date,
        .trans-page .col-amount {
            white-space: nowrap;
        }

        .trans-page .col-date {
            color: var(--muted);
        }

        .trans-page .col-amount {
            text-align: right;
            font-weight: 800;
            font-variant-numeric: tabular-nums;
        }

        .trans-page .amt-up { color: var(--green); }
        .trans-page .amt-down { color: var(--red); }

        .trans-page .pill {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 3px 10px;
            border-radius: 999px;
            font-size: .72rem;
            font-weight: 700;
            white-space: nowrap;
        }

        .trans-page .pill.up { background: var(--green-soft); color: var(--green); }
        .trans-page .pill.down { background: var(--red-soft); color: var(--red); }

        .trans-page .asset-name {
            color: #4c6ef5;
            font-weight: 600;
            white-space: nowrap;
        }

        .trans-page .tag {
            display: inline-block;
            padding: 2px 9px;
            border-radius: 6px;
            background: var(--soft);
            border: 1px solid var(--line);
            font-size: .75rem;
            font-weight: 600;
            white-space: nowrap;
        }

        .trans-page .actions {
            display: inline-flex;
            gap: 4px;
        }

        .trans-page .icon-btn {
            width: 32px;
            height: 32px;
            border-radius: 10px;
            border: 0;
            background: var(--soft);
            color: var(--muted);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: .8rem;
            cursor: pointer;
            transition: all .15s ease;
        }

        .trans-page .icon-btn:hover {
            background: #edf1fe;
            color: #4c6ef5;
        }

        .trans-page .icon-btn.danger:hover {
            background: var(--red-soft);
            color: var(--red);
        }

        .trans-page .dataTables_empty {
            text-align: center;
            color: var(--muted);
            padding: 40px 0 !important;
        }

        /* DataTables footer (info + paging) */
        .trans-page .dt-foot {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
            padding: 12px 8px 0;
        }

        .trans-page .dataTables_info {
            padding: 0 !important;
            font-size: .8rem;
            color: var(--muted);
        }

        .trans-page .dataTables_paginate .pagination {
            margin: 0 !important;
            flex-wrap: wrap;
        }

        .trans-page .page-link {
            border: 0;
            border-radius: 9px !important;
            margin: 0 2px;
            color: var(--ink);
            font-weight: 700;
            font-size: .8rem;
        }

        .trans-page .page-item.active .page-link {
            background: var(--ink);
        }

        .trans-page .dataTables_processing {
            border: 0;
            border-radius: 12px;
            box-shadow: 0 6px 24px rgba(30, 35, 64, .12);
        }

        /* Mobile: each row becomes a card */
        @media (max-width: 767.98px) {
            .trans-page .search {
                flex: 1 1 100%;
            }

            .trans-page .tbl-wrap {
                padding: 8px;
                overflow: visible;
            }

            .trans-page table.dataTable thead {
                display: none;
            }

            .trans-page table.dataTable,
            .trans-page table.dataTable tbody {
                display: block;
                width: 100% !important;
            }

            .trans-page table.dataTable tbody tr {
                display: flex;
                flex-wrap: wrap;
                align-items: center;
                gap: 6px 8px;
                padding: 12px;
                margin-bottom: 8px;
                border: 1px solid var(--line);
                border-radius: 14px;
                background: #fff;
            }

            /* forces a line break after description + amount */
            .trans-page table.dataTable tbody tr::before {
                content: '';
                order: 3;
                flex-basis: 100%;
                height: 0;
            }

            .trans-page table.dataTable tbody td {
                display: block;
                border: 0 !important;
                padding: 0 !important;
                background: transparent !important;
            }

            .trans-page table.dataTable tbody tr:hover td {
                background: transparent;
            }

            .trans-page table.dataTable tbody td.dataTables_empty {
                flex-basis: 100%;
                padding: 30px 0 !important;
            }

            .trans-page td.col-no { display: none !important; }
            .trans-page td.col-desc { order: 1; flex: 1 1 0; min-width: 0; overflow-wrap: anywhere; }
            .trans-page td.col-amount { order: 2; font-size: .95rem; }
            .trans-page td.col-type,
            .trans-page td.col-asset,
            .trans-page td.col-tag { order: 4; font-size: .8rem; }
            .trans-page td.col-date { order: 5; margin-left: auto; font-size: .78rem; }
            .trans-page td.col-menu { order: 6; }

            .trans-page .dt-foot {
                justify-content: center;
            }
        }

        @media (max-width: 575.98px) {
            .trans-page .hero {
                padding: 20px;
            }

            .trans-page .add-btn {
                width: 100%;
                justify-content: center;
            }

            .trans-page .tbl-toolbar {
                padding: 14px;
            }

            .trans-page .seg {
                width: 100%;
            }

            .trans-page .seg button {
                flex: 1;
            }

            .trans-page .stat {
                padding: 14px;
            }
        }

        /* Modal */
        .trans-modal .modal-content {
            border: 0;
            border-radius: 18px;
            overflow: hidden;
            box-shadow: 0 20px 50px rgba(30, 35, 64, .25);
        }

        .trans-modal .modal-header {
            border: 0;
            padding: 18px 22px;
            background: linear-gradient(135deg, #4c6ef5, #7048e8);
        }

        .trans-modal .modal-title {
            color: #fff;
            font-weight: 700;
        }

        .trans-modal .modal-header .close {
            color: #fff;
            opacity: .8;
            text-shadow: none;
        }

        .trans-modal .modal-body {
            padding: 20px 22px 6px;
        }

        .trans-modal label {
            font-size: .8rem;
            font-weight: 700;
            color: #5a6078;
            margin-bottom: 4px;
        }

        .trans-modal .form-control,
        .trans-modal .input-group-text {
            border-radius: 12px;
            border-color: #e3e6f0;
            background: #f7f8fc;
            height: calc(1.5em + 1rem + 2px);
        }

        .trans-modal .input-group-text {
            font-weight: 700;
            color: #5a6078;
        }

        .trans-modal .input-group .form-control {
            border-top-left-radius: 0;
            border-bottom-left-radius: 0;
        }

        .trans-modal .input-group-prepend .input-group-text {
            border-top-right-radius: 0;
            border-bottom-right-radius: 0;
        }

        .trans-modal .form-control:focus {
            background: #fff;
            border-color: #7048e8;
            box-shadow: 0 0 0 3px rgba(112, 72, 232, .12);
        }

        .trans-modal .modal-footer {
            border: 0;
            padding: 10px 22px 20px;
        }

        .trans-modal .modal-footer .btn {
            border-radius: 12px;
            font-weight: 700;
            padding: 8px 18px;
        }

        .trans-modal .btn-grad {
            color: #fff;
            border: 0;
            background: linear-gradient(135deg, #4c6ef5, #7048e8);
        }

        .trans-modal .btn-grad:hover {
            color: #fff;
            filter: brightness(1.08);
        }
    </style>
@endsection
@section('pageName', 'Transaction Data')
@section('body')
    @php
        $bulanList = [
            '1' => 'January',
            '2' => 'February',
            '3' => 'March',
            '4' => 'April',
            '5' => 'May',
            '6' => 'June',
            '7' => 'July',
            '8' => 'August',
            '9' => 'September',
            '10' => 'October',
            '11' => 'November',
            '12' => 'December',
        ];
    @endphp

    <div class="trans-page">

        <div class="hero">
            <div class="row align-items-center">
                <div class="col-md-8 mb-3 mb-md-0">
                    <div class="d-label"><i class="far fa-calendar-alt mr-1"></i> {{ $bulanList[$bulan] }} {{ date('Y') }} · Net Flow</div>
                    <div class="d-amount hero-amount" id="statNet">Rp. 0</div>
                    <div style="font-size: .85rem; opacity: .85;"><span id="statCount">0</span> transactions this month</div>
                </div>
                <div class="col-md-4 text-md-right">
                    <button type="button" onclick="initAdd()" class="add-btn">
                        <i class="fas fa-plus"></i> Add Transaction
                    </button>
                </div>
            </div>
        </div>

        <nav class="months" aria-label="Select month">
            @foreach ($bulanList as $bln => $blnName)
                <a href="{{ route('user.transaction') }}/{{ $bln }}"
                    class="month {{ $bulan == $bln ? 'active' : '' }}"
                    @if ($bulan == $bln) aria-current="page" @endif>{{ substr($blnName, 0, 3) }}</a>
            @endforeach
        </nav>

        <div class="row">
            <div class="col-sm-6 mb-3">
                <div class="d-card stat">
                    <div class="stat-icon" style="background: var(--green-soft); color: var(--green);"><i class="fa fa-arrow-up"></i></div>
                    <div style="min-width: 0;">
                        <div class="d-label">Income</div>
                        <div class="d-amount" id="statIncome">Rp. 0</div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 mb-3">
                <div class="d-card stat">
                    <div class="stat-icon" style="background: var(--red-soft); color: var(--red);"><i class="fa fa-arrow-down"></i></div>
                    <div style="min-width: 0;">
                        <div class="d-label">Spending</div>
                        <div class="d-amount" id="statSpending">Rp. 0</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="d-card mb-4">
            <div class="tbl-toolbar">
                <div class="seg" role="group" aria-label="Filter type">
                    <button type="button" class="active" data-type="all">All</button>
                    <button type="button" data-type="UP">Income</button>
                    <button type="button" data-type="DOWN">Spending</button>
                </div>
                <div class="search">
                    <i class="fa fa-search"></i>
                    <input type="search" id="tblSearch" placeholder="Search transactions…" autocomplete="off">
                </div>
            </div>
            <div class="tbl-wrap">
                <table id="tbl1" class="table" style="width: 100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Type</th>
                            <th>Asset</th>
                            <th>Tag</th>
                            <th>Desc</th>
                            <th>Date</th>
                            <th class="text-right">Amount (Rp)</th>
                            <th class="text-center">Menu</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>

    </div>

    <!-- Add / Edit Modal -->
    <div class="modal fade trans-modal" id="modal1" tabindex="-1" role="dialog" aria-labelledby="modal1-title"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <form id="form1" method="POST" action="{{ route('user.transaction.insert') }}" class="w-100">
                @csrf
                <input type="hidden" name="trans_id" id="trans_id" value="">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modal1-title">Add Transaction</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-row">
                            <div class="form-group col-sm-6">
                                <label for="sub_id">Asset</label>
                                <select class="form-control" name="sub_id" id="sub_id" required>
                                    <option value="">-- Pilih --</option>
                                    @foreach ($assets as $asset)
                                        <option value="{{ $asset->sub_id }}">
                                            {{ $asset->sub_name }}
                                            ({{ $asset->asset->asset_name }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="tag_id">Tag</label>
                                <select class="form-control" name="tag_id" id="tag_id" required>
                                    <option value="">-- Pilih --</option>
                                    @foreach ($tags as $tag)
                                        <option value="{{ $tag->tag_id }}">
                                            {{ $tag->tag_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="trans_value">Value</label>
                            <div class="input-group">
                                <div class="input-group-prepend"><span class="input-group-text">Rp</span></div>
                                <input type="text" inputmode="decimal" autocomplete="off" class="form-control" name="trans_value" id="trans_value" placeholder="0" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="trans_information">Description</label>
                            <input type="text" class="form-control" name="trans_information" id="trans_information"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="trans_date">Date</label>
                            <input type="date" class="form-control" value="{{ date('Y-m-d') }}" name="trans_date"
                                id="trans_date" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-grad"><i class="fas fa-save mr-1"></i> Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- END Add / Edit Modal -->

@endsection
@section('script')
    <script src="{{ asset('komponen/app') }}/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ asset('komponen/app') }}/vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script type="text/javascript">
        $('#mn-trans').addClass('active');

        $(document).ready(function() {
            initTable();
            $('.months .month.active')[0]?.scrollIntoView({ inline: 'center', block: 'nearest' });
        });

        let tbl1;
        let typeFilter = 'all';
        const MONTHS = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

        // const rupiah = (n) => 'Rp. ' + Number(n || 0).toLocaleString('id-ID', { maximumFractionDigits: 0 });

        function esc(s) {
            return $('<div>').text(s ?? '').html();
        }

        function fmtDate(raw) {
            const m = String(raw || '').match(/^(\d{4})-(\d{2})-(\d{2})/);
            return m ? `${m[3]} ${MONTHS[m[2] - 1]} ${m[1]}` : esc(raw);
        }

        // Input mask nominal: ribuan pakai titik, desimal pakai koma (maks 2 digit)
        function maskNominal(str) {
            str = String(str ?? '').replace(/[^\d,]/g, '');
            const i = str.indexOf(',');
            let int = i < 0 ? str : str.slice(0, i);
            const dec = i < 0 ? null : str.slice(i + 1).replace(/,/g, '').slice(0, 2);
            int = int.replace(/^0+(?=\d)/, '').replace(/\B(?=(\d{3})+(?!\d))/g, '.');
            if (dec !== null) return (int || '0') + ',' + dec;
            return int;
        }

        // "1.500.000,5" -> "1500000.5"
        function unmaskNominal(str) {
            return String(str ?? '').replace(/\./g, '').replace(',', '.');
        }

        // Angka dari DB (mis. "1500000.50") -> "1.500.000,5"
        function numberToMask(n) {
            const [int, dec = ''] = String(Number(n) || 0).split('.');
            return maskNominal(int + (dec ? ',' + dec : ''));
        }

        $('#trans_value').on('input', function() {
            const caret = this.selectionStart;
            // jumlah digit/koma sebelum kursor, supaya posisi kursor tetap setelah diformat
            const keep = this.value.slice(0, caret).replace(/[^\d,]/g, '').length;
            this.value = maskNominal(this.value);
            let pos = 0, count = 0;
            while (pos < this.value.length && count < keep) {
                if (/[\d,]/.test(this.value[pos])) count++;
                pos++;
            }
            this.setSelectionRange(pos, pos);
        });

        function updateStats(rows) {
            let up = 0, down = 0;
            rows.forEach(r => {
                const v = Number(r.trans_value) || 0;
                if (r.trans_status === 'UP') up += v; else down += v;
            });
            const net = up - down;
            $('#statIncome').text(rupiah(up));
            $('#statSpending').text(rupiah(down));
            $('#statNet').text((net < 0 ? '- ' : '') + rupiah(Math.abs(net)));
            $('#statCount').text(rows.length);
        }

        // Income / Spending segment filter
        $.fn.dataTable.ext.search.push(function(settings, data, idx, row) {
            if (settings.nTable.id !== 'tbl1' || typeFilter === 'all') return true;
            return row.trans_status === typeFilter;
        });

        function initTable() {
            tbl1 = $('#tbl1').DataTable({
                order: [],
                pageLength: 25,
                dom: 'rt<"dt-foot"ip>',
                autoWidth: false,
                language: {
                    emptyTable: '<i class="fas fa-inbox fa-2x d-block mb-2" style="opacity:.4"></i>No transactions this month',
                    zeroRecords: '<i class="fas fa-search fa-2x d-block mb-2" style="opacity:.4"></i>No matching transactions',
                    info: '_START_–_END_ of _TOTAL_',
                    infoEmpty: '0 transactions',
                    infoFiltered: '(filtered from _MAX_)',
                    paginate: { previous: '‹', next: '›' },
                },
                ajax: {
                    url: "{{ route('data.transaction.user', $bulan) }}",
                    dataSrc: function(json) {
                        updateStats(json.data || []);
                        return json.data || [];
                    }
                },
                columns: [{
                        data: 'DT_RowIndex',
                        searchable: false,
                        className: 'col-no'
                    },
                    {
                        data: 'trans_status',
                        className: 'col-type',
                        render: (v, type) => {
                            const up = v === 'UP';
                            if (type !== 'display') return up ? 'Income' : 'Spending';
                            return up ?
                                '<span class="pill up"><i class="fa fa-arrow-up"></i> Income</span>' :
                                '<span class="pill down"><i class="fa fa-arrow-down"></i> Spending</span>';
                        }
                    },
                    {
                        data: 'sub_name',
                        className: 'col-asset',
                        render: (v, type) => type === 'display' ? `<span class="asset-name">${esc(v)}</span>` : v
                    },
                    {
                        data: 'tag.tag_name',
                        defaultContent: '',
                        className: 'col-tag',
                        render: (v, type) => type === 'display' ? (v ? `<span class="tag">${esc(v)}</span>` : '') : v
                    },
                    {
                        data: 'trans_information',
                        className: 'col-desc',
                        render: (v, type) => type === 'display' ? esc(v) : v
                    },
                    {
                        data: 'trans_date',
                        className: 'col-date',
                        render: (v, type) => type === 'display' ? fmtDate(v) : v
                    },
                    {
                        data: 'trans_value',
                        className: 'col-amount',
                        render: (v, type, row) => {
                            if (type !== 'display') return Number(v);
                            const up = row.trans_status === 'UP';
                            return `<span class="${up ? 'amt-up' : 'amt-down'}">${up ? '+' : '-'}${Number(v || 0).toLocaleString('id-ID', { maximumFractionDigits: 0 })}</span>`;
                        }
                    },
                    {
                        data: 'trans_id',
                        searchable: false,
                        orderable: false,
                        className: 'col-menu text-center',
                        render: (id) => `<div class="actions">
                            <button type="button" class="icon-btn" title="Edit" aria-label="Edit" onclick="initEdit(${Number(id)})"><i class="fas fa-pen"></i></button>
                            <button type="button" class="icon-btn danger" title="Hapus" aria-label="Hapus" onclick="initHapus(${Number(id)})"><i class="fas fa-trash"></i></button>
                        </div>`
                    },
                ],
            });

            $('#tblSearch').on('input', function() {
                tbl1.search(this.value).draw();
            });

            $('.seg button').on('click', function() {
                $('.seg button').removeClass('active');
                $(this).addClass('active');
                typeFilter = $(this).data('type');
                tbl1.draw();
            });
        }

        function initAdd() {
            $('#form1').trigger('reset');
            $('#trans_id').val('');
            $('#modal1-title').html('<i class="fas fa-plus mr-1"></i> Add Transaction');
            $('#form1').attr('action', "{{ route('user.transaction.insert') }}");
            $('#modal1').modal('show');
        }

        async function initEdit(trans_id) {
            let res = await sendAjax("{{ url('user/transaction/get') }}/" + trans_id, {}, 'GET');
            if (res.status) {
                $('#form1').trigger('reset');
                $('#trans_id').val(res.data.trans_id);
                $('#sub_id').val(res.data.sub_id);
                $('#tag_id').val(res.data.tag_id);
                $('#trans_value').val(numberToMask(res.data.trans_value));
                $('#trans_information').val(res.data.trans_information);
                $('#trans_date').val(res.data.trans_date);
                $('#modal1-title').html('<i class="fas fa-pen mr-1"></i> Edit Transaction');
                $('#form1').attr('action', "{{ route('user.transaction.update') }}");
                $('#modal1').modal('show');
            } else {
                console.log(res);
                alert(res.msg);
            }
        }

        $('#form1').on('submit', async function(e) {
            e.preventDefault();
            let link = $(this).attr('action');
            let dataKirim = $.param($(this).serializeArray().map(f =>
                f.name === 'trans_value' ? { name: f.name, value: unmaskNominal(f.value) } : f
            ));
            let res = await sendAjax(link, dataKirim);
            if (res.status) {
                tbl1.ajax.reload(null, false);
                $('#modal1').modal('hide');
                alert(res.msg)
            } else {
                console.log(res);
                alert(res.msg);
            }
        });

        async function initHapus(tr_id) {
            if (confirm('Delete Transaction ?')) {
                let res = await sendAjax("{{ route('user.transaction.delete') }}", {
                    trans_id: tr_id
                }, 'DELETE');
                if (res.status) {
                    tbl1.ajax.reload(null, false);
                    alert(res.msg)
                } else {
                    console.log(res);
                    alert(res.msg);
                }
            }
        }
    </script>
@endsection
