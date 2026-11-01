@extends('_layouts.app')
@section('css')
    <!-- Custom styles for this page -->
    <link href="{{ asset('komponen/app') }}/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <style>
        .report-page {
            --ink: #1e2340;
            --muted: #8a90a8;
            --line: #eef0f6;
            --soft: #f7f8fc;
            --green: #12b886;
            --green-soft: #e6f8f1;
            --red: #f0565b;
            --red-soft: #fdecec;
            --blue: #4c6ef5;
            --blue-soft: #edf1fe;
            --amber: #f59f00;
            --amber-soft: #fff4dc;
            --violet: #7048e8;
            color: var(--ink);
        }

        .report-page .d-label {
            font-size: .72rem;
            font-weight: 700;
            letter-spacing: .08em;
            text-transform: uppercase;
            color: var(--muted);
        }

        .report-page .d-amount {
            font-weight: 800;
            font-variant-numeric: tabular-nums;
            overflow-wrap: anywhere;
        }

        .report-page .d-card {
            background: #fff;
            border: 1px solid var(--line);
            border-radius: 18px;
            box-shadow: 0 6px 24px rgba(30, 35, 64, .06);
            height: 100%;
        }

        .report-page .card-head {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: space-between;
            gap: 10px 14px;
            padding: 18px 20px 14px;
            border-bottom: 1px solid var(--line);
        }

        .report-page .card-head h6 {
            margin: 0;
            font-weight: 800;
            color: var(--ink);
        }

        .report-page .card-head h6 i {
            color: var(--violet);
            margin-right: 6px;
        }

        /* Hero */
        .report-page .hero {
            position: relative;
            overflow: hidden;
            border-radius: 18px;
            padding: 24px 28px;
            color: #fff;
            height: 100%;
            background: linear-gradient(135deg, #f0565b 0%, #e64980 50%, #7048e8 100%);
            box-shadow: 0 12px 30px rgba(230, 73, 128, .3);
        }

        .report-page .hero::before,
        .report-page .hero::after {
            content: '';
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, .1);
            pointer-events: none;
        }

        .report-page .hero::before {
            width: 220px;
            height: 220px;
            right: -60px;
            top: -90px;
        }

        .report-page .hero::after {
            width: 130px;
            height: 130px;
            right: 90px;
            bottom: -70px;
        }

        .report-page .hero .d-label {
            color: rgba(255, 255, 255, .78);
        }

        .report-page .hero-amount {
            font-size: clamp(1.5rem, 5vw, 2.1rem);
            line-height: 1.15;
            margin: 6px 0 14px;
        }

        .report-page .used-bar {
            height: 8px;
            border-radius: 999px;
            background: rgba(255, 255, 255, .25);
            overflow: hidden;
            margin-bottom: 8px;
        }

        .report-page .used-bar span {
            display: block;
            height: 100%;
            border-radius: 999px;
            background: #fff;
        }

        .report-page .hero-meta {
            font-size: .82rem;
            opacity: .9;
        }

        /* Filter */
        .report-page .filter-card {
            container-type: inline-size;
        }

        .report-page .filter-card .form-control {
            border-radius: 12px;
            border-color: var(--line);
            background: var(--soft);
            font-weight: 600;
        }

        .report-page .filter-card .btn {
            border-radius: 12px;
            font-weight: 700;
            background: var(--ink);
            border-color: var(--ink);
        }

        .report-page .filter-card .col-md-6 {
            flex: 0 0 100%;
            max-width: 100%;
        }

        .report-page .filter-card .form-group {
            margin-bottom: .6rem;
        }

        @container (min-width: 300px) {
            .report-page .filter-card .col-md-6 {
                flex: 0 0 50%;
                max-width: 50%;
            }
        }

        /* Stat tiles */
        .report-page .stat {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 16px 18px;
        }

        .report-page .stat-icon {
            width: 44px;
            height: 44px;
            border-radius: 14px;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .report-page .stat .d-amount {
            font-size: 1.1rem;
        }

        .report-page .stat .sub {
            font-size: .75rem;
            color: var(--muted);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        /* Category chart */
        .report-page .chart-box {
            position: relative;
            padding: 12px 16px 16px;
        }

        .report-page .empty {
            text-align: center;
            padding: 48px 16px;
            color: var(--muted);
        }

        .report-page .empty i {
            font-size: 2rem;
            opacity: .4;
            margin-bottom: 10px;
        }

        /* Expenses table */
        .report-page .tools {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .report-page .tools select,
        .report-page .tools input {
            padding: 8px 14px;
            border-radius: 12px;
            border: 1px solid var(--line);
            background: var(--soft);
            font-size: .85rem;
            color: var(--ink);
        }

        .report-page .tools select {
            font-weight: 600;
        }

        .report-page .tools .search {
            position: relative;
        }

        .report-page .tools .search i {
            position: absolute;
            left: 13px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--muted);
            font-size: .8rem;
        }

        .report-page .tools .search input {
            padding-left: 34px;
            width: 220px;
        }

        .report-page .tools select:focus,
        .report-page .tools input:focus {
            outline: none;
            background: #fff;
            border-color: var(--violet);
            box-shadow: 0 0 0 3px rgba(112, 72, 232, .12);
        }

        .report-page .tbl-wrap {
            padding: 6px 12px 14px;
            overflow-x: auto;
        }

        .report-page table.dataTable {
            margin: 0 !important;
            border-collapse: separate !important;
            border-spacing: 0;
            font-size: .88rem;
        }

        .report-page table.dataTable thead th {
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

        .report-page table.dataTable tbody td {
            border-top: 1px solid var(--line);
            padding: 12px 10px;
            vertical-align: middle;
        }

        .report-page table.dataTable tbody tr:first-child td {
            border-top: 0;
        }

        .report-page table.dataTable tbody tr:hover td {
            background: var(--soft);
        }

        .report-page .col-no {
            color: var(--muted);
            width: 36px;
        }

        .report-page .col-desc {
            font-weight: 600;
        }

        .report-page .col-date {
            color: var(--muted);
            white-space: nowrap;
        }

        .report-page .col-amount {
            text-align: right;
            white-space: nowrap;
            font-weight: 800;
            color: var(--red);
            font-variant-numeric: tabular-nums;
        }

        .report-page .tag {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 3px 10px;
            border-radius: 999px;
            font-size: .75rem;
            font-weight: 700;
            white-space: nowrap;
            background: var(--blue-soft);
            color: var(--blue);
        }

        .report-page .dataTables_empty {
            text-align: center;
            color: var(--muted);
            padding: 40px 0 !important;
        }

        .report-page .dt-foot {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
            padding: 12px 8px 0;
        }

        .report-page .dataTables_info {
            padding: 0 !important;
            font-size: .8rem;
            color: var(--muted);
        }

        .report-page .dataTables_paginate .pagination {
            margin: 0 !important;
            flex-wrap: wrap;
        }

        .report-page .page-link {
            border: 0;
            border-radius: 9px !important;
            margin: 0 2px;
            color: var(--ink);
            font-weight: 700;
            font-size: .8rem;
        }

        .report-page .page-item.active .page-link {
            background: var(--ink);
        }

        /* Mobile: rows become cards */
        @media (max-width: 767.98px) {
            .report-page .tools {
                width: 100%;
            }

            .report-page .tools select,
            .report-page .tools .search {
                flex: 1 1 160px;
            }

            .report-page .tools .search input {
                width: 100%;
            }

            .report-page .tbl-wrap {
                padding: 8px;
                overflow: visible;
            }

            .report-page table.dataTable thead {
                display: none;
            }

            .report-page table.dataTable,
            .report-page table.dataTable tbody {
                display: block;
                width: 100% !important;
            }

            .report-page table.dataTable tbody tr {
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

            .report-page table.dataTable tbody tr::before {
                content: '';
                order: 3;
                flex-basis: 100%;
                height: 0;
            }

            .report-page table.dataTable tbody td {
                display: block;
                border: 0 !important;
                padding: 0 !important;
                background: transparent !important;
            }

            .report-page table.dataTable tbody td.dataTables_empty {
                flex-basis: 100%;
                padding: 30px 0 !important;
            }

            .report-page td.col-no { display: none !important; }
            .report-page td.col-desc { order: 1; flex: 1 1 0; min-width: 0; overflow-wrap: anywhere; }
            .report-page td.col-amount { order: 2; font-size: .95rem; }
            .report-page td.col-tag { order: 4; }
            .report-page td.col-date { order: 5; margin-left: auto; font-size: .78rem; }

            .report-page .dt-foot {
                justify-content: center;
            }
        }

        @media (max-width: 575.98px) {
            .report-page .hero {
                padding: 20px;
            }

            .report-page .stat {
                padding: 14px;
            }

            .report-page .card-head {
                padding: 14px;
            }
        }
    </style>
@endsection
@section('pageName', 'Transaction Report')
@section('body')
    @php
        $monthName = date('F', mktime(0, 0, 0, $pilih_bulan, 1));
        $income = $thisMonth['income'];
        $spending = $thisMonth['spending'];
        $saved = $income - $spending;
        $usedPct = $income > 0 ? round(($spending / $income) * 100, 1) : 0;

        // Days elapsed in the selected period (full month for past months)
        $isCurrent = $pilih_bulan == date('n') && $pilih_tahun == date('Y');
        $days = $isCurrent ? (int) date('j') : (int) date('t', mktime(0, 0, 0, $pilih_bulan, 1, $pilih_tahun));
        $avgPerDay = $days > 0 ? $spending / $days : 0;

        // Category breakdown: only categories with spending, largest first
        $categories = collect($tags)
            ->map(fn($name, $i) => ['name' => $name, 'value' => (float) ($tags_value[$i] ?? 0)])
            ->filter(fn($c) => $c['value'] > 0)
            ->sortByDesc('value')
            ->values();
        $topCategory = $categories->first();
        $biggest = $transDown->sortByDesc('trans_value')->first();
    @endphp

    <div class="report-page">

        <div class="row">
            <div class="col-xl-8 col-lg-7 mb-4">
                <div class="hero">
                    <div class="d-label"><i class="far fa-calendar-alt mr-1"></i> {{ $monthName }} {{ $pilih_tahun }} · Total Spending</div>
                    <div class="d-amount hero-amount">@mataUang($spending)</div>
                    <div class="used-bar"><span style="width: {{ min(100, $usedPct) }}%"></span></div>
                    <div class="hero-meta">
                        @if ($income > 0)
                            {{ $usedPct }}% of income (@mataUang($income)) spent
                        @else
                            No income recorded this month
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-5 mb-4">
                <div class="d-card filter-card p-3">
                    <div class="d-label mb-2 px-1"><i class="fa fa-filter mr-1"></i> Period</div>
                    @include('_components.form_bulan')
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-3 col-sm-6 mb-4">
                <div class="d-card stat">
                    <div class="stat-icon" style="background: var(--green-soft); color: var(--green);"><i class="fa fa-arrow-up"></i></div>
                    <div style="min-width: 0;">
                        <div class="d-label">Income</div>
                        <div class="d-amount">@mataUang($income)</div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-4">
                <div class="d-card stat">
                    <div class="stat-icon"
                        style="background: {{ $saved >= 0 ? 'var(--blue-soft)' : 'var(--red-soft)' }}; color: {{ $saved >= 0 ? 'var(--blue)' : 'var(--red)' }};">
                        <i class="fa fa-piggy-bank"></i></div>
                    <div style="min-width: 0;">
                        <div class="d-label">{{ $saved >= 0 ? 'Saved' : 'Overspent' }}</div>
                        <div class="d-amount">@mataUang(abs($saved))</div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-4">
                <div class="d-card stat">
                    <div class="stat-icon" style="background: var(--amber-soft); color: var(--amber);"><i class="fa fa-calendar-day"></i></div>
                    <div style="min-width: 0;">
                        <div class="d-label">Avg / Day</div>
                        <div class="d-amount">@mataUang($avgPerDay)</div>
                        <div class="sub">over {{ $days }} days</div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-4">
                <div class="d-card stat">
                    <div class="stat-icon" style="background: var(--red-soft); color: var(--red);"><i class="fa fa-fire"></i></div>
                    <div style="min-width: 0;">
                        <div class="d-label">Biggest Expense</div>
                        <div class="d-amount">@mataUang(optional($biggest)->trans_value ?? 0)</div>
                        <div class="sub" title="{{ optional($biggest)->trans_information }}">{{ optional($biggest)->trans_information ?? '-' }}</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="d-card mb-4" style="height: auto;">
            <div class="card-head">
                <h6><i class="fas fa-balance-scale"></i> Expenses Category</h6>
                @if ($topCategory)
                    <span class="tag"><i class="fa fa-crown"></i> Top: {{ $topCategory['name'] }}</span>
                @endif
            </div>
            @if ($categories->isEmpty())
                <div class="empty">
                    <div><i class="fas fa-chart-bar"></i></div>
                    No spending recorded for this period
                </div>
            @else
                <div class="chart-box" style="height: {{ $categories->count() * 38 + 40 }}px;">
                    <canvas id="myBarChart"></canvas>
                </div>
            @endif
        </div>

        <div class="d-card mb-4" style="height: auto;">
            <div class="card-head">
                <h6><i class="fas fa-receipt"></i> Expenses Detail</h6>
                <div class="tools">
                    <select id="tagFilter" aria-label="Filter category">
                        <option value="">All categories</option>
                        @foreach ($categories as $cat)
                            <option value="{{ $cat['name'] }}">{{ $cat['name'] }}</option>
                        @endforeach
                    </select>
                    <div class="search">
                        <i class="fa fa-search"></i>
                        <input type="search" id="tblSearch" placeholder="Search…" autocomplete="off">
                    </div>
                </div>
            </div>
            <div class="tbl-wrap">
                <table class="table" id="dataTable" style="width: 100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Tag</th>
                            <th>Desc</th>
                            <th>Date</th>
                            <th class="text-right">Amount (Rp)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transDown as $td)
                            <tr>
                                <td class="col-no">{{ $loop->iteration }}</td>
                                <td class="col-tag" data-search="{{ optional($td->tag)->tag_name }}"><span class="tag">{{ optional($td->tag)->tag_name ?? '-' }}</span></td>
                                <td class="col-desc">{{ $td->trans_information }}</td>
                                <td class="col-date" data-order="{{ $td->trans_date }}">{{ \Carbon\Carbon::parse($td->trans_date)->format('d M Y') }}</td>
                                <td class="col-amount" data-order="{{ $td->trans_value }}">-@mataUang2($td->trans_value)</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
@endsection
@section('script')
    <!-- Page level plugins -->
    <script src="{{ asset('komponen/app') }}/vendor/chart.js/Chart.min.js"></script>
    <script src="{{ asset('komponen/app') }}/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ asset('komponen/app') }}/vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script type="text/javascript">
        $('#mn3').addClass('active');
        $('#pilih_bulan').val('{{ $pilih_bulan }}');
        $('#pilih_tahun').val('{{ $pilih_tahun }}');

        const fmtRp = (n) => 'Rp. ' + Number(n || 0).toLocaleString('id-ID', { maximumFractionDigits: 0 });
        const fmtShort = (n) => {
            n = Number(n || 0);
            if (n >= 1e9) return (n / 1e9).toLocaleString('id-ID', { maximumFractionDigits: 1 }) + ' M';
            if (n >= 1e6) return (n / 1e6).toLocaleString('id-ID', { maximumFractionDigits: 1 }) + ' jt';
            if (n >= 1e3) return (n / 1e3).toLocaleString('id-ID', { maximumFractionDigits: 0 }) + ' rb';
            return n.toLocaleString('id-ID');
        };

        $(document).ready(function() {
            const table = $('#dataTable').DataTable({
                order: [],
                pageLength: 25,
                dom: 'rt<"dt-foot"ip>',
                autoWidth: false,
                columnDefs: [{ targets: 0, orderable: false }],
                language: {
                    emptyTable: '<i class="fas fa-inbox fa-2x d-block mb-2" style="opacity:.4"></i>No expenses this month',
                    zeroRecords: '<i class="fas fa-search fa-2x d-block mb-2" style="opacity:.4"></i>No matching expenses',
                    info: '_START_–_END_ of _TOTAL_',
                    infoEmpty: '0 expenses',
                    infoFiltered: '(filtered from _MAX_)',
                    paginate: { previous: '‹', next: '›' },
                },
            });

            $('#tblSearch').on('input', function() {
                table.search(this.value).draw();
            });

            $('#tagFilter').on('change', function() {
                const v = this.value;
                table.column(1).search(v ? '^' + $.fn.dataTable.util.escapeRegex(v) + '$' : '', true, false).draw();
            });
        });

        const categories = @json($categories);
        const ctx = document.getElementById('myBarChart');

        if (ctx && categories.length) {
            Chart.defaults.global.defaultFontFamily = 'Nunito, -apple-system, system-ui, "Segoe UI", Roboto, Arial, sans-serif';
            Chart.defaults.global.defaultFontColor = '#8a90a8';

            const g = ctx.getContext('2d');
            const grad = g.createLinearGradient(0, 0, ctx.parentNode.clientWidth || 600, 0);
            grad.addColorStop(0, '#f0565b');
            grad.addColorStop(1, '#e64980');

            new Chart(ctx, {
                type: 'horizontalBar',
                data: {
                    labels: categories.map(c => c.name),
                    datasets: [{
                        label: 'Spending',
                        data: categories.map(c => c.value),
                        backgroundColor: grad,
                        hoverBackgroundColor: '#7048e8',
                        borderWidth: 0,
                        barThickness: 18,
                    }],
                },
                options: {
                    maintainAspectRatio: false,
                    responsive: true,
                    legend: { display: false },
                    layout: { padding: { right: 8 } },
                    scales: {
                        xAxes: [{
                            ticks: {
                                min: 0,
                                maxTicksLimit: 5,
                                callback: (v) => fmtShort(v),
                            },
                            gridLines: {
                                color: '#eef0f6',
                                zeroLineColor: '#eef0f6',
                                drawBorder: false,
                                borderDash: [3],
                            },
                        }],
                        yAxes: [{
                            gridLines: { display: false, drawBorder: false },
                            ticks: {
                                fontStyle: '600',
                                fontColor: '#1e2340',
                                callback: (label) => label.length > 18 ? label.slice(0, 17) + '…' : label,
                            },
                        }],
                    },
                    tooltips: {
                        backgroundColor: '#1e2340',
                        cornerRadius: 10,
                        xPadding: 12,
                        yPadding: 10,
                        displayColors: false,
                        callbacks: {
                            title: (items) => categories[items[0].index].name,
                            label: (item) => {
                                const total = categories.reduce((s, c) => s + c.value, 0);
                                const pct = total ? (item.xLabel / total * 100).toFixed(1) : 0;
                                return `${fmtRp(item.xLabel)} (${pct}%)`;
                            }
                        }
                    },
                }
            });
        }
    </script>
@endsection
