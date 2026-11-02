@extends('_layouts.app')
@section('css')
    <style>
        .annual-page {
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

        .annual-page .d-label {
            font-size: .72rem;
            font-weight: 700;
            letter-spacing: .08em;
            text-transform: uppercase;
            color: var(--muted);
        }

        .annual-page .d-amount {
            font-weight: 800;
            font-variant-numeric: tabular-nums;
            overflow-wrap: anywhere;
        }

        .annual-page .d-card {
            background: #fff;
            border: 1px solid var(--line);
            border-radius: 18px;
            box-shadow: 0 6px 24px rgba(30, 35, 64, .06);
            height: 100%;
        }

        .annual-page .card-head {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: space-between;
            gap: 10px 14px;
            padding: 18px 20px 14px;
            border-bottom: 1px solid var(--line);
        }

        .annual-page .card-head h6 {
            margin: 0;
            font-weight: 800;
            color: var(--ink);
        }

        .annual-page .card-head h6 i {
            color: var(--violet);
            margin-right: 6px;
        }

        /* Hero */
        .annual-page .hero {
            position: relative;
            overflow: hidden;
            border-radius: 18px;
            padding: 24px 28px;
            color: #fff;
            height: 100%;
            background: linear-gradient(135deg, #4c6ef5 0%, #7048e8 55%, #ae3ec9 100%);
            box-shadow: 0 12px 30px rgba(112, 72, 232, .3);
        }

        .annual-page .hero.negative {
            background: linear-gradient(135deg, #f0565b 0%, #e64980 50%, #7048e8 100%);
            box-shadow: 0 12px 30px rgba(230, 73, 128, .3);
        }

        .annual-page .hero::before,
        .annual-page .hero::after {
            content: '';
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, .1);
            pointer-events: none;
        }

        .annual-page .hero::before {
            width: 220px;
            height: 220px;
            right: -60px;
            top: -90px;
        }

        .annual-page .hero::after {
            width: 130px;
            height: 130px;
            right: 90px;
            bottom: -70px;
        }

        .annual-page .hero .d-label {
            color: rgba(255, 255, 255, .78);
        }

        .annual-page .hero-amount {
            font-size: clamp(1.5rem, 5vw, 2.1rem);
            line-height: 1.15;
            margin: 6px 0 14px;
        }

        .annual-page .used-bar {
            height: 8px;
            border-radius: 999px;
            background: rgba(255, 255, 255, .25);
            overflow: hidden;
            margin-bottom: 8px;
        }

        .annual-page .used-bar span {
            display: block;
            height: 100%;
            border-radius: 999px;
            background: #fff;
        }

        .annual-page .hero-meta {
            font-size: .82rem;
            opacity: .9;
        }

        /* Filter */
        .annual-page .filter-card .form-control {
            border-radius: 12px;
            border-color: var(--line);
            background: var(--soft);
            font-weight: 600;
        }

        .annual-page .filter-card .btn {
            border-radius: 12px;
            font-weight: 700;
            background: var(--ink);
            border-color: var(--ink);
        }

        .annual-page .quick {
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
        }

        .annual-page .quick a {
            padding: 4px 12px;
            border-radius: 999px;
            font-size: .78rem;
            font-weight: 700;
            background: var(--soft);
            color: var(--ink);
            border: 1px solid var(--line);
            text-decoration: none;
        }

        .annual-page .quick a.active {
            background: var(--ink);
            border-color: var(--ink);
            color: #fff;
        }

        /* Stat tiles */
        .annual-page .stat {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 16px 18px;
        }

        .annual-page .stat-icon {
            width: 44px;
            height: 44px;
            border-radius: 14px;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .annual-page .stat .d-amount {
            font-size: 1.1rem;
        }

        .annual-page .stat .sub {
            font-size: .75rem;
            color: var(--muted);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        /* Charts */
        .annual-page .chart-box {
            position: relative;
            padding: 12px 16px 16px;
        }

        .annual-page .legend {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            font-size: .78rem;
            font-weight: 700;
            color: var(--muted);
        }

        .annual-page .legend i {
            display: inline-block;
            width: 10px;
            height: 10px;
            border-radius: 3px;
            margin-right: 5px;
        }

        .annual-page .empty {
            text-align: center;
            padding: 48px 16px;
            color: var(--muted);
        }

        .annual-page .empty i {
            font-size: 2rem;
            opacity: .4;
            margin-bottom: 10px;
        }

        .annual-page .tag {
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

        /* Top expenses */
        .annual-page .top-list {
            list-style: none;
            margin: 0;
            padding: 6px 12px 12px;
        }

        .annual-page .top-list li {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 8px;
            border-top: 1px solid var(--line);
        }

        .annual-page .top-list li:first-child {
            border-top: 0;
        }

        .annual-page .top-rank {
            width: 26px;
            height: 26px;
            border-radius: 8px;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: .75rem;
            font-weight: 800;
            background: var(--soft);
            color: var(--muted);
        }

        .annual-page .top-list li:nth-child(-n+3) .top-rank {
            background: var(--red-soft);
            color: var(--red);
        }

        .annual-page .top-info {
            flex: 1 1 0;
            min-width: 0;
        }

        .annual-page .top-info .desc {
            font-weight: 600;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .annual-page .top-info .meta {
            font-size: .75rem;
            color: var(--muted);
        }

        .annual-page .top-amount {
            font-weight: 800;
            color: var(--red);
            white-space: nowrap;
            font-variant-numeric: tabular-nums;
        }

        /* Breakdown table */
        .annual-page .tbl-wrap {
            padding: 6px 12px 14px;
            overflow-x: auto;
        }

        .annual-page .tbl {
            width: 100%;
            margin: 0;
            border-collapse: separate;
            border-spacing: 0;
            font-size: .88rem;
        }

        .annual-page .tbl th {
            border-bottom: 1px solid var(--line);
            color: var(--muted);
            font-size: .72rem;
            font-weight: 700;
            letter-spacing: .06em;
            text-transform: uppercase;
            padding: 12px 10px;
            white-space: nowrap;
        }

        .annual-page .tbl td {
            border-top: 1px solid var(--line);
            padding: 12px 10px;
            vertical-align: middle;
            white-space: nowrap;
            font-variant-numeric: tabular-nums;
        }

        .annual-page .tbl tbody tr:first-child td {
            border-top: 0;
        }

        .annual-page .tbl tbody tr:hover td {
            background: var(--soft);
        }

        .annual-page .tbl tbody tr.is-empty td {
            color: var(--muted);
        }

        .annual-page .tbl tfoot td {
            border-top: 2px solid var(--line);
            font-weight: 800;
        }

        .annual-page .tbl .num {
            text-align: right;
        }

        .annual-page .tbl .period {
            font-weight: 700;
        }

        .annual-page .tbl .period a {
            color: inherit;
        }

        .annual-page .pos {
            color: var(--green);
            font-weight: 700;
        }

        .annual-page .neg {
            color: var(--red);
            font-weight: 700;
        }

        .annual-page .rate-bar {
            display: inline-block;
            vertical-align: middle;
            width: 60px;
            height: 6px;
            border-radius: 999px;
            background: var(--line);
            overflow: hidden;
            margin-right: 8px;
        }

        .annual-page .rate-bar span {
            display: block;
            height: 100%;
            background: var(--green);
        }

        @media (max-width: 575.98px) {
            .annual-page .hero {
                padding: 20px;
            }

            .annual-page .stat {
                padding: 14px;
            }

            .annual-page .card-head {
                padding: 14px;
            }

            .annual-page .rate-bar {
                display: none;
            }
        }
    </style>
@endsection
@section('pageName', 'Annual Report')
@section('body')
    @php
        $periodLabel = $isAll ? 'All Time' : $pilih_tahun;
        $saved = $income - $spending;
        $savingRate = $income > 0 ? round(($saved / $income) * 100, 1) : 0;
        $usedPct = $income > 0 ? round(($spending / $income) * 100, 1) : 0;

        // Average spending per active month (year) or per year (all time)
        if ($isAll) {
            $avgUnits = max(1, count($periods));
            $avgUnitLabel = 'Year';
        } else {
            $avgUnits = $pilih_tahun == date('Y') ? (int) date('n') : 12;
            $avgUnitLabel = 'Month';
        }
        $avgSpending = $spending / $avgUnits;

        $active = collect($periods)->filter(fn($p) => $p['count'] > 0);
        $bestPeriod = $active->sortByDesc(fn($p) => $p['income'] - $p['spending'])->first();
        $peakSpending = $active->sortByDesc('spending')->first();
        $topCategory = $categories->first();
    @endphp

    <div class="annual-page">

        <div class="row">
            <div class="col-xl-8 col-lg-7 mb-4">
                <div class="hero {{ $saved < 0 ? 'negative' : '' }}">
                    <div class="d-label"><i class="far fa-calendar-alt mr-1"></i> {{ $periodLabel }} · Net {{ $saved >= 0 ? 'Saved' : 'Overspent' }}</div>
                    <div class="d-amount hero-amount">{{ $saved < 0 ? '-' : '' }}@mataUang(abs($saved))</div>
                    <div class="used-bar"><span style="width: {{ min(100, $usedPct) }}%"></span></div>
                    <div class="hero-meta">
                        @if ($income > 0)
                            {{ $usedPct }}% of income spent · {{ number_format($transCount, 0, ',', '.') }} transactions
                        @else
                            No income recorded {{ $isAll ? 'yet' : 'in ' . $pilih_tahun }}
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-5 mb-4">
                <div class="d-card filter-card p-3">
                    <div class="d-label mb-2 px-1"><i class="fa fa-filter mr-1"></i> Period</div>
                    <form action="{{ route('user.report.annual') }}" method="GET">
                        <div class="form-group mb-2">
                            <select class="form-control" name="tahun" onchange="this.form.submit()">
                                <option value="all" {{ $isAll ? 'selected' : '' }}>All Time</option>
                                @for ($i = max(date('Y'), $firstYear); $i >= min($firstYear, 2020); $i--)
                                    <option value="{{ $i }}" {{ !$isAll && $pilih_tahun == $i ? 'selected' : '' }}>{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                    </form>
                    <div class="quick px-1">
                        <a href="{{ route('user.report.annual', ['tahun' => date('Y')]) }}"
                            class="{{ !$isAll && $pilih_tahun == date('Y') ? 'active' : '' }}">This Year</a>
                        <a href="{{ route('user.report.annual', ['tahun' => date('Y') - 1]) }}"
                            class="{{ !$isAll && $pilih_tahun == date('Y') - 1 ? 'active' : '' }}">Last Year</a>
                        <a href="{{ route('user.report.annual', ['tahun' => 'all']) }}"
                            class="{{ $isAll ? 'active' : '' }}">All Time</a>
                    </div>
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
                    <div class="stat-icon" style="background: var(--red-soft); color: var(--red);"><i class="fa fa-arrow-down"></i></div>
                    <div style="min-width: 0;">
                        <div class="d-label">Spending</div>
                        <div class="d-amount">@mataUang($spending)</div>
                        @if ($peakSpending)
                            <div class="sub">peak: {{ $peakSpending['label'] }}</div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-4">
                <div class="d-card stat">
                    <div class="stat-icon"
                        style="background: {{ $saved >= 0 ? 'var(--blue-soft)' : 'var(--red-soft)' }}; color: {{ $saved >= 0 ? 'var(--blue)' : 'var(--red)' }};">
                        <i class="fa fa-piggy-bank"></i></div>
                    <div style="min-width: 0;">
                        <div class="d-label">Saving Rate</div>
                        <div class="d-amount">{{ $savingRate }}%</div>
                        @if ($bestPeriod)
                            <div class="sub">best: {{ $bestPeriod['label'] }}</div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-4">
                <div class="d-card stat">
                    <div class="stat-icon" style="background: var(--amber-soft); color: var(--amber);"><i class="fa fa-calendar-day"></i></div>
                    <div style="min-width: 0;">
                        <div class="d-label">Avg Spending / {{ $avgUnitLabel }}</div>
                        <div class="d-amount">@mataUang($avgSpending)</div>
                        <div class="sub">over {{ $avgUnits }} {{ strtolower($avgUnitLabel) }}{{ $avgUnits > 1 ? 's' : '' }}</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="d-card mb-4" style="height: auto;">
            <div class="card-head">
                <h6><i class="fas fa-chart-bar"></i> {{ $isAll ? 'Yearly' : 'Monthly' }} Cash Flow</h6>
                <div class="legend">
                    <span><i style="background: #12b886"></i>Income</span>
                    <span><i style="background: #f0565b"></i>Spending</span>
                    <span><i style="background: #7048e8"></i>Saved</span>
                </div>
            </div>
            @if ($transCount == 0)
                <div class="empty">
                    <div><i class="fas fa-chart-bar"></i></div>
                    No transactions recorded for this period
                </div>
            @else
                <div class="chart-box" style="height: 320px;">
                    <canvas id="flowChart"></canvas>
                </div>
            @endif
        </div>

        <div class="row">
            <div class="col-lg-7 mb-4">
                <div class="d-card">
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
                            <canvas id="categoryChart"></canvas>
                        </div>
                    @endif
                </div>
            </div>
            <div class="col-lg-5 mb-4">
                <div class="d-card">
                    <div class="card-head">
                        <h6><i class="fas fa-fire"></i> Top 10 Expenses</h6>
                    </div>
                    @if ($topExpenses->isEmpty())
                        <div class="empty">
                            <div><i class="fas fa-inbox"></i></div>
                            No expenses for this period
                        </div>
                    @else
                        <ul class="top-list">
                            @foreach ($topExpenses as $te)
                                <li>
                                    <div class="top-rank">{{ $loop->iteration }}</div>
                                    <div class="top-info">
                                        <div class="desc" title="{{ $te->trans_information }}">{{ $te->trans_information ?: '-' }}</div>
                                        <div class="meta">{{ optional($te->tag)->tag_name ?? '-' }} · {{ \Carbon\Carbon::parse($te->trans_date)->format('d M Y') }}</div>
                                    </div>
                                    <div class="top-amount">@mataUang2($te->trans_value)</div>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>

        <div class="d-card mb-4" style="height: auto;">
            <div class="card-head">
                <h6><i class="fas fa-table"></i> {{ $isAll ? 'Yearly' : 'Monthly' }} Breakdown</h6>
            </div>
            <div class="tbl-wrap">
                <table class="tbl">
                    <thead>
                        <tr>
                            <th>{{ $isAll ? 'Year' : 'Month' }}</th>
                            <th class="num">Income (Rp)</th>
                            <th class="num">Spending (Rp)</th>
                            <th class="num">Saved (Rp)</th>
                            <th class="num">Saving Rate</th>
                            <th class="num">Trx</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($periods as $p)
                            @php
                                $pSaved = $p['income'] - $p['spending'];
                                $pRate = $p['income'] > 0 ? round(($pSaved / $p['income']) * 100, 1) : null;
                            @endphp
                            <tr class="{{ $p['count'] == 0 ? 'is-empty' : '' }}">
                                <td class="period">
                                    @if ($isAll)
                                        <a href="{{ route('user.report.annual', ['tahun' => $p['key']]) }}">{{ $p['label'] }}</a>
                                    @else
                                        <a href="{{ route('user.report', ['bulan' => $p['key'], 'tahun' => $pilih_tahun]) }}">{{ date('F', mktime(0, 0, 0, $p['key'], 1)) }}</a>
                                    @endif
                                </td>
                                <td class="num">@mataUang2($p['income'])</td>
                                <td class="num">@mataUang2($p['spending'])</td>
                                <td class="num {{ $pSaved > 0 ? 'pos' : ($pSaved < 0 ? 'neg' : '') }}">{{ $pSaved < 0 ? '-' : '' }}@mataUang2(abs($pSaved))</td>
                                <td class="num">
                                    @if ($pRate === null)
                                        -
                                    @else
                                        <span class="rate-bar"><span style="width: {{ max(0, min(100, $pRate)) }}%"></span></span>{{ $pRate }}%
                                    @endif
                                </td>
                                <td class="num">{{ $p['count'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td>Total</td>
                            <td class="num">@mataUang2($income)</td>
                            <td class="num">@mataUang2($spending)</td>
                            <td class="num {{ $saved > 0 ? 'pos' : ($saved < 0 ? 'neg' : '') }}">{{ $saved < 0 ? '-' : '' }}@mataUang2(abs($saved))</td>
                            <td class="num">{{ $income > 0 ? $savingRate . '%' : '-' }}</td>
                            <td class="num">{{ $transCount }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>

    </div>
@endsection
@section('script')
    <script src="{{ asset('komponen/app') }}/vendor/chart.js/Chart.min.js"></script>
    <script type="text/javascript">
        $('#mn-annual').addClass('active');

        const fmtRp = (n) => 'Rp. ' + Number(n || 0).toLocaleString('id-ID', { maximumFractionDigits: 0 });
        const fmtShort = (n) => {
            n = Number(n || 0);
            const sign = n < 0 ? '-' : '';
            n = Math.abs(n);
            if (n >= 1e9) return sign + (n / 1e9).toLocaleString('id-ID', { maximumFractionDigits: 1 }) + ' M';
            if (n >= 1e6) return sign + (n / 1e6).toLocaleString('id-ID', { maximumFractionDigits: 1 }) + ' jt';
            if (n >= 1e3) return sign + (n / 1e3).toLocaleString('id-ID', { maximumFractionDigits: 0 }) + ' rb';
            return sign + n.toLocaleString('id-ID');
        };

        Chart.defaults.global.defaultFontFamily = 'Nunito, -apple-system, system-ui, "Segoe UI", Roboto, Arial, sans-serif';
        Chart.defaults.global.defaultFontColor = '#8a90a8';

        const tooltipStyle = {
            backgroundColor: '#1e2340',
            cornerRadius: 10,
            xPadding: 12,
            yPadding: 10,
        };
        const gridStyle = {
            color: '#eef0f6',
            zeroLineColor: '#dfe2ec',
            drawBorder: false,
            borderDash: [3],
        };

        const periods = @json($periods);
        const flowCtx = document.getElementById('flowChart');

        if (flowCtx) {
            new Chart(flowCtx, {
                type: 'bar',
                data: {
                    labels: periods.map(p => p.label),
                    datasets: [{
                        type: 'line',
                        label: 'Saved',
                        data: periods.map(p => p.income - p.spending),
                        borderColor: '#7048e8',
                        backgroundColor: 'transparent',
                        pointBackgroundColor: '#7048e8',
                        pointRadius: 3,
                        borderWidth: 2,
                        lineTension: .3,
                        fill: false,
                    }, {
                        label: 'Income',
                        data: periods.map(p => p.income),
                        backgroundColor: '#12b886',
                        borderWidth: 0,
                        maxBarThickness: 22,
                    }, {
                        label: 'Spending',
                        data: periods.map(p => p.spending),
                        backgroundColor: '#f0565b',
                        borderWidth: 0,
                        maxBarThickness: 22,
                    }],
                },
                options: {
                    maintainAspectRatio: false,
                    responsive: true,
                    legend: { display: false },
                    scales: {
                        xAxes: [{
                            gridLines: { display: false, drawBorder: false },
                            ticks: { fontStyle: '600', fontColor: '#1e2340' },
                        }],
                        yAxes: [{
                            ticks: { maxTicksLimit: 6, callback: (v) => fmtShort(v) },
                            gridLines: gridStyle,
                        }],
                    },
                    tooltips: Object.assign({}, tooltipStyle, {
                        mode: 'index',
                        intersect: false,
                        callbacks: {
                            label: (item, data) => `${data.datasets[item.datasetIndex].label}: ${fmtRp(item.yLabel)}`,
                        },
                    }),
                },
            });
        }

        const categories = @json($categories);
        const catCtx = document.getElementById('categoryChart');

        if (catCtx && categories.length) {
            const g = catCtx.getContext('2d');
            const grad = g.createLinearGradient(0, 0, catCtx.parentNode.clientWidth || 600, 0);
            grad.addColorStop(0, '#f0565b');
            grad.addColorStop(1, '#e64980');
            const total = categories.reduce((s, c) => s + c.value, 0);

            new Chart(catCtx, {
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
                            ticks: { min: 0, maxTicksLimit: 5, callback: (v) => fmtShort(v) },
                            gridLines: gridStyle,
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
                    tooltips: Object.assign({}, tooltipStyle, {
                        displayColors: false,
                        callbacks: {
                            title: (items) => categories[items[0].index].name,
                            label: (item) => {
                                const pct = total ? (item.xLabel / total * 100).toFixed(1) : 0;
                                return `${fmtRp(item.xLabel)} (${pct}%)`;
                            },
                        },
                    }),
                },
            });
        }
    </script>
@endsection
