@extends('_layouts.app')
@section('css')
    <link href="{{ asset('komponen/app') }}/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <style>
        .logs-page {
            --ink: #1e2340;
            --muted: #8a90a8;
            --line: #eef0f6;
            --soft: #f7f8fc;
            --green: #12b886;
            --red: #f0565b;
            --violet: #7048e8;
            color: var(--ink);
        }

        .logs-page .d-label {
            font-size: .72rem;
            font-weight: 700;
            letter-spacing: .08em;
            text-transform: uppercase;
            color: var(--muted);
        }

        .logs-page .d-card {
            background: #fff;
            border: 1px solid var(--line);
            border-radius: 18px;
            box-shadow: 0 6px 24px rgba(30, 35, 64, .06);
        }

        /* Hero */
        .logs-page .hero {
            position: relative;
            overflow: hidden;
            border-radius: 18px;
            padding: 24px 28px;
            color: #fff;
            background: linear-gradient(135deg, #1e2340 0%, #3b3f8f 55%, #7048e8 100%);
            box-shadow: 0 12px 30px rgba(30, 35, 64, .28);
        }

        .logs-page .hero::before {
            content: '';
            position: absolute;
            width: 240px;
            height: 240px;
            right: -70px;
            top: -100px;
            border-radius: 50%;
            background: rgba(255, 255, 255, .08);
            pointer-events: none;
        }

        .logs-page .hero .d-label {
            color: rgba(255, 255, 255, .7);
        }

        .logs-page .hero-title {
            font-size: clamp(1.3rem, 4vw, 1.7rem);
            font-weight: 800;
            margin: 4px 0 0;
        }

        .logs-page .hero-stats {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 10px;
            margin-top: 18px;
        }

        .logs-page .hero-stat {
            padding: 12px 14px;
            border-radius: 14px;
            background: rgba(255, 255, 255, .1);
            min-width: 0;
        }

        .logs-page .hero-stat b {
            display: block;
            font-size: 1.15rem;
            font-weight: 800;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        /* Card head + filters */
        .logs-page .card-head {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            padding: 18px 20px;
            border-bottom: 1px solid var(--line);
        }

        .logs-page .chips {
            display: flex;
            gap: 6px;
            overflow-x: auto;
            padding-bottom: 2px;
            min-width: 0;
            flex: 1 1 auto;
            scrollbar-width: thin;
        }

        .logs-page .chip {
            flex-shrink: 0;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 7px 13px;
            border-radius: 999px;
            border: 1px solid var(--line);
            background: #fff;
            color: var(--ink);
            font-size: .8rem;
            font-weight: 700;
            cursor: pointer;
            transition: all .15s ease;
        }

        .logs-page .chip small {
            color: var(--muted);
            font-weight: 600;
        }

        .logs-page .chip:hover {
            border-color: var(--c, var(--ink));
        }

        .logs-page .chip.active {
            background: var(--c, var(--ink));
            border-color: var(--c, var(--ink));
            color: #fff;
        }

        .logs-page .chip.active small {
            color: rgba(255, 255, 255, .8);
        }

        .logs-page .search {
            position: relative;
            flex: 0 1 240px;
            min-width: 190px;
        }

        .logs-page .search i {
            position: absolute;
            left: 13px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--muted);
            font-size: .8rem;
        }

        .logs-page .search input {
            width: 100%;
            padding: 8px 14px 8px 34px;
            border-radius: 12px;
            border: 1px solid var(--line);
            background: var(--soft);
            font-size: .85rem;
            color: var(--ink);
        }

        .logs-page .search input:focus {
            outline: none;
            background: #fff;
            border-color: var(--violet);
            box-shadow: 0 0 0 3px rgba(112, 72, 232, .12);
        }

        /* Table */
        .logs-page .tbl-wrap {
            padding: 6px 12px 14px;
            overflow-x: auto;
        }

        .logs-page table.dataTable {
            margin: 0 !important;
            border-collapse: separate !important;
            border-spacing: 0;
            font-size: .88rem;
        }

        .logs-page table.dataTable thead th {
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

        .logs-page table.dataTable tbody td {
            border-top: 1px solid var(--line);
            padding: 11px 10px;
            vertical-align: middle;
        }

        .logs-page table.dataTable tbody tr:first-child td {
            border-top: 0;
        }

        .logs-page table.dataTable tbody tr:hover td {
            background: var(--soft);
        }

        .logs-page .col-no {
            color: var(--muted);
            width: 36px;
        }

        .logs-page .act {
            display: flex;
            align-items: center;
            gap: 10px;
            white-space: nowrap;
        }

        .logs-page .act-icon {
            width: 34px;
            height: 34px;
            border-radius: 11px;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: .85rem;
            color: var(--c);
            background: var(--c-soft);
        }

        .logs-page .act-name {
            font-weight: 700;
            font-size: .82rem;
            color: var(--c);
        }

        .logs-page .col-asset {
            font-weight: 600;
        }

        .logs-page .col-date {
            color: var(--muted);
            white-space: nowrap;
        }

        .logs-page .col-value {
            text-align: right;
            font-weight: 800;
            white-space: nowrap;
            font-variant-numeric: tabular-nums;
        }

        .logs-page .col-balance {
            white-space: nowrap;
            font-variant-numeric: tabular-nums;
            font-size: .82rem;
        }

        .logs-page .bal-from {
            color: var(--muted);
        }

        .logs-page .bal-arrow {
            color: #c3c7d6;
            margin: 0 6px;
            font-size: .7rem;
        }

        .logs-page .bal-to {
            font-weight: 700;
        }

        .logs-page .delta {
            display: inline-block;
            margin-left: 8px;
            padding: 1px 8px;
            border-radius: 999px;
            font-size: .72rem;
            font-weight: 700;
        }

        .logs-page .delta.up { background: #e6f8f1; color: var(--green); }
        .logs-page .delta.down { background: #fdecec; color: var(--red); }
        .logs-page .delta.flat { background: var(--soft); color: var(--muted); }

        .logs-page .dataTables_empty {
            text-align: center;
            color: var(--muted);
            padding: 40px 0 !important;
        }

        .logs-page .dt-foot {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
            padding: 12px 8px 0;
        }

        .logs-page .dataTables_info {
            padding: 0 !important;
            font-size: .8rem;
            color: var(--muted);
        }

        .logs-page .dataTables_paginate .pagination {
            margin: 0 !important;
            flex-wrap: wrap;
        }

        .logs-page .page-link {
            border: 0;
            border-radius: 9px !important;
            margin: 0 2px;
            color: var(--ink);
            font-weight: 700;
            font-size: .8rem;
        }

        .logs-page .page-item.active .page-link {
            background: var(--ink);
        }

        /* Mobile: rows become cards */
        @media (max-width: 767.98px) {
            .logs-page .search {
                flex: 1 1 100%;
                order: -1;
            }

            .logs-page .tbl-wrap {
                padding: 8px;
                overflow: visible;
            }

            .logs-page table.dataTable thead {
                display: none;
            }

            .logs-page table.dataTable,
            .logs-page table.dataTable tbody {
                display: block;
                width: 100% !important;
            }

            .logs-page table.dataTable tbody tr {
                display: flex;
                flex-wrap: wrap;
                align-items: center;
                gap: 6px 10px;
                padding: 12px;
                margin-bottom: 8px;
                border: 1px solid var(--line);
                border-radius: 14px;
                background: #fff;
            }

            .logs-page table.dataTable tbody tr::before {
                content: '';
                order: 3;
                flex-basis: 100%;
                height: 0;
            }

            .logs-page table.dataTable tbody td {
                display: block;
                border: 0 !important;
                padding: 0 !important;
                background: transparent !important;
            }

            .logs-page table.dataTable tbody td.dataTables_empty {
                flex-basis: 100%;
                padding: 30px 0 !important;
            }

            .logs-page td.col-no { display: none !important; }
            .logs-page td.col-type { order: 1; flex: 1 1 0; min-width: 0; }
            .logs-page td.col-value { order: 2; font-size: .95rem; }
            .logs-page td.col-asset { order: 4; flex: 1 1 0; min-width: 0; overflow-wrap: anywhere; font-size: .85rem; }
            .logs-page td.col-date { order: 5; font-size: .78rem; }
            .logs-page td.col-balance {
                order: 6;
                flex-basis: 100%;
                padding: 8px 10px !important;
                border-radius: 10px;
                background: var(--soft) !important;
                white-space: normal;
            }

            .logs-page .act-icon {
                width: 30px;
                height: 30px;
            }

            .logs-page .dt-foot {
                justify-content: center;
            }
        }

        @media (max-width: 575.98px) {
            .logs-page .hero {
                padding: 20px;
            }

            .logs-page .hero-stats {
                gap: 8px;
            }

            .logs-page .hero-stat {
                padding: 10px;
            }

            .logs-page .hero-stat b {
                font-size: .95rem;
            }

            .logs-page .card-head {
                padding: 14px;
            }
        }
    </style>
@endsection
@section('pageName', 'Logs')
@section('body')
    @php
        // key => [label, icon, color, filter group]
        $types = [
            'trans_down' => ['Spending', 'fa-arrow-down', '#f0565b', 'trans'],
            'trans_up' => ['Income', 'fa-arrow-up', '#12b886', 'trans'],
            'trans_delete' => ['Trans Deleted', 'fa-eraser', '#868e96', 'delete'],
            'asset_update' => ['Asset Update', 'fa-sync-alt', '#4c6ef5', 'update'],
            'asset_convert_from' => ['Convert Out', 'fa-sign-out-alt', '#f59f00', 'convert'],
            'asset_convert_to' => ['Convert In', 'fa-sign-in-alt', '#15aabf', 'convert'],
            'asset_add' => ['Asset Added', 'fa-plus', '#7048e8', 'asset'],
            'asset_delete' => ['Asset Deleted', 'fa-trash', '#e64980', 'delete'],
        ];
        $groups = [
            'trans' => ['Transactions', '#f0565b'],
            'update' => ['Updates', '#4c6ef5'],
            'convert' => ['Converts', '#f59f00'],
            'asset' => ['Added', '#7048e8'],
            'delete' => ['Deleted', '#868e96'],
        ];
        $typeOf = fn($desc) => $types[$desc] ?? [ucwords(str_replace('_', ' ', $desc)), 'fa-circle', '#868e96', 'other'];

        $groupCounts = $logs->countBy(fn($l) => $typeOf($l->desc)[3]);
        $thisMonthCount = $logs->filter(fn($l) => substr($l->date, 0, 7) === date('Y-m'))->count();
        $lastLog = $logs->first();
        $fmt = fn($n) => number_format((float) $n, 0, ',', '.');
    @endphp

    <div class="logs-page">

        <div class="hero mb-4">
            <div class="d-label"><i class="fas fa-history mr-1"></i> Activity</div>
            <div class="hero-title">Every change to your money, recorded</div>
            <div class="hero-stats">
                <div class="hero-stat">
                    <div class="d-label">Total</div>
                    <b>{{ $fmt($logs->count()) }}</b>
                </div>
                <div class="hero-stat">
                    <div class="d-label">This Month</div>
                    <b>{{ $fmt($thisMonthCount) }}</b>
                </div>
                <div class="hero-stat">
                    <div class="d-label">Last Activity</div>
                    <b>{{ $lastLog ? \Carbon\Carbon::parse($lastLog->date)->format('d M Y') : '-' }}</b>
                </div>
            </div>
        </div>

        <div class="d-card mb-4">
            <div class="card-head">
                <div class="chips" role="group" aria-label="Filter activity">
                    <button type="button" class="chip active" data-group="">All <small>{{ $fmt($logs->count()) }}</small></button>
                    @foreach ($groups as $key => [$label, $color])
                        @if ($groupCounts->get($key))
                            <button type="button" class="chip" data-group="{{ $key }}" style="--c: {{ $color }}">
                                {{ $label }} <small>{{ $fmt($groupCounts->get($key)) }}</small>
                            </button>
                        @endif
                    @endforeach
                </div>
                <div class="search">
                    <i class="fa fa-search"></i>
                    <input type="search" id="tblSearch" placeholder="Search asset, type…" autocomplete="off">
                </div>
            </div>
            <div class="tbl-wrap">
                <table id="tbl1" class="table" style="width: 100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Activity</th>
                            <th>Asset</th>
                            <th>Date</th>
                            <th class="text-right">Value (Rp)</th>
                            <th>Balance (From → To)</th>
                            <th class="d-none">Group</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($logs as $log)
                            @php
                                [$label, $icon, $color, $group] = $typeOf($log->desc);
                                $delta = $log->to_value - $log->from_value;
                                $deltaCls = $delta > 0 ? 'up' : ($delta < 0 ? 'down' : 'flat');
                            @endphp
                            <tr>
                                <td class="col-no">{{ $loop->iteration }}</td>
                                <td class="col-type" data-search="{{ $label }} {{ $log->desc }}">
                                    <div class="act" style="--c: {{ $color }}; --c-soft: {{ $color }}1f;">
                                        <span class="act-icon"><i class="fas {{ $icon }}"></i></span>
                                        <span class="act-name">{{ $label }}</span>
                                    </div>
                                </td>
                                <td class="col-asset">{{ $log->asset_name }}</td>
                                <td class="col-date" data-order="{{ $log->date }}">{{ \Carbon\Carbon::parse($log->date)->format('d M Y') }}</td>
                                <td class="col-value" data-order="{{ $log->tr_value }}" style="color: {{ $color }}">{{ $fmt($log->tr_value) }}</td>
                                <td class="col-balance" data-order="{{ $log->to_value }}">
                                    <span class="bal-from">{{ $fmt($log->from_value) }}</span><i class="fas fa-arrow-right bal-arrow"></i><span class="bal-to">{{ $fmt($log->to_value) }}</span>
                                    <span class="delta {{ $deltaCls }}">{{ $delta > 0 ? '+' : ($delta < 0 ? '−' : '±') }}{{ $fmt(abs($delta)) }}</span>
                                </td>
                                <td class="d-none">{{ $group }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
@endsection
@section('script')
    <script src="{{ asset('komponen/app') }}/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ asset('komponen/app') }}/vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script type="text/javascript">
        $('#mn4').addClass('active');

        $(document).ready(function() {
            initTable();
        });

        let tbl1;

        function initTable() {
            tbl1 = $('#tbl1').DataTable({
                order: [],
                pageLength: 25,
                dom: 'rt<"dt-foot"ip>',
                autoWidth: false,
                deferRender: true,
                columnDefs: [
                    { targets: 0, orderable: false },
                    { targets: 6, visible: false },
                ],
                language: {
                    emptyTable: '<i class="fas fa-history fa-2x d-block mb-2" style="opacity:.4"></i>No activity yet',
                    zeroRecords: '<i class="fas fa-search fa-2x d-block mb-2" style="opacity:.4"></i>No matching activity',
                    info: '_START_–_END_ of _TOTAL_',
                    infoEmpty: '0 entries',
                    infoFiltered: '(filtered from _MAX_)',
                    paginate: { previous: '‹', next: '›' },
                },
            });

            $('#tblSearch').on('input', function() {
                tbl1.search(this.value).draw();
            });

            $('.chip').on('click', function() {
                $('.chip').removeClass('active');
                $(this).addClass('active');
                const g = String($(this).data('group') || '');
                tbl1.column(6).search(g ? '^' + g + '$' : '', true, false).draw();
            });
        }
    </script>
@endsection
