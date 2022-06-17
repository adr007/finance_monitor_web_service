<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Transaction};
use Illuminate\Support\Facades\Auth;
// use Utils;

class PagesController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();

        if (isset($_GET['bulan'])) {
            $bulan = $_GET['bulan'];
            $tahun = $_GET['tahun'];
        } else {
            $bulan = date('m');
            $tahun = date('Y');
        }

        $data['pilih_bulan'] = $bulan+0;
        $data['pilih_tahun'] = $tahun;

        $data['today']['income'] = Transaction::where('trans_id_user', $user->user_id)
                                    ->whereDate('trans_date', date('Y-m-d'))
                                    ->where('trans_status', "UP")->sum('trans_value');

        $data['today']['spending'] = Transaction::where('trans_id_user', $user->user_id)
                                    ->whereDate('trans_date', date('Y-m-d'))
                                    ->where('trans_status', "DOWN")->sum('trans_value');

        $data['thisMonth']['income'] = Transaction::where('trans_id_user', $user->user_id)
                                    ->whereMonth('trans_date', $bulan)
                                    ->whereYear('trans_date', $tahun)
                                    ->where('trans_status', "UP")->sum('trans_value');

        $data['thisMonth']['spending'] = Transaction::where('trans_id_user', $user->user_id)
                                    ->whereMonth('trans_date', $bulan)
                                    ->whereYear('trans_date', $tahun)
                                    ->where('trans_status', "DOWN")->sum('trans_value');

        //  = Utils::rupiah($x1);
        //  = Utils::rupiah($x2);
        //  = Utils::rupiah($x3);
        //  = Utils::rupiah($x4);

        $data['transUp'] = Transaction::where('trans_id_user', $user->user_id)
                                    ->whereMonth('trans_date', $bulan)
                                    ->whereYear('trans_date', $tahun)
                                    ->where('trans_status', "UP")->orderBy('trans_date', 'DESC')->get();

        $data['transDown'] = Transaction::where('trans_id_user', $user->user_id)
                                    ->whereMonth('trans_date', $bulan)
                                    ->whereYear('trans_date', $tahun)       
                                    ->where('trans_status', "DOWN")->orderBy('trans_date', 'DESC')->get();

        $data['monthSaved'] = $data['thisMonth']['income'] - $data['thisMonth']['spending'];

        return view('app.dashboard', $data);
    }
}
