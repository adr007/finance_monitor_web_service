@extends('_layouts.app')
@section('css')
    <link href="{{ asset('komponen/app') }}/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
@endsection
@section('pageName', 'Logs')
@section('body')
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-fw fa-cog"></i> Log Data</h6>
                </div>
                <div class="card-body">
                    <div class="col-md-12" style="overflow: auto;">
                        <table id="tbl1" class="table table-striped table-hover" style="width: 100%; font-size: 11pt">
                            <thead>
                                <tr>
                                    <th width="10">#</th>
                                    <th>Asset</th>
                                    <th>Type</th>
                                    <th>Date</th>
                                    <th>Value</th>
                                    <th>From</th>
                                    <th>To</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($logs as $log)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $log->asset_name }}</td>
                                        <td>{{ $log->desc }}</td>
                                        <td>{{ $log->date }}</td>
                                        <td>{{ $log->tr_value }}</td>
                                        <td>{{ $log->from_value }}</td>
                                        <td>{{ $log->to_value }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
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
                columnDefs: [{
                    targets: [4,5,6],
                    type: 'num-fmt',
                    render: $.fn.dataTable.render.number('.', ',', 0, ''),
                }],
            });
        }
    </script>
@endsection
