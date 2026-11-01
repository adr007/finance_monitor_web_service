@extends('_layouts.app')
@section('css')
    <style>
        .dash {
            --ink: #1e2340;
            --muted: #8a90a8;
            --line: #eef0f6;
            --surface: #ffffff;
            --green: #12b886;
            --green-soft: #e6f8f1;
            --red: #f0565b;
            --red-soft: #fdecec;
            --blue: #4c6ef5;
            --blue-soft: #edf1fe;
            --amber: #f59f00;
            --amber-soft: #fff4dc;
            color: var(--ink);
        }

        .dash .d-card {
            background: var(--surface);
            border: 1px solid var(--line);
            border-radius: 18px;
            box-shadow: 0 6px 24px rgba(30, 35, 64, .06);
            height: 100%;
        }

        .dash .d-label {
            font-size: .72rem;
            font-weight: 700;
            letter-spacing: .08em;
            text-transform: uppercase;
            color: var(--muted);
        }

        .dash .d-amount {
            font-weight: 800;
            font-variant-numeric: tabular-nums;
            white-space: nowrap;
        }

        /* Hero */
        .dash .hero {
            position: relative;
            overflow: hidden;
            border-radius: 18px;
            padding: 26px 28px;
            color: #fff;
            height: 100%;
            background: linear-gradient(135deg, #4c6ef5 0%, #7048e8 55%, #ae3ec9 100%);
            box-shadow: 0 12px 30px rgba(112, 72, 232, .35);
        }

        .dash .hero::before,
        .dash .hero::after {
            content: '';
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, .1);
        }

        .dash .hero::before {
            width: 220px;
            height: 220px;
            right: -60px;
            top: -80px;
        }

        .dash .hero::after {
            width: 140px;
            height: 140px;
            right: 80px;
            bottom: -70px;
        }

        .dash .hero .d-label {
            color: rgba(255, 255, 255, .75);
        }

        .dash .hero-amount {
            font-size: 2.1rem;
            line-height: 1.15;
            margin: 6px 0 18px;
        }

        .dash .hero-chip {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 12px;
            margin: 0 6px 6px 0;
            border-radius: 999px;
            font-size: .8rem;
            font-weight: 600;
            background: rgba(255, 255, 255, .16);
            backdrop-filter: blur(4px);
        }

        /* Savings ring */
        .dash .ring {
            position: relative;
            width: 96px;
            height: 96px;
            flex-shrink: 0;
        }

        .dash .ring svg {
            transform: rotate(-90deg);
        }

        .dash .ring-text {
            position: absolute;
            inset: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            font-size: 1rem;
        }

        /* Filter */
        .dash .filter-card .form-control {
            border-radius: 12px;
            border-color: var(--line);
            background: #f7f8fc;
            font-weight: 600;
        }

        .dash .filter-card .btn {
            border-radius: 12px;
            font-weight: 700;
            background: var(--ink);
            border-color: var(--ink);
        }

        /* KPI tiles */
        .dash .kpi {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 18px;
            transition: transform .15s ease, box-shadow .15s ease;
        }

        .dash .kpi:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 28px rgba(30, 35, 64, .1);
        }

        .dash .kpi-icon {
            width: 46px;
            height: 46px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
            flex-shrink: 0;
        }

        .dash .kpi .d-amount {
            font-size: 1.15rem;
        }

        .dash .tone-green .kpi-icon { background: var(--green-soft); color: var(--green); }
        .dash .tone-red .kpi-icon { background: var(--red-soft); color: var(--red); }
        .dash .tone-blue .kpi-icon { background: var(--blue-soft); color: var(--blue); }
        .dash .tone-amber .kpi-icon { background: var(--amber-soft); color: var(--amber); }

        /* Transaction lists */
        .dash .list-head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 18px 20px 14px;
            border-bottom: 1px solid var(--line);
        }

        .dash .list-head h6 {
            margin: 0;
            font-weight: 800;
            color: var(--ink);
        }

        .dash .count-badge {
            font-size: .72rem;
            font-weight: 700;
            padding: 3px 9px;
            border-radius: 999px;
            margin-left: 8px;
        }

        .dash .list-body {
            max-height: 460px;
            overflow-y: auto;
            padding: 6px 10px 10px;
        }

        .dash .tx {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px;
            border-radius: 12px;
        }

        .dash .tx:hover {
            background: #f7f8fc;
        }

        .dash .tx-date {
            width: 44px;
            flex-shrink: 0;
            text-align: center;
            border-radius: 10px;
            padding: 4px 0;
            line-height: 1.1;
        }

        .dash .tx-date b {
            display: block;
            font-size: 1rem;
        }

        .dash .tx-date small {
            font-size: .65rem;
            font-weight: 700;
            text-transform: uppercase;
        }

        .dash .tx-info {
            flex: 1;
            min-width: 0;
        }

        .dash .tx-title {
            font-weight: 600;
            font-size: .9rem;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .dash .tx-sub {
            font-size: .75rem;
            color: var(--muted);
        }

        .dash .tx .d-amount {
            font-size: .9rem;
        }

        .dash .is-up .tx-date,
        .dash .is-up .count-badge { background: var(--green-soft); color: var(--green); }
        .dash .is-up .tx .d-amount { color: var(--green); }
        .dash .is-down .tx-date,
        .dash .is-down .count-badge { background: var(--red-soft); color: var(--red); }
        .dash .is-down .tx .d-amount { color: var(--red); }

        .dash .empty {
            text-align: center;
            padding: 48px 0;
            color: var(--muted);
        }

        .dash .empty i {
            font-size: 2rem;
            opacity: .4;
            margin-bottom: 10px;
        }

        /* Asset allocation */
        .dash .alloc-row {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 12px 0;
            border-bottom: 1px solid var(--line);
        }

        .dash .alloc-row:last-child {
            border-bottom: 0;
        }

        .dash .alloc-icon {
            width: 40px;
            height: 40px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .dash .alloc-bar {
            height: 6px;
            border-radius: 999px;
            background: var(--line);
            overflow: hidden;
            margin-top: 6px;
        }

        .dash .alloc-bar span {
            display: block;
            height: 100%;
            border-radius: 999px;
        }

        .dash .chart-wrap {
            position: relative;
            max-width: 260px;
            margin: 0 auto;
        }

        .dash .chart-center {
            position: absolute;
            inset: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            pointer-events: none;
        }

        .dash .btc-tile {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 14px 16px;
            margin-top: 22px;
            border-radius: 14px;
            background: linear-gradient(135deg, #fff4dc, #ffe8b0);
        }

        .dash .btc-tile i {
            font-size: 1.8rem;
            color: var(--amber);
        }

        .dash .section-title {
            font-weight: 800;
            margin: 8px 0 16px;
        }

        .dash .chart-center>div {
            max-width: 62%;
            text-align: center;
            line-height: 1.25;
        }

        .dash .chart-center #chartValue {
            font-size: clamp(.8rem, 2.6vw, 1rem);
            white-space: normal;
            overflow-wrap: anywhere;
        }

        .dash .chart-center #chartPct {
            font-size: .8rem;
            font-weight: 700;
            margin-top: 2px;
        }

        .dash .chart-center #chartLabel {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .dash .alloc-row {
            cursor: default;
            border-radius: 10px;
            transition: background .15s ease;
        }

        .dash .alloc-row.active {
            background: #f7f8fc;
        }

        .dash .alloc-top {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: baseline;
            column-gap: 10px;
        }

        .dash .list-head {
            flex-wrap: wrap;
            gap: 6px 12px;
        }

        /* Filter form: selects side by side only when the card is wide enough */
        .dash .filter-card {
            container-type: inline-size;
        }

        .dash .filter-card .col-md-6 {
            flex: 0 0 100%;
            max-width: 100%;
        }

        .dash .filter-card .form-group {
            margin-bottom: .6rem;
        }

        @container (min-width: 300px) {
            .dash .filter-card .col-md-6 {
                flex: 0 0 50%;
                max-width: 50%;
            }
        }

        /* Amounts on big cards may wrap after "Rp." rather than overflow */
        .dash .hero .d-amount,
        .dash .saving .d-amount {
            white-space: normal;
            overflow-wrap: anywhere;
        }

        .dash .hero-amount {
            font-size: clamp(1.5rem, 5vw, 2.1rem);
        }

        @media (max-width: 575.98px) {
            .dash .hero {
                padding: 20px;
            }

            .dash .d-card.p-4 {
                padding: 1.1rem !important;
            }

            .dash .d-card.px-4 {
                padding-left: 1rem !important;
                padding-right: 1rem !important;
            }

            .dash .kpi {
                padding: 14px;
            }

            .dash .list-head {
                padding: 14px 14px 10px;
            }

            .dash .list-body {
                max-height: 380px;
                padding: 4px 4px 8px;
            }

            .dash .tx {
                gap: 10px;
                padding: 8px 6px;
            }

            .dash .ring {
                width: 80px;
                height: 80px;
            }

            .dash .ring svg {
                width: 80px;
                height: 80px;
            }

            .dash .alloc-icon {
                width: 34px;
                height: 34px;
            }
        }
    </style>
@endsection
@section('pageName', 'Dashboard ' . date('F', mktime(0, 0, 0, $pilih_bulan, 1)) . ' ' . $pilih_tahun)
@section('body')

    @php
        $persen = 0;
        if ($thisMonth['income'] >= 1) {
            $persen = ($monthSaved / $thisMonth['income']) * 100;
        }

        if ($monthSaved <= 0) {
            $tone = 'var(--red)';
            $text2 = 'Wasteful';
            $hint = 'Spending is higher than income this month.';
        } else {
            $tone = 'var(--green)';
            $text2 = 'You Save';
            $hint = 'Of this month\'s income is kept.';
        }

        // Ring: r=40 → circumference ≈ 251.3
        $ringPct = max(0, min(100, $persen));
        $ringOffset = 251.3 - (251.3 * $ringPct) / 100;

        $palette = [
            'text-info' => '#15aabf',
            'text-warning' => '#f59f00',
            'text-primary' => '#4c6ef5',
            'text-success' => '#12b886',
            'text-danger' => '#f0565b',
        ];
        $fallback = ['#7048e8', '#ae3ec9', '#20c997', '#fd7e14', '#868e96'];
        foreach ($assetSpread as $i => $spread) {
            $assetSpread[$i]['hex'] = $palette[$spread['asset_color']] ?? $fallback[$i % count($fallback)];
        }

        $monthName = date('F', mktime(0, 0, 0, $pilih_bulan, 1));
    @endphp

    <div class="dash">

        <div class="row">
            <div class="col-xl-5 col-lg-12 mb-4">
                <div class="hero">
                    <div class="d-label"><i class="far fa-gem mr-1"></i> Total Assets</div>
                    <div class="d-amount hero-amount">@mataUang($totalAssets)</div>
                    <div>
                        <span class="hero-chip"><i class="fa fa-arrow-up"></i> @mataUang($thisMonth['income'])</span>
                        <span class="hero-chip"><i class="fa fa-arrow-down"></i> @mataUang($thisMonth['spending'])</span>
                    </div>
                    <div class="mt-2" style="font-size: .8rem; opacity: .8;">
                        <i class="far fa-calendar-alt mr-1"></i> {{ $monthName }} {{ $pilih_tahun }}
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-md-6 mb-4">
                <div class="d-card saving p-4 d-flex align-items-center" style="gap: 18px;">
                    <div class="ring">
                        <svg width="96" height="96" viewBox="0 0 96 96">
                            <circle cx="48" cy="48" r="40" fill="none" stroke="#eef0f6" stroke-width="10" />
                            <circle cx="48" cy="48" r="40" fill="none" stroke="{{ $tone }}" stroke-width="10"
                                stroke-linecap="round" stroke-dasharray="251.3"
                                stroke-dashoffset="{{ $ringOffset }}" />
                        </svg>
                        <div class="ring-text" style="color: {{ $tone }}">{{ round($persen, 1) }}%</div>
                    </div>
                    <div style="min-width: 0;">
                        <div class="d-label" style="color: {{ $tone }}">This Month {{ $text2 }}</div>
                        <div class="d-amount" style="font-size: 1.4rem;">@mataUang($monthSaved)</div>
                        <div class="tx-sub mt-1">{{ $hint }}</div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="d-card filter-card p-3">
                    <div class="d-label mb-2 px-1"><i class="fa fa-filter mr-1"></i> Period</div>
                    @include('_components.form_bulan')
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-3 col-sm-6 mb-4">
                <div class="d-card kpi tone-green">
                    <div class="kpi-icon"><i class="fa fa-arrow-up"></i></div>
                    <div>
                        <div class="d-label">Today Income</div>
                        <div class="d-amount">@mataUang($today['income'])</div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-4">
                <div class="d-card kpi tone-red">
                    <div class="kpi-icon"><i class="fa fa-arrow-down"></i></div>
                    <div>
                        <div class="d-label">Today Spending</div>
                        <div class="d-amount">@mataUang($today['spending'])</div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-4">
                <div class="d-card kpi tone-blue">
                    <div class="kpi-icon"><i class="fa fa-wallet"></i></div>
                    <div>
                        <div class="d-label">Month Income</div>
                        <div class="d-amount">@mataUang($thisMonth['income'])</div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-4">
                <div class="d-card kpi tone-amber">
                    <div class="kpi-icon"><i class="fa fa-shopping-bag"></i></div>
                    <div>
                        <div class="d-label">Month Spending</div>
                        <div class="d-amount">@mataUang($thisMonth['spending'])</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6 mb-4">
                <div class="d-card is-up">
                    <div class="list-head">
                        <h6>Income Stream <span class="count-badge">{{ count($transUp) }}</span></h6>
                        <span class="d-amount" style="color: var(--green)">+ @mataUang($thisMonth['income'])</span>
                    </div>
                    <div class="list-body">
                        @forelse ($transUp as $tu)
                            @php $dt = \Carbon\Carbon::parse($tu->trans_date); @endphp
                            <div class="tx">
                                <div class="tx-date"><b>{{ $dt->format('d') }}</b><small>{{ $dt->format('M') }}</small></div>
                                <div class="tx-info">
                                    <div class="tx-title" title="{{ $tu->trans_information }}">{{ $tu->trans_information }}</div>
                                    <div class="tx-sub">{{ optional($tu->subAsset)->sub_name ?? '-' }}</div>
                                </div>
                                <div class="d-amount">+@mataUang2($tu->trans_value)</div>
                            </div>
                        @empty
                            <div class="empty">
                                <div><i class="fas fa-inbox"></i></div>
                                No income recorded this month
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

            <div class="col-lg-6 mb-4">
                <div class="d-card is-down">
                    <div class="list-head">
                        <h6>Expenses <span class="count-badge">{{ count($transDown) }}</span></h6>
                        <span class="d-amount" style="color: var(--red)">- @mataUang($thisMonth['spending'])</span>
                    </div>
                    <div class="list-body">
                        @forelse ($transDown as $td)
                            @php $dt = \Carbon\Carbon::parse($td->trans_date); @endphp
                            <div class="tx">
                                <div class="tx-date"><b>{{ $dt->format('d') }}</b><small>{{ $dt->format('M') }}</small></div>
                                <div class="tx-info">
                                    <div class="tx-title" title="{{ $td->trans_information }}">{{ $td->trans_information }}</div>
                                    <div class="tx-sub">{{ optional($td->subAsset)->sub_name ?? '-' }}</div>
                                </div>
                                <div class="d-amount">-@mataUang2($td->trans_value)</div>
                            </div>
                        @empty
                            <div class="empty">
                                <div><i class="fas fa-inbox"></i></div>
                                No expenses recorded this month
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

        <h5 class="section-title">Assets Spread</h5>
        <div class="row">
            <div class="col-lg-5 mb-4">
                <div class="d-card p-4">
                    <div class="chart-wrap">
                        <canvas id="assetChart" height="260" width="260"></canvas>
                        <div class="chart-center">
                            <div class="d-label" id="chartLabel">Total</div>
                            <div class="d-amount" id="chartValue">@mataUang($totalAssets)</div>
                            <div id="chartPct"></div>
                        </div>
                    </div>
                    <div class="btc-tile">
                        <i class="fab fa-bitcoin"></i>
                        <div>
                            <div class="d-label" style="color: #b07400;">BTC Holdings</div>
                            <div class="d-amount">@mataUang($btc_fiat)</div>
                            <div class="tx-sub">{{ $btc }} BTC</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-7 mb-4">
                <div class="d-card px-4 py-2">
                    @foreach ($assetSpread as $spread)
                        <div class="alloc-row" data-index="{{ $loop->index }}">
                            <div class="alloc-icon" style="background: {{ $spread['hex'] }}1f; color: {{ $spread['hex'] }};">
                                <i class="{{ $spread['asset_icon'] }}"></i>
                            </div>
                            <div class="flex-grow-1" style="min-width: 0;">
                                <div class="alloc-top">
                                    <span class="font-weight-bold">{{ $spread['asset_name'] }}</span>
                                    <span class="d-amount" style="font-size: .9rem;">Rp. @mataUang2($spread['asset_value'])</span>
                                </div>
                                <div class="d-flex align-items-center" style="gap: 10px;">
                                    <div class="alloc-bar flex-grow-1">
                                        <span style="width: {{ $spread['asset_persen'] }}%; background: {{ $spread['hex'] }};"></span>
                                    </div>
                                    <span class="tx-sub font-weight-bold" style="min-width: 48px; text-align: right;">{{ $spread['asset_persen'] }}%</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

    </div>

@endsection
@section('script')
    <script src="{{ asset('komponen/app') }}/vendor/chart.js/Chart.min.js"></script>
    <script type="text/javascript">
        $('#mn1').addClass('active');

        $('#pilih_bulan').val('{{ $pilih_bulan }}');
        $('#pilih_tahun').val('{{ $pilih_tahun }}');

        @php
            $chartData = array_map(function ($s) {
                return ['name' => $s['asset_name'], 'value' => $s['asset_value'], 'pct' => $s['asset_persen'], 'color' => $s['hex']];
            }, $assetSpread);
        @endphp
        const spread = {!! json_encode($chartData) !!};

        const $label = $('#chartLabel');
        const $value = $('#chartValue');
        const $pct = $('#chartPct');
        const defaultCenter = { label: $label.text(), value: $value.text() };

        // Hover info is shown inside the donut hole instead of a floating tooltip,
        // so it never overlaps the center text.
        function showCenter(index) {
            $('.alloc-row').removeClass('active');
            if (index === null || !spread[index]) {
                $label.text(defaultCenter.label).css('color', '');
                $value.text(defaultCenter.value);
                $pct.text('');
                return;
            }
            const s = spread[index];
            $label.text(s.name).css('color', s.color);
            $value.text('Rp. ' + Number(s.value).toLocaleString('id-ID'));
            $pct.text(s.pct + '%').css('color', s.color);
            $('.alloc-row[data-index="' + index + '"]').addClass('active');
        }

        new Chart(document.getElementById('assetChart'), {
            type: 'doughnut',
            data: {
                labels: spread.map(s => s.name),
                datasets: [{
                    data: spread.map(s => s.value),
                    backgroundColor: spread.map(s => s.color),
                    borderColor: '#fff',
                    borderWidth: 3,
                    hoverBorderColor: '#fff',
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                aspectRatio: 1,
                cutoutPercentage: 72,
                legend: { display: false },
                tooltips: { enabled: false },
                hover: { mode: 'nearest', intersect: true },
                onHover: (evt, els) => showCenter(els.length ? els[0]._index : null),
            }
        });

        $('.alloc-row')
            .on('mouseenter', function() { showCenter($(this).data('index')); })
            .on('mouseleave', function() { showCenter(null); });
    </script>
@endsection
