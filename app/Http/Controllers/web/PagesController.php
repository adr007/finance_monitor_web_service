<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Asset, Logs, SubAsset, Tag, Transaction, User};
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

        $assets = Asset::orderBy('asset_id')->get();
        $xyz = [];
        foreach ($assets as $ast) {
            $temp['asset_name'] = $ast->asset_name;
            $temp['asset_icon'] = $ast->asset_web_icon;
            $temp['asset_color'] = $ast->asset_web_color;
            $temp['asset_value'] = SubAsset::where('sub_id_asset', $ast->asset_id)
                ->where('sub_id_user', $user->user_id)->sum('sub_value');
            $asset_persen = 0;
            if ($temp['asset_value'] > 0) {
                $asset_persen = round(($temp['asset_value'] / $data['totalAssets']) * 100, 2);
            }
            $temp['asset_persen'] = $asset_persen;
            array_push($xyz, $temp);
        }

        usort($xyz, function ($a, $b) {
            return $b['asset_persen'] - $a['asset_persen'];
        });

        $data['assetSpread'] = $xyz;

        $data['btc'] = SubAsset::where('sub_id_user', $user->user_id)->where('sub_name', 'BTC')->sum('val');
        $data['btc_fiat'] = SubAsset::where('sub_id_user', $user->user_id)->where('sub_name', 'BTC')->sum('sub_value');

        return view('app.dashboard', $data);
    }

    public function report()
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

    public function transaction()
    {
        $user = Auth::user();
        $data['assets'] = SubAsset::where('sub_id_user', $user->user_id)->with('asset')
            ->orderBy('sub_id_asset', 'ASC')->orderBy('sub_value', 'DESC')->get();
        $data['tags'] = Tag::orderBy('tag_is_belanja', 'DESC')->orderBy('tag_kode', 'ASC')->get();
        return view('app.trans', $data);
    }

    public function asset()
    {
        $user = Auth::user();
        $data['classAssets'] = Asset::orderBy('asset_id', 'ASC')->get();
        $data['assets'] = SubAsset::where('sub_id_user', $user->user_id)->with('asset')
            ->orderBy('sub_id_asset', 'ASC')->orderBy('sub_value', 'DESC')->get();
        return view('app.asset', $data);
    }

    public function logs()
    {
        $data['logs'] = Logs::where('user_id', Auth::user()->user_id)->orderBy('date', 'DESC')
            ->orderBy('tr_value', 'DESC')->get();
        return view('app.logs', $data);
    }
}
