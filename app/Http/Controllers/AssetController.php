<?php

namespace App\Http\Controllers;

use App\Helpers\Utils;
use App\Models\SubAsset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AssetController extends Controller
{
    public $add_code = 'asset_add';
    public $update_code = 'asset_update';
    public $delete_code = 'asset_delete';
    public $convert_code = 'asset_convert';

    public function get($id)
    {
        $data = SubAsset::where('sub_id', $id)->with('asset')->first();
        return response()->json([
            'status' => true,
            'data' => $data
        ]);
    }

    public function convert(Request $request)
    {
        $user = Auth::user();
        $asset1 = SubAsset::find($request->sub1);
        $asset2 = SubAsset::find($request->sub2);

        $oldVal1 = $asset1->sub_value;
        $oldVal2 = $asset2->sub_value;

        if (!$asset1) {
            return redirect()->back()->with('error', "Asset not found");
        }

        if ($asset1->sub_id_user != $user->user_id) {
            return redirect()->back()->with('error', "Unauthorized");
        }

        $asset1->decrement('sub_value', $request->value);
        $asset2->increment('sub_value', $request->value);

        // $tes = $this->convert_code;
        $tgl = date('Y-m-d');
        Utils::logInsert(
            $user->user_name,
            $asset1->sub_name,
            $this->convert_code . '_from',
            $tgl,
            $request->value,
            $oldVal1,
            $asset1->sub_value
        );

        Utils::logInsert(
            $user->user_name,
            $asset2->sub_name,
            $this->convert_code . '_to',
            $tgl,
            $request->value,
            $oldVal2,
            $asset2->sub_value
        );

        return redirect()->back()->with('success', "Convert success");
    }

    public function insert(Request $request)
    {
        $user = Auth::user();
        SubAsset::create([
            'sub_id_asset' => $request->sub_id_asset,
            'sub_id_user' => $user->user_id,
            'sub_name' => $request->sub_name,
            'sub_vendor' => $request->sub_vendor,
            'sub_value' => $request->sub_value,
            'val' => $request->val ?? 0,
            'code' => $request->code,
        ]);

        Utils::logInsert(
            $user->user_name,
            $request->sub_name,
            $this->add_code,
            date('Y-m-d'),
            $request->sub_value,
            0,
            $request->sub_value
        );

        return redirect()->back()->with('success', "Asset Added");
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $subAsset = SubAsset::find($request->sub_id);
        if ($user->user_id != $subAsset->sub_id_user) {
            return redirect()->back()->with('error', "Access Denied");
        }
        $oldVal = $subAsset->sub_value;

        $subAsset->sub_id_asset = $request->sub_id_asset;
        $subAsset->sub_name = $request->sub_name;
        $subAsset->sub_vendor = $request->sub_vendor;
        $subAsset->sub_value = $request->sub_value;
        $subAsset->val = $request->val ?? 0;
        $subAsset->code = $request->code;
        $subAsset->save();

        Utils::logInsert(
            $user->user_name,
            $subAsset->sub_name,
            $this->update_code,
            date('Y-m-d'),
            $request->sub_value,
            $oldVal,
            $subAsset->sub_value
        );

        return redirect()->back()->with('success', "Asset Updated");
    }

    public function delete(Request $request)
    {
        $user = Auth::user();
        $subAsset = SubAsset::find($request->sub_id);
        if ($user->user_id != $subAsset->sub_id_user) {
            return redirect()->back()->with('error', "Access Denied");
        }

        $oldAset = $subAsset->sub_name;
        $oldVal = $subAsset->sub_value;

        $subAsset->delete();

        Utils::logInsert(
            $user->user_name,
            $oldAset,
            $this->delete_code,
            date('Y-m-d'),
            0,
            $oldVal,
            0
        );

        return redirect()->back()->with('success', "Asset Deleted");
    }

    public function updateRealVal()
    {
        $dolarToRupiah = 0;
        
        $assets = SubAsset::where('sub_id_user', Auth::user()->user_id)
            ->where('sub_id_asset', 2)->whereNotNull('code')->get();
            
        $urlIDR = "https://api.coingecko.com/api/v3/simple/price?ids=usd&vs_currencies=idr";
        
        try {
            $ress = file_get_contents($urlIDR);
            if ($ress === FALSE) {
                return redirect()->back()->with('error', "API IDR Response Error");
            }
            $data = json_decode($ress, true);
            $dolarToRupiah = $data["usd"]["idr"];
            //dd($data);
        } catch (\Throwable $th) {
            //dd($th->getMessage());
        }

        $url = 'https://www.binance.me/api/v3/ticker/price?symbol=';

        foreach ($assets as $asst) {
            try {
                $response = file_get_contents($url . $asst->code);
                if ($response === FALSE) {
                    return redirect()->back()->with('error', "API Response Error");
                }
                $data = json_decode($response, true);
                $asst->sub_value = ($data['price'] * $asst->val) * $dolarToRupiah;
                $asst->save();
                // var_dump($data);
                // echo "<br>";
            } catch (\Throwable $th) {
            }
        }

        return redirect()->back()->with('success', "Update Data Success. 1 Dollar = ".$dolarToRupiah);

        // $url = 'https://www.binance.me/api/v3/ticker/price?symbols=';

        // $symbols = [];
        // foreach ($assets as $asst) {
        //     array_push($symbols, $asst->code);
        // }

        // $response = file_get_contents($url . json_encode($symbols));

        // if ($response === FALSE) {
        //     return redirect()->back()->with('error', "API Response Error");
        // }

        // $data = json_decode($response, true);

        // // dd($data);

        // if ($data === NULL) {
        //     return redirect()->back()->with('error', "API Data Error");
        // }

        // foreach ($data as $ticker) {
        //     echo 'Symbol: ' . $ticker['symbol'] . ' - Price: ' . $ticker['price'] . PHP_EOL;
        // }
    }
}
