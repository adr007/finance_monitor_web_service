@extends('_layouts.app')
@section('css')
    <link href="{{ asset('komponen/app') }}/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
@endsection
@section('pageName', 'Transaction Data')
@section('body')
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Transaction Data</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <button type="button" onclick="initAdd()" class="btn btn-success btn-icon-split btn-sm">
                                <span class="icon text-white-50">
                                    <i class="fas fa-plus"></i>
                                </span>
                                <span class="text">Add Transaction</span>
                            </button>
                        </div>
                        <div class="col-md-12">
                            <table id="tbl1" class="table table-striped table-hover" style="width: 100%">
                                <thead>
                                    <tr>
                                        <th width="10">#</th>
                                        <th>Type</th>
                                        <th>Tag</th>
                                        <th>Desc</th>
                                        <th width="90">Date</th>
                                        <th class="text-right">Amount (Rp)</th>
                                        <th class="text-center">Menu</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Fade In Modal -->
    <div class="modal fade" id="modal1" tabindex="-1" role="dialog" aria-labelledby="modal-fadein" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form id="form1" method="POST" action="{{ route('user.transaction.insert') }}">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Transaction</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Asset</label>
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
                        <div class="form-group">
                            <label for="">Tag</label>
                            <select class="form-control" name="tag_id" id="tag_id" required>
                                <option value="">-- Pilih --</option>
                                @foreach ($tags as $tag)
                                    <option value="{{ $tag->tag_id }}">
                                        {{ $tag->tag_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Value</label>
                            <input type="number" class="form-control" name="trans_value" id="trans_value" required>
                        </div>
                        <div class="form-group">
                            <label for="">Description</label>
                            <input type="text" class="form-control" name="trans_information" id="trans_information"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="">Date</label>
                            <input type="date" class="form-control" value="{{ date('Y-m-d') }}" name="trans_date"
                                id="trans_date" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- END Fade In Modal -->

@endsection
@section('script')
    <script src="{{ asset('komponen/app') }}/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ asset('komponen/app') }}/vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script type="text/javascript">
        $('#mn-trans').addClass('active');

        $(document).ready(function() {
            initTable();
        });

        let tbl1;

        function initTable() {
            tbl1 = $('#tbl1').DataTable({
                columnDefs: [{
                    targets: 5,
                    type: 'num-fmt'
                }],
                ordering: true,
                responsive: true,
                serverSide: false,
                scrollX: true,
                ajax: "{{ route('data.transaction.user') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        searchable: false
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'tag.tag_name',
                        name: 'tag.tag_name'
                    },
                    {
                        data: 'trans_information',
                        name: 'trans_information'
                    },
                    {
                        data: 'trans_date',
                        name: 'trans_date'
                    },
                    {
                        data: 'trans_value',
                        name: 'trans_value',
                        render: $.fn.dataTable.render.number('.', ',', 0, ''),
                        className: 'text-right'
                    },
                    {
                        data: 'menu',
                        name: 'menu',
                        searchable: false,
                        className: 'text-center',
                        orderable: false
                    },
                ],
            });
        }

        function initAdd() {
            $('#form1').trigger('reset');
            $('#modal1').modal('show');
        }

        $('#form1').on('submit', async function(e) {
            e.preventDefault();
            let link = $(this).attr('action');
            let dataKirim = $(this).serialize();
            let res = await sendAjax(link, dataKirim);
            if (res.status) {
                tbl1.ajax.reload();
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
                    tbl1.ajax.reload();
                    alert(res.msg)
                } else {
                    console.log(res);
                    alert(res.msg);
                }
            }
        }
    </script>
@endsection
