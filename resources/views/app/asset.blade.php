@extends('_layouts.app')
@section('css')
    <style>
        .assets-page {
            --ink: #1e2340;
            --muted: #8a90a8;
            --line: #eef0f6;
            --soft: #f7f8fc;
            color: var(--ink);
        }

        .assets-page .d-label {
            font-size: .72rem;
            font-weight: 700;
            letter-spacing: .08em;
            text-transform: uppercase;
            color: var(--muted);
        }

        .assets-page .d-amount {
            font-weight: 800;
            font-variant-numeric: tabular-nums;
        }

        /* Hero */
        .assets-page .hero {
            position: relative;
            overflow: hidden;
            border-radius: 18px;
            padding: 26px 28px;
            color: #fff;
            background: linear-gradient(135deg, #4c6ef5 0%, #7048e8 55%, #ae3ec9 100%);
            box-shadow: 0 12px 30px rgba(112, 72, 232, .3);
        }

        .assets-page .hero::before,
        .assets-page .hero::after {
            content: '';
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, .1);
            pointer-events: none;
        }

        .assets-page .hero::before {
            width: 240px;
            height: 240px;
            right: -70px;
            top: -90px;
        }

        .assets-page .hero::after {
            width: 150px;
            height: 150px;
            right: 120px;
            bottom: -80px;
        }

        .assets-page .hero .d-label {
            color: rgba(255, 255, 255, .75);
        }

        .assets-page .hero-amount {
            font-size: clamp(1.5rem, 5vw, 2.2rem);
            line-height: 1.15;
            margin: 6px 0 4px;
            overflow-wrap: anywhere;
        }

        .assets-page .hero-meta {
            font-size: .85rem;
            opacity: .85;
        }

        .assets-page .hero-actions {
            position: relative;
            z-index: 1;
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .assets-page .h-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 10px 18px;
            border-radius: 12px;
            border: 0;
            font-weight: 700;
            font-size: .88rem;
            cursor: pointer;
            white-space: nowrap;
            transition: transform .15s ease, box-shadow .15s ease, background .15s ease;
        }

        .assets-page .h-btn:hover {
            transform: translateY(-2px);
            text-decoration: none;
        }

        .assets-page .h-btn:focus {
            outline: 2px solid rgba(255, 255, 255, .7);
            outline-offset: 2px;
        }

        .assets-page .h-btn.light {
            background: #fff;
            color: #5b4be0;
        }

        .assets-page .h-btn.glass {
            background: rgba(255, 255, 255, .18);
            color: #fff;
        }

        .assets-page .h-btn.glass:hover {
            background: rgba(255, 255, 255, .28);
        }

        .assets-page .h-btn.warm {
            color: #fff;
            background-image: linear-gradient(to right, #fc6076, #ff9a44, #ef9d43, #e75516);
            background-size: 300% 100%;
            box-shadow: 0 4px 15px rgba(252, 104, 110, .45);
        }

        .assets-page .h-btn.warm:hover {
            background-position: 100% 0;
            color: #fff;
        }

        /* Class summary / filter chips */
        .assets-page .toolbar {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 12px;
            margin: 22px 0 18px;
        }

        .assets-page .chips {
            display: flex;
            gap: 8px;
            overflow-x: auto;
            padding-bottom: 4px;
            flex: 1 1 auto;
            min-width: 0;
            scrollbar-width: thin;
        }

        .assets-page .chip {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            flex-shrink: 0;
            padding: 8px 14px;
            border-radius: 999px;
            border: 1px solid var(--line);
            background: #fff;
            color: var(--ink);
            font-size: .82rem;
            font-weight: 700;
            cursor: pointer;
            transition: all .15s ease;
        }

        .assets-page .chip small {
            font-weight: 600;
            color: var(--muted);
        }

        .assets-page .chip .dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: var(--c, var(--ink));
        }

        .assets-page .chip:hover {
            border-color: var(--c, var(--ink));
        }

        .assets-page .chip.active {
            background: var(--c, var(--ink));
            border-color: var(--c, var(--ink));
            color: #fff;
        }

        .assets-page .chip.active small {
            color: rgba(255, 255, 255, .8);
        }

        .assets-page .chip.active .dot {
            background: #fff;
        }

        .assets-page .search {
            position: relative;
            flex: 0 1 260px;
            min-width: 200px;
        }

        .assets-page .search i {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--muted);
            font-size: .85rem;
        }

        .assets-page .search input {
            width: 100%;
            padding: 9px 14px 9px 38px;
            border-radius: 12px;
            border: 1px solid var(--line);
            background: #fff;
            font-size: .88rem;
            color: var(--ink);
        }

        .assets-page .search input:focus {
            outline: none;
            border-color: #7048e8;
            box-shadow: 0 0 0 3px rgba(112, 72, 232, .12);
        }

        /* Asset cards */
        .assets-page .a-card {
            position: relative;
            height: 100%;
            display: flex;
            flex-direction: column;
            padding: 18px;
            border-radius: 18px;
            background: #fff;
            border: 1px solid var(--line);
            box-shadow: 0 6px 24px rgba(30, 35, 64, .06);
            overflow: hidden;
            transition: transform .15s ease, box-shadow .15s ease;
        }

        .assets-page .a-card::before {
            content: '';
            position: absolute;
            left: 0;
            right: 0;
            top: 0;
            height: 4px;
            background: var(--c);
        }

        .assets-page .a-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 14px 30px rgba(30, 35, 64, .1);
        }

        .assets-page .a-head {
            display: flex;
            align-items: flex-start;
            gap: 12px;
        }

        .assets-page .a-icon {
            width: 44px;
            height: 44px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            font-size: 1.15rem;
            color: var(--c);
            background: var(--c-soft);
        }

        .assets-page .a-title {
            flex: 1;
            min-width: 0;
        }

        .assets-page .a-name {
            font-weight: 800;
            font-size: .98rem;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .assets-page .a-class {
            font-size: .72rem;
            font-weight: 700;
            color: var(--c);
            text-transform: uppercase;
            letter-spacing: .05em;
        }

        .assets-page .a-actions {
            display: flex;
            gap: 4px;
            flex-shrink: 0;
        }

        .assets-page .icon-btn {
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

        .assets-page .icon-btn:hover {
            background: #edf1fe;
            color: #4c6ef5;
        }

        .assets-page .icon-btn.danger:hover {
            background: #fdecec;
            color: #f0565b;
        }

        .assets-page .a-value {
            font-size: 1.3rem;
            margin: 16px 0 2px;
            overflow-wrap: anywhere;
        }

        .assets-page .a-qty {
            font-size: .78rem;
            color: var(--muted);
            font-weight: 600;
        }

        .assets-page .a-share {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-top: 12px;
        }

        .assets-page .a-bar {
            flex: 1;
            height: 6px;
            border-radius: 999px;
            background: var(--line);
            overflow: hidden;
        }

        .assets-page .a-bar span {
            display: block;
            height: 100%;
            border-radius: 999px;
            background: var(--c);
        }

        .assets-page .a-share small {
            font-weight: 700;
            color: var(--muted);
            min-width: 44px;
            text-align: right;
        }

        .assets-page .a-foot {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 6px 10px;
            margin-top: auto;
            padding-top: 14px;
            font-size: .8rem;
            color: var(--muted);
        }

        .assets-page .a-foot .vendor {
            min-width: 0;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .assets-page .code-tag {
            padding: 2px 8px;
            border-radius: 6px;
            background: var(--soft);
            font-family: SFMono-Regular, Menlo, Consolas, monospace;
            font-size: .72rem;
            color: var(--ink);
        }

        .assets-page .empty {
            text-align: center;
            padding: 60px 20px;
            color: var(--muted);
            border: 2px dashed var(--line);
            border-radius: 18px;
            background: #fff;
        }

        .assets-page .empty i {
            font-size: 2.2rem;
            opacity: .4;
            margin-bottom: 10px;
        }

        /* Modals */
        .asset-modal .modal-content {
            border: 0;
            border-radius: 18px;
            overflow: hidden;
            box-shadow: 0 20px 50px rgba(30, 35, 64, .25);
        }

        .asset-modal .modal-header {
            border: 0;
            padding: 18px 22px;
            background: linear-gradient(135deg, #4c6ef5, #7048e8);
        }

        .asset-modal .modal-header .close {
            color: #fff;
            opacity: .8;
            text-shadow: none;
        }

        .asset-modal .modal-body {
            padding: 20px 22px 6px;
        }

        .asset-modal label {
            font-size: .8rem;
            font-weight: 700;
            color: #5a6078;
            margin-bottom: 4px;
        }

        .asset-modal .form-control {
            border-radius: 12px;
            border-color: #e3e6f0;
            background: #f7f8fc;
            height: calc(1.5em + 1rem + 2px);
        }

        .asset-modal .form-control:focus {
            background: #fff;
            border-color: #7048e8;
            box-shadow: 0 0 0 3px rgba(112, 72, 232, .12);
        }

        .asset-modal .modal-footer {
            border: 0;
            padding: 10px 22px 20px;
        }

        .asset-modal .modal-footer .btn {
            border-radius: 12px;
            font-weight: 700;
            padding: 8px 18px;
        }

        .asset-modal .btn-grad {
            color: #fff;
            border: 0;
            background: linear-gradient(135deg, #4c6ef5, #7048e8);
        }

        .asset-modal .btn-grad:hover {
            color: #fff;
            filter: brightness(1.08);
        }

        .asset-modal .conv-arrow {
            text-align: center;
            margin: -6px 0 6px;
            color: #7048e8;
        }

        @media (max-width: 767.98px) {
            .assets-page .search {
                flex: 1 1 100%;
                order: -1;
            }
        }

        @media (max-width: 575.98px) {
            .assets-page .hero {
                padding: 20px;
            }

            .assets-page .hero-actions .h-btn {
                flex: 1 1 calc(50% - 10px);
                padding: 10px 12px;
            }

            .assets-page .hero-actions .h-btn.warm {
                flex-basis: 100%;
            }

            .assets-page .a-card {
                padding: 16px;
            }
        }
    </style>
@endsection
@section('pageName', 'Asset Data')
@section('body')
    @php
        $palette = [
            'text-info' => '#15aabf',
            'text-warning' => '#f59f00',
            'text-primary' => '#4c6ef5',
            'text-success' => '#12b886',
            'text-danger' => '#f0565b',
        ];
        $hexOf = function ($cls) use ($palette) {
            return $palette[$cls] ?? '#7048e8';
        };

        $grandTotal = $assets->sum('sub_value');
        $classSummary = $assets->groupBy('sub_id_asset')->map(function ($items) use ($hexOf) {
            $first = $items->first()->asset;
            return [
                'name' => $first->asset_name,
                'hex' => $hexOf($first->asset_web_color),
                'count' => $items->count(),
                'total' => $items->sum('sub_value'),
            ];
        });
    @endphp

    <div class="assets-page">

        <div class="hero">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-3 mb-lg-0">
                    <div class="d-label"><i class="far fa-gem mr-1"></i> Total Holdings</div>
                    <div class="d-amount hero-amount">@mataUang($grandTotal)</div>
                    <div class="hero-meta">
                        {{ $assets->count() }} accounts across {{ $classSummary->count() }} asset classes
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="hero-actions justify-content-lg-end">
                        <button type="button" onclick="initAdd()" class="h-btn light">
                            <i class="fa fa-plus"></i> Add Asset
                        </button>
                        <button type="button" onclick="initConv()" class="h-btn glass">
                            <i class="fa fa-exchange-alt"></i> Convert
                        </button>
                        <a href="{{ route('auth.asset.update-real-val') }}" class="h-btn warm">
                            💸 Update Real Value
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="toolbar">
            <div class="chips" role="tablist">
                <button type="button" class="chip active" data-filter="all">
                    All <small>{{ $assets->count() }}</small>
                </button>
                @foreach ($classSummary as $classId => $cls)
                    <button type="button" class="chip" data-filter="{{ $classId }}" style="--c: {{ $cls['hex'] }}">
                        <span class="dot"></span>
                        {{ $cls['name'] }}
                        <small>@mataUang($cls['total'])</small>
                    </button>
                @endforeach
            </div>
            <div class="search">
                <i class="fa fa-search"></i>
                <input type="search" id="assetSearch" placeholder="Search name, vendor, code…" autocomplete="off">
            </div>
        </div>

        <div class="row" id="assetGrid">
            @forelse ($assets as $asset)
                @php
                    $hex = $hexOf($asset->asset->asset_web_color);
                    $share = $grandTotal > 0 ? round(($asset->sub_value / $grandTotal) * 100, 2) : 0;
                @endphp
                <div class="col-xl-3 col-lg-4 col-sm-6 mb-4 asset-item" data-class="{{ $asset->sub_id_asset }}"
                    data-search="{{ strtolower($asset->sub_name . ' ' . $asset->sub_vendor . ' ' . $asset->code . ' ' . $asset->asset->asset_name) }}">
                    <div class="a-card" style="--c: {{ $hex }}; --c-soft: {{ $hex }}1f;">
                        <div class="a-head">
                            <div class="a-icon"><i class="{{ $asset->asset->asset_web_icon }}"></i></div>
                            <div class="a-title">
                                <div class="a-name" title="{{ $asset->sub_name }}">{{ $asset->sub_name }}</div>
                                <div class="a-class">{{ $asset->asset->asset_name }}</div>
                            </div>
                            <div class="a-actions">
                                <button type="button" class="icon-btn" title="Edit" aria-label="Edit {{ $asset->sub_name }}"
                                    onclick="initEdit({{ $asset->sub_id }})"><i class="fas fa-pen"></i></button>
                                <button type="button" class="icon-btn danger" title="Hapus"
                                    aria-label="Hapus {{ $asset->sub_name }}"
                                    onclick="initDelete({{ $asset->sub_id }})"><i class="fas fa-trash"></i></button>
                            </div>
                        </div>

                        <div class="d-amount a-value">@mataUang($asset->sub_value)</div>
                        @if ($asset->val > 0)
                            <div class="a-qty">{{ rtrim(rtrim(number_format($asset->val, 8, ',', '.'), '0'), ',') }} {{ $asset->code ?: 'unit' }}</div>
                        @endif

                        <div class="a-share">
                            <div class="a-bar"><span style="width: {{ $share }}%"></span></div>
                            <small>{{ $share }}%</small>
                        </div>

                        <div class="a-foot">
                            <span class="vendor"><i class="fa fa-map-marker-alt mr-1" style="color: {{ $hex }}"></i>{{ $asset->sub_vendor }}</span>
                            @if ($asset->code)
                                <span class="code-tag">{{ $asset->code }}</span>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="empty">
                        <div><i class="fas fa-piggy-bank"></i></div>
                        <div class="font-weight-bold mb-1" style="color: var(--ink)">No assets yet</div>
                        Add your first account to start tracking your holdings.
                    </div>
                </div>
            @endforelse

            <div class="col-12 d-none" id="noMatch">
                <div class="empty">
                    <div><i class="fas fa-search"></i></div>
                    No assets match your filter.
                </div>
            </div>
        </div>

    </div>

    <!-- Convert Modal -->
    <div class="modal fade asset-modal" id="modal2" tabindex="-1" role="dialog" aria-labelledby="modal-fadein"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <form id="form2" method="POST" action="{{ route('user.asset.convert') }}" class="w-100">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-white"><i class="fa fa-exchange-alt mr-1"></i> Convert Asset</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="sub1">From</label>
                            <select class="form-control" name="sub1" id="sub1" required>
                                <option value="">-- Pilih --</option>
                                @foreach ($assets as $asset)
                                    <option value="{{ $asset->sub_id }}">
                                        {{ $asset->sub_name }}
                                        ({{ $asset->asset->asset_name }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="conv-arrow"><i class="fas fa-arrow-down"></i></div>
                        <div class="form-group">
                            <label for="sub2">To</label>
                            <select class="form-control" name="sub2" id="sub2" required>
                                <option value="">-- Pilih --</option>
                                @foreach ($assets as $asset)
                                    <option value="{{ $asset->sub_id }}">
                                        {{ $asset->sub_name }}
                                        ({{ $asset->asset->asset_name }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="value">Value (Rp)</label>
                            <input type="number" class="form-control" name="value" id="value" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-grad"><i class="fas fa-check mr-1"></i> Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- END Convert Modal -->

    <!-- Add / Edit Modal -->
    <div class="modal fade asset-modal" id="modal1" tabindex="-1" role="dialog" aria-labelledby="modal-fadein"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <form id="form1" method="POST" action="#" class="w-100">
                @csrf
                <input type="hidden" name="sub_id" id="update_id1">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-white" id="modal1_head">
                            <i class="fa fa-plus text-white"></i> Add Asset
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-row">
                            <div class="form-group col-sm-6">
                                <label for="sub_id_asset">Tipe <span class="text-danger">*</span></label>
                                <select class="form-control" name="sub_id_asset" id="sub_id_asset" required>
                                    <option value="">-- Select --</option>
                                    @foreach ($classAssets as $cass)
                                        <option value="{{ $cass->asset_id }}">
                                            💎{{ $cass->asset_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="sub_name">Name <span class="text-danger">*</span></label>
                                <input type="text" name="sub_name" id="sub_name" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="sub_vendor">Vendor <span class="text-danger">*</span></label>
                            <input type="text" name="sub_vendor" id="sub_vendor" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="sub_value">Fiat Value (Rp) <span class="text-danger">*</span></label>
                            <input type="number" step="any" name="sub_value" id="sub_value" class="form-control"
                                required>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-sm-6">
                                <label for="val">Value</label>
                                <input type="number" step="any" name="val" id="val" class="form-control" value="0">
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="code">Code</label>
                                <input type="text" name="code" id="code" class="form-control">
                            </div>
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

    <form id="form_delete1" method="POST" action="{{ route('auth.asset.delete') }}">
        @csrf
        @method('delete')
        <input type="hidden" name="sub_id" id="del_id1">
    </form>

@endsection
@section('script')
    <script type="text/javascript">
        $('#mn-asset').addClass('active');

        function initConv() {
            $('#modal2').modal('show');
        }

        function initAdd() {
            $('#form1').trigger('reset');
            $('#form1').attr('action', "{{ route('auth.asset.insert') }}");
            $('#modal1_head').html(`<i class="fa fa-plus text-white"></i> Add Asset`);
            $('#modal1').modal('show');
        }

        async function initEdit(id) {
            $('#form1').trigger('reset');
            $('#form1').attr('action', "{{ route('auth.asset.update') }}");
            $('#modal1_head').html(`<i class="fa fa-edit text-white"></i> Update Asset`);
            let res = await sendAjax("{{ route('auth.asset.get') }}/" + id, {}, 'GET');
            if (res.status) {
                isiData(res.data);
            }
            $('#modal1').modal('show');
        }

        function isiData(data) {
            $('#update_id1').val(data.sub_id);
            $('#sub_id_asset').val(data.sub_id_asset);
            $('#sub_name').val(data.sub_name);
            $('#sub_vendor').val(data.sub_vendor);
            $('#sub_value').val(data.sub_value);
            $('#val').val(data.val);
            $('#code').val(data.code);
        }

        function initDelete(id) {
            $('#del_id1').val(id);
            if (confirm('Delete Asset?')) {
                $('#form_delete1').trigger('submit');
            }
        }

        // Client-side filter by asset class chip + search text
        let activeClass = 'all';

        function applyFilter() {
            const q = ($('#assetSearch').val() || '').toLowerCase().trim();
            let shown = 0;
            $('.asset-item').each(function() {
                const $el = $(this);
                const okClass = activeClass === 'all' || String($el.data('class')) === activeClass;
                const okText = !q || String($el.data('search')).includes(q);
                $el.toggleClass('d-none', !(okClass && okText));
                if (okClass && okText) shown++;
            });
            $('#noMatch').toggleClass('d-none', shown > 0 || $('.asset-item').length === 0);
        }

        $('.chip').on('click', function() {
            $('.chip').removeClass('active');
            $(this).addClass('active');
            activeClass = String($(this).data('filter'));
            applyFilter();
        });

        $('#assetSearch').on('input', applyFilter);
    </script>
@endsection
