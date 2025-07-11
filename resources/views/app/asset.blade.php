@extends('_layouts.app')
@section('css')
    <style>
        .bn632-hover {
            width: 200px;
            font-size: 16px;
            font-weight: 600;
            color: #fff;
            cursor: pointer;
            margin: 10px 20px;
            height: 55px;
            text-align: center;
            border: none;
            background-size: 300% 100%;
            border-radius: 50px;
            moz-transition: all .4s ease-in-out;
            -o-transition: all .4s ease-in-out;
            -webkit-transition: all .4s ease-in-out;
            transition: all .4s ease-in-out;
        }

        .bn632-hover:hover {
            background-position: 100% 0;
            moz-transition: all .4s ease-in-out;
            -o-transition: all .4s ease-in-out;
            -webkit-transition: all .4s ease-in-out;
            transition: all .4s ease-in-out;
        }

        .bn632-hover:focus {
            outline: none;
        }

        .bn632-hover.bn21 {
            background-image: linear-gradient(to right,
                    #fc6076,
                    #ff9a44,
                    #ef9d43,
                    #e75516);
            box-shadow: 0 4px 15px 0 rgba(252, 104, 110, 0.75);
        }
    </style>
@endsection
@section('pageName', 'Asset Data')
@section('body')
    <div class="row">
        <div class="col-md-12 text-center">
            <button type="button" onclick="initAdd()" class="btn btn-info btn-icon-split btn-sm mb-3">
                <span class="icon text-white-50">
                    <i class="fa fa-plus"></i>
                </span>
                <span class="text">Add</span>
            </button>

            <button type="button" onclick="initConv()" class="btn btn-primary btn-icon-split btn-sm mb-3">
                <span class="icon text-white-50">
                    <i class="fa fa-undo"></i>
                </span>
                <span class="text">Convert</span>
            </button>
        </div>
        <div class="col-xl-12 mb-4 text-center">
            <a href="{{ route('auth.asset.update-real-val') }}">
                <button class="bn632-hover bn21">💸 Update Real Value</button>
            </a>
        </div>
        @foreach ($assets as $asset)
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div
                                    class="text-xs font-weight-bold {{ $asset->asset->asset_web_color }} text-uppercase mb-1">
                                    {{ $asset->sub_name }}
                                    <br> ({{ $asset->asset->asset_name }})
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    @mataUang($asset->sub_value)
                                </div>
                                <span>
                                    <i class="fa fa-map-marker {{ $asset->asset->asset_web_color }}"></i>
                                    {{ $asset->sub_vendor }}
                                    @if (@$asset->code)
                                        <small>({{ $asset->code }})</small>
                                    @endif
                                </span>
                            </div>
                            <div class="col-auto">
                                <div class="nav-item dropdown no-arrow">
                                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i
                                            class="{{ $asset->asset->asset_web_icon }}
                                            fa-2x {{ $asset->asset->asset_web_color }}"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right shadow" aria-labelledby="userDropdown">
                                        <a class="dropdown-item" onclick="initEdit({{ $asset->sub_id }})">
                                            <i class="fas fa-edit fa-sm fa-fw mr-2 text-gray-400"></i>
                                            Edit
                                        </a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" onclick="initDelete({{ $asset->sub_id }})">
                                            <i class="fas fa-trash fa-sm fa-fw mr-2 text-danger"></i>
                                            <span class="text-danger">Hapus</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Fade In Modal -->
    <div class="modal fade" id="modal2" tabindex="-1" role="dialog" aria-labelledby="modal-fadein" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form id="form2" method="POST" action="{{ route('user.asset.convert') }}">
                @csrf
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h5 class="modal-title text-white"><i class="fa fa-undo text-white"></i> Convert Asset</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">From </label>
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
                        <div class="form-group">
                            <label for="">To <i class="fas fa-arrow-right text-primary"></i></label>
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
                            <label for="">Value</label>
                            <input type="number" class="form-control" name="value" id="value" required>
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

    <!-- Fade In Modal -->
    <div class="modal fade" id="modal1" tabindex="-1" role="dialog" aria-labelledby="modal-fadein" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form id="form1" method="POST" action="#">
                @csrf
                <input type="hidden" name="sub_id" id="update_id1">
                <div class="modal-content">
                    <div class="modal-header bg-info">
                        <h5 class="modal-title text-white" id="modal1_head">
                            <i class="fa fa-plus text-white"></i> Add Asset
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Tipe <span class="text-danger">*</span></label>
                            <select class="form-control" name="sub_id_asset" id="sub_id_asset" required>
                                <option value="">-- Select --</option>
                                @foreach ($classAssets as $cass)
                                    <option value="{{ $cass->asset_id }}">
                                        💎{{ $cass->asset_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Name <span class="text-danger">*</span></label>
                            <input type="text" name="sub_name" id="sub_name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="">Vendor <span class="text-danger">*</span></label>
                            <input type="text" name="sub_vendor" id="sub_vendor" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="">Fiat Value (Rp) <span class="text-danger">*</span></label>
                            <input type="number" step="any" name="sub_value" id="sub_value" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="">Value</label>
                            <input type="number" step="any" name="val" id="val" class="form-control" value="0">
                        </div>
                        <div class="form-group">
                            <label for="">Code</label>
                            <input type="text" name="code" id="code" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-info"><i class="fas fa-save"></i> Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- END Fade In Modal -->

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
    </script>
@endsection
