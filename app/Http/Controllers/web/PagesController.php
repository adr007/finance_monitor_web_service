<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Tag, Transaction, User};
use Illuminate\Support\Facades\Auth;
// use Utils;

class PagesController extends Controller
{
    public function dashboard()
    {
        $user = User::find(Auth::user()->user_id);

        if (isset($_GET['bulan'])) {
            $bulan = $_GET['bulan'];
            $tahun = $_GET['tahun'];
        } else {
            $bulan = date('m');
            $tahun = date('Y');
        }

        $data['pilih_bulan'] = $bulan + 0;
        $data['pilih_tahun'] = $tahun;

        $data['today']['income'] = Transaction::where('trans_id_user', $user->user_id)
            ->whereDate('trans_date', date('Y-m-d'))
            ->where('trans_status', "UP")->sum('trans_value') ?? 0;

        $data['today']['spending'] = Transaction::where('trans_id_user', $user->user_id)
            ->whereDate('trans_date', date('Y-m-d'))
            ->where('trans_status', "DOWN")->sum('trans_value') ?? 0;

        $data['thisMonth']['income'] = Transaction::where('trans_id_user', $user->user_id)
            ->whereMonth('trans_date', $bulan)
            ->whereYear('trans_date', $tahun)
            ->where('trans_status', "UP")->sum('trans_value') ?? 0;

        $data['thisMonth']['spending'] = Transaction::where('trans_id_user', $user->user_id)
            ->whereMonth('trans_date', $bulan)
            ->whereYear('trans_date', $tahun)
            ->where('trans_status', "DOWN")->sum('trans_value') ?? 0;

        $data['transUp'] = Transaction::where('trans_id_user', $user->user_id)
            ->whereMonth('trans_date', $bulan)
            ->whereYear('trans_date', $tahun)
            ->where('trans_status', "UP")->with('subAsset')->orderBy('trans_date', 'DESC')->get();

        $data['transDown'] = Transaction::where('trans_id_user', $user->user_id)
            ->whereMonth('trans_date', $bulan)
            ->whereYear('trans_date', $tahun)
            ->where('trans_status', "DOWN")->with('subAsset')->orderBy('trans_date', 'DESC')->get();

        $data['monthSaved'] = $data['thisMonth']['income'] - $data['thisMonth']['spending'];

        $data['totalAssets'] = $user->subAssets()->sum('sub_value');

        return view('app.dashboard', $data);
    }

    public function transaction()
    {
        $user = User::find(Auth::user()->user_id);

        if (isset($_GET['bulan'])) {
            $bulan = $_GET['bulan'];
            $tahun = $_GET['tahun'];
        } else {
            $bulan = date('m');
            $tahun = date('Y');
        }

        $data['pilih_bulan'] = $bulan + 0;
        $data['pilih_tahun'] = $tahun;

        $data['thisMonth']['income'] = Transaction::where('trans_id_user', $user->user_id)
            ->whereMonth('trans_date', $bulan)
            ->whereYear('trans_date', $tahun)
            ->where('trans_status', "UP")->sum('trans_value') ?? 0;

        $data['thisMonth']['spending'] = Transaction::where('trans_id_user', $user->user_id)
            ->whereMonth('trans_date', $bulan)
            ->whereYear('trans_date', $tahun)
            ->where('trans_status', "DOWN")->sum('trans_value') ?? 0;

        $tags = Tag::where('tag_is_belanja', 1)->orderBy('tag_name', 'ASC')->get();
        $data['tags'] = $tags->pluck('tag_name')->toArray();
        $data['tags_value'] = [];

        foreach ($tags as $tag) {
            $sum = Transaction::where('trans_id_user', $user->user_id)
                ->whereMonth('trans_date', $bulan)
                ->whereYear('trans_date', $tahun)
                ->where('trans_tag', $tag->tag_kode)
                ->where('trans_status', "DOWN")->sum('trans_value');
            array_push($data['tags_value'], $sum);
           
        }

        $data['transDown'] = Transaction::where('trans_id_user', $user->user_id)
            ->whereMonth('trans_date', $bulan)
            ->whereYear('trans_date', $tahun)
            ->where('trans_status', "DOWN")->with('tag')->orderBy('trans_date', 'DESC')->get();

        return view('app.transaction', $data);
    }
}
