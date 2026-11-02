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

    public function annualReport()
    {
        $user = Auth::user();
        $tahun = $_GET['tahun'] ?? date('Y');
        $isAll = $tahun === 'all';
        $tahun = $isAll ? $tahun : (int) $tahun;

        $firstDate = Transaction::where('trans_id_user', $user->user_id)->min('trans_date');
        $data['firstYear'] = $firstDate ? (int) date('Y', strtotime($firstDate)) : (int) date('Y');
        $data['pilih_tahun'] = $isAll ? 'all' : (int) $tahun;
        $data['isAll'] = $isAll;

        $base = function () use ($user, $isAll, $tahun) {
            $q = Transaction::where('trans_id_user', $user->user_id);
            if (!$isAll) {
                $q->whereYear('trans_date', $tahun);
            }
            return $q;
        };

        // Income & spending per period: months of the selected year, or every year for all time
        $periodExpr = $isAll ? 'YEAR(trans_date)' : 'MONTH(trans_date)';
        $rows = $base()
            ->selectRaw("$periodExpr as period, trans_status, SUM(trans_value) as total, COUNT(*) as cnt")
            ->groupBy('period', 'trans_status')
            ->get();

        if ($isAll) {
            $lastYear = max($data['firstYear'], (int) date('Y'));
            $periodKeys = range($data['firstYear'], $lastYear);
        } else {
            $periodKeys = range(1, 12);
        }

        $periods = [];
        foreach ($periodKeys as $key) {
            $periods[$key] = [
                'key' => $key,
                'label' => $isAll ? (string) $key : date('M', mktime(0, 0, 0, $key, 1)),
                'income' => 0,
                'spending' => 0,
                'count' => 0,
            ];
        }
        foreach ($rows as $row) {
            if (!isset($periods[$row->period])) {
                continue;
            }
            $field = $row->trans_status == 'UP' ? 'income' : 'spending';
            $periods[$row->period][$field] += (float) $row->total;
            $periods[$row->period]['count'] += (int) $row->cnt;
        }
        $data['periods'] = array_values($periods);

        $data['income'] = array_sum(array_column($data['periods'], 'income'));
        $data['spending'] = array_sum(array_column($data['periods'], 'spending'));
        $data['transCount'] = array_sum(array_column($data['periods'], 'count'));

        // Spending per category
        $tagNames = Tag::pluck('tag_name', 'tag_kode');
        $data['categories'] = $base()
            ->where('trans_status', 'DOWN')
            ->selectRaw('trans_tag, SUM(trans_value) as total')
            ->groupBy('trans_tag')
            ->orderByDesc('total')
            ->get()
            ->map(fn($r) => ['name' => $tagNames[$r->trans_tag] ?? 'Untagged', 'value' => (float) $r->total])
            ->values();

        $data['topExpenses'] = $base()
            ->where('trans_status', 'DOWN')
            ->with('tag')
            ->orderByDesc('trans_value')
            ->limit(10)
            ->get();

        return view('app.annual_report', $data);
    }

    public function transaction($bulan = null)
    {
        $user = Auth::user();
        $bulan = $bulan ?? date('m');
        $data['assets'] = SubAsset::where('sub_id_user', $user->user_id)->with('asset')
            ->orderBy('sub_id_asset', 'ASC')->orderBy('sub_value', 'DESC')->get();
        $data['tags'] = Tag::orderBy('tag_is_belanja', 'DESC')->orderBy('tag_kode', 'ASC')->get();
        $data['bulan'] = $bulan + 0;
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
