@extends('_layouts.app')
@section('css')
    <style>
        .table tbody>tr>td {
            padding: 5px 4px;
        }

        .body1 {
            height: 500px;
            overflow: scroll;
        }
    </style>
@endsection
@section('pageName', 'Dashboard ' . date('F', mktime(0, 0, 0, $pilih_bulan, 1)) . ' ' . $pilih_tahun)
@section('body')

    <div class="row mb-2">
        <div class="col-md-4">
            @include('_components.form_bulan')
        </div>
        <div class="col-lg-4 mb-2">
            <div class="card bg-success text-white shadow">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            Total Assets
                        </div>
                        <div class="col-md-12 text-right">
                            <h4 style="font-size: 18pt"><i class="far fa-gem"></i> @mataUang($totalAssets)</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @php
            $persen = 0;
            if ($thisMonth['income'] >= 1) {
                $persen = ($monthSaved / $thisMonth['income']) * 100;
            }

            if ($monthSaved <= 0) {
                $color = '#ffecec';
                $warna = 'danger';
                $text2 = 'Wasteful';
            } else {
                $color = '#ecfffd';
                $warna = 'info';
                $text2 = 'You Save';
            }
        @endphp
        <div class="col-md-4">
            <div class="card border-left-{{ $warna }} shadow py-2" style="background-color: {{ $color }};">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col-md-12 col-xs-12">
                            <div class="text-xs font-weight-bold text-{{ $warna }} text-uppercase mb-1">This
                                Month {{ $text2 }}</div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-md-5">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                        {{ round($persen, 2) }} %
                                    </div>
                                </div>

                                <div class="col-md-7 text-right">
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">@mataUang($monthSaved)</div>
                                </div>
                                <div class="col-md-12">
                                    <div class="progress progress-sm mr-2">
                                        <div class="progress-bar bg-{{ $warna }}" role="progressbar"
                                            style="width: {{ round($persen, 2) }}%" aria-valuenow="50" aria-valuemin="0"
                                            aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="row">

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1"><i
                                    class="fa fa-arrow-up"></i> Today Income</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">@mataUang($today['income'])</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1"><i
                                    class="fa fa-arrow-down"></i> Today Spending</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">@mataUang($today['spending'])</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"><i
                                    class="fa fa-arrow-up"></i> This Month Income</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">@mataUang($thisMonth['income'])</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1"><i
                                    class="fa fa-arrow-down"></i> This Month Spending</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">@mataUang($thisMonth['spending'])</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="row">
        <div class="col-md-6">
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Income Stream</h6>
                </div>
                <div class="card-body body1">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover" width="100%" cellspacing="0"
                            style="font-size: 10pt">
                            <thead class="bg-success text-white">
                                <tr>
                                    <th width="10">#</th>
                                    <th>Desc</th>
                                    <th class="text-center">Date</th>
                                    <th class="text-right">Amount (Rp)</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($transUp as $tu)
                                    <tr>
                                        <td>{{ $loop->iteration }}.</td>
                                        <td>{{ $tu->trans_information }} (<span
                                                class="text-success">{{ $tu->subAsset->sub_name }}</span>)</td>
                                        <td class="text-center">{{ $tu->trans_date }}</td>
                                        <td class="text-right">@mataUang2($tu->trans_value)</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center">
                                            <h3>Empty</h3>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Expenses</h6>
                </div>
                <div class="card-body body1">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover" width="100%" cellspacing="0"
                            style="font-size: 10pt">
                            <thead class="bg-danger text-white">
                                <tr>
                                    <th width="10">#</th>
                                    <th>Desc</th>
                                    <th class="text-center">Date</th>
                                    <th class="text-right">Amount (Rp)</th>
                                </tr>
                            </thead>
                            <tbody style="height: 500px; overflow: auto">
                                @forelse ($transDown as $td)
                                    <tr>
                                        <td>{{ $loop->iteration }}.</td>
                                        <td>{{ $td->trans_information }}</td>
                                        <td class="text-center">{{ $td->trans_date }}</td>
                                        <td class="text-right">@mataUang2($td->trans_value)</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center">
                                            <h3>Empty</h3>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="row">
        <div class="col-12">
            <h4>Assets Spread</h4>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-body" style="overflow: auto">
                    <table class="table table-hover" style="min-width: 600px;">
                        <tbody>
                            @foreach ($assetSpread as $spread)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td class="text-center {{ $spread['asset_color'] }}">
                                        <i class="{{ $spread['asset_icon'] }}"></i>
                                        {{ $spread['asset_name'] }}
                                    </td>
                                    <td class="text-center">
                                        <strong>
                                            @mataUang2($spread['asset_value'])
                                        </strong>
                                    </td>
                                    <td class="text-center">
                                        <strong>
                                            {{ $spread['asset_persen'] }} %
                                        </strong>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('script')
    <script type="text/javascript">
        $('#mn1').addClass('active');

        const d = new Date();
        $('#pilih_bulan').val('{{ $pilih_bulan }}');
        $('#pilih_tahun').val('{{ $pilih_tahun }}');
    </script>
@endsection
