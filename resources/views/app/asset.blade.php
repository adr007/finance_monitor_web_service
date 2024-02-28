@extends('_layouts.app')
@section('css')
@endsection
@section('pageName', 'Asset Data')
@section('body')
    <div class="row">
        @foreach ($assets as $asset)
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                    {{ $asset->sub_name }}
                                    <br> ({{ $asset->asset->asset_name }})
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    @mataUang($asset->sub_value)
                                </div>
                                <span>
                                    <i class="fa fa-map-marker text-info"></i>
                                    {{ $asset->sub_vendor }}
                                </span>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-cube fa-2x text-info"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
@section('script')
    <script type="text/javascript">
        $('#mn-asset').addClass('active');
    </script>
@endsection
