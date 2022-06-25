<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Asset, SubAsset, Tag, Transaction};
// use Mockery\Matcher\Subset;

class AssetsController extends Controller
{

    public function getUserSummary(Request $request)
    {
        $user = $request->user();
        $data['totalAssets'] = $user->subAssets()->sum('sub_value');
        $bulan = date('m');
        $tahun = date('Y');

        $assets = Asset::orderBy('asset_name', 'ASC')->get();
        $sendSum = [];

        foreach ($assets as $asset) {
            $sum = $user->subAssets()->where('sub_id_asset', $asset->asset_id)->sum('sub_value');
            $x['assetName'] = $asset->asset_name;
            $x['amount'] = $sum;
            $x['icon'] = $asset->asset_icon;
            $x['color'] = $asset->asset_color;
            array_push($sendSum, $x);
        }

        $data['detail'] = $sendSum;

        $data['todayIncome'] = Transaction::where('trans_id_user', $user->user_id)
                                    ->whereDate('trans_date', date('Y-m-d'))
                                    ->where('trans_status', "UP")->sum('trans_value');

        $data['todaySpending'] = Transaction::where('trans_id_user', $user->user_id)
                                    ->whereDate('trans_date', date('Y-m-d'))
                                    ->where('trans_status', "DOWN")->sum('trans_value');

        $data['thisMonth']['Income'] = Transaction::where('trans_id_user', $user->user_id)
                                    ->whereMonth('trans_date', $bulan)
                                    ->whereYear('trans_date', $tahun)
                                    ->where('trans_status', "UP")->sum('trans_value');

        $data['thisMonth']['Spending'] = Transaction::where('trans_id_user', $user->user_id)
                                    ->whereMonth('trans_date', $bulan)
                                    ->whereYear('trans_date', $tahun)
                                    ->where('trans_status', "DOWN")->sum('trans_value');

        $data['thisMonth']['Saving'] = $data['thisMonth']['Income'] - $data['thisMonth']['Spending'];

        return response()->json([
            'status' => true,
            'data' => $data,
        ]);
    }

    public function getSubAssetById(Request $request)
    {
        $data = SubAsset::find($request->sub_id);

        if ($request->user()->user_id != $data->sub_id_user) {
            return response()->json([
                'status' => false,
                'msg' => 'Access Denied',
            ]);
        }

        return response()->json([
            'status' => true,
            'msg' => 'Data Received',
            'data' => $data,
        ]);
    }

    public function getAllSubAssetsByUser(Request $request)
    {
        $data = SubAsset::getAllWithAssetByUser($request->user()->user_id)->get();
        return response()->json([
            'status' => true,
            'msg' => 'Data Received',
            'data' => $data,
        ]);
    }

    public function createSubAsset(Request $request)
    {
        $result = SubAsset::create([
            'sub_id_asset' => $request->sub_id_asset,
            'sub_id_user' => $request->user()->user_id,
            'sub_name' => $request->sub_name,
            'sub_vendor' => $request->sub_vendor,
            'sub_value' => $request->sub_value,
        ]);
        return response()->json([
            'status' => true,
            'msg' => 'Sub Asset Created',
            'data' => $result,
        ]);
    }

    public function updateSubAsset(Request $request)
    {
        $res = SubAsset::find($request->sub_id);

        if ($request->user()->user_id != $res->sub_id_user) {
            return response()->json([
                'status' => false,
                'msg' => 'Access Denied',
            ]);
        }

        $res->sub_name = $request->sub_name;
        $res->sub_vendor = $request->sub_vendor;
        $res->sub_value = $request->sub_value;
        $res->save();
        return response()->json([
            'status' => true,
            'msg' => 'Data Updated',
        ]);
    }

    public function deleteSubAsset(Request $request)
    {
        $result = SubAsset::find($request->sub_id);
        if ($request->user()->user_id == $result->sub_id_user) {
            $result->delete();
            return response()->json([
                'status' => true,
                'msg' => 'Data Deleted',
            ]);
        } else {
            return response()->json([
                'status' => false,
                'msg' => 'Access Denied',
            ]);
        }
    }

    public function getAssetsList()
    {
        $data = Asset::orderBy('asset_id', 'ASC')->get();
        return response()->json([
            'status' => true,
            'msg' => 'Data Received',
            'data' => $data,
        ]);
    }

    public function convertAsset(Request $request)
    {
        $asset1 = SubAsset::find($request->trans_id_sub_asset1);
        $asset2 = SubAsset::find($request->trans_id_sub_asset2);

        if (!$asset1) {
            return response()->json([
                'status' => false,
                'msg' => 'User Error',
            ]);
        }

        if ($asset1->sub_id_user != $request->user()->user_id) {
            return response()->json([
                'status' => false,
                'msg' => 'Unauthorized',
            ]);
        }

        $asset1->decrement('sub_value', $request->trans_value);
        $asset2->increment('sub_value', $request->trans_value);

        return response()->json([
            'status' => true,
            'msg' => 'Asset Converted',
        ]);
    }
}
