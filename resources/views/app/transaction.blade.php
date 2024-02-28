@extends('_layouts.app')
@section('css')
    <!-- Custom styles for this page -->
    <link href="{{ asset('komponen/app') }}/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
@endsection
@section('pageName', 'Transaction Report')
@section('body')
    <div class="row">
        <div class="col-md-4">
            @include('_components.form_bulan')
        </div>
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1"><i
                                    class="fa fa-arrow-up"></i>
                                This Month Income</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">@mataUang($thisMonth['income'])</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1"><i
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
        <div class="col-md-12">
            <!-- Bar Chart -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-balance-scale"></i> Expenses Category
                    </h6>
                </div>
                <div class="card-body">
                    <div class="chart-bar">
                        <canvas id="myBarChart"></canvas>
                    </div>

                </div>
            </div>
        </div>

        <div class="col-md-12">
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-danger">Expenses Detail</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0"
                            style="font-size: 11pt">
                            <thead>
                                <tr>
                                    <th width="10">#</th>
                                    <th class="text-primary">Tag</th>
                                    <th>Desc</th>
                                    <th width="90">Date</th>
                                    <th class="text-right">Amount (Rp)</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($transDown as $td)
                                    <tr>
                                        <td>{{ $loop->iteration }}.</td>
                                        <td class="text-primary">{{ $td->tag->tag_name }}</td>
                                        <td>{{ $td->trans_information }}</td>
                                        <td class="text-center">{{ $td->trans_date }}</td>
                                        <td class="text-right">@mataUang3($td->trans_value)</td>
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

        $(document).ready(function() {
            $('#dataTable').DataTable({
                columnDefs: [{
                    targets: 4,
                    type: 'num-fmt'
                }]
            });
        });

        Chart.defaults.global.defaultFontFamily = 'Nunito',
            '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
        Chart
            .defaults.global.defaultFontColor = '#858796';

        function number_format(number, decimals, dec_point, thousands_sep) {
            // *     example: number_format(1234.56, 2, ',', ' ');
            // *     return: '1 234,56'
            number = (number + '').replace(',', '').replace(' ', '');
            var n = !isFinite(+number) ? 0 : +number,
                prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
                sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
                dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
                s = '',
                toFixedFix = function(n, prec) {
                    var k = Math.pow(10, prec);
                    return '' + Math.round(n * k) / k;
                };
            // Fix for IE parseFloat(0.55).toFixed(0) = 0;
            s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
            if (s[0].length > 3) {
                s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
            }
            if ((s[1] || '').length < prec) {
                s[1] = s[1] || '';
                s[1] += new Array(prec - s[1].length + 1).join('0');
            }
            return s.join(dec);
        }

        // Bar Chart Example
        var ctx = document.getElementById("myBarChart");
        var myBarChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: @json($tags),
                datasets: [{
                    label: "Spending",
                    backgroundColor: "#4e73df",
                    hoverBackgroundColor: "#2e59d9",
                    borderColor: "#4e73df",
                    data: @json($tags_value),
                }],
            },
            options: {
                maintainAspectRatio: false,
                layout: {
                    padding: {
                        left: 10,
                        right: 10,
                        top: 25,
                        bottom: 0
                    }
                },
                scales: {
                    xAxes: [{
                        time: {
                            unit: 'tags'
                        },
                        gridLines: {
                            display: true,
                            drawBorder: false
                        },
                        ticks: {
                            maxTicksLimit: 20
                        },
                        maxBarThickness: 25,
                    }],
                    yAxes: [{
                        ticks: {
                            min: 0,
                            max: {{ max($tags_value) }},
                            maxTicksLimit: 2,
                            padding: 10,
                            // Include a dollar sign in the ticks
                            callback: function(value, index, values) {
                                return '' + rupiah(value);
                            }
                        },
                        gridLines: {
                            color: "rgb(234, 236, 244)",
                            zeroLineColor: "rgb(234, 236, 244)",
                            drawBorder: false,
                            borderDash: [2],
                            zeroLineBorderDash: [2]
                        }
                    }],
                },
                legend: {
                    display: true
                },
                tooltips: {
                    titleMarginBottom: 10,
                    titleFontColor: '#6e707e',
                    titleFontSize: 14,
                    backgroundColor: "rgb(255,255,255)",
                    bodyFontColor: "#858796",
                    borderColor: '#dddfeb',
                    borderWidth: 1,
                    xPadding: 15,
                    yPadding: 15,
                    displayColors: false,
                    caretPadding: 10,
                    callbacks: {
                        label: function(tooltipItem, chart) {
                            var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                            return datasetLabel + ': ' + rupiah(tooltipItem.yLabel);
                        }
                    }
                },
            }
        });
    </script>
@endsection
