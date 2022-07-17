<form action="{{ route(Route::currentRouteName()) }}" method="GET">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <select class="form-control" name="bulan" id="pilih_bulan" required>
                    <option value="1">January</option>
                    <option value="2">February</option>
                    <option value="3">March</option>
                    <option value="4">April</option>
                    <option value="5">May</option>
                    <option value="6">June</option>
                    <option value="7">July</option>
                    <option value="8">August</option>
                    <option value="9">September</option>
                    <option value="10">October</option>
                    <option value="11">November</option>
                    <option value="12">December</option>
                </select>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <select class="form-control" name="tahun" id="pilih_tahun" required>
                    @for ($i = date('Y'); $i >= 2020; $i--)
                        <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
                </select>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <button style="padding: 10px 0;" type="submit" class="btn btn-primary btn-block"><i
                        class="fa fa-tasks"></i> Get Report</button>
            </div>
        </div>
    </div>
    <form action="{{ route('user.dashboard') }}" method="GET">
