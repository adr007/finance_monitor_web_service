<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Asset, SubAsset, Transaction};

class TransactionController extends Controller
{
    public function getAllTransByUser(Request $request)
    {
        $user = $request->user();
        $data = Transaction::getAllByUserJoinSubAssets($user->user_id)->get();
        return response()->json([
            'status' => true,
            'msg' => 'Data Received',
            'data' => $data,
        ]);
    }

    public function getTransById(Request $request)
    {
        $trans = Transaction::find($request->trans_id);

        if ($request->user()->user_id != $trans->trans_id_user) {
            return response()->json([
                'status' => false,
                'msg' => 'Access Denied',
            ]);
        }

        $trans->subAsset->asset;
        return response()->json([
            'status' => true,
            'msg' => 'Data Received',
            'data' => $trans,
        ]);
    }

    public function createTransaction(Request $request)
    {
        if(@$request->trans_tag) {
            $trans_tag = $request->trans_tag;
        } else {
            $trans_tag = 100;
        }
        
        $result = Transaction::create([
            'trans_id_user' => $request->user()->user_id,
            'trans_id_sub_asset' => $request->trans_id_sub_asset,
            'trans_value' => $request->trans_value,
            'trans_tag' => $trans_tag,
            'trans_status' => $request->trans_status,
            'trans_information' => $request->trans_information,
            'trans_date' => $request->trans_date,
        ]); 

        if ($request->trans_status == "UP") {
            SubAsset::find($request->trans_id_sub_asset)->increment('sub_value', $request->trans_value);
        }
        else {
            SubAsset::find($request->trans_id_sub_asset)->decrement('sub_value', $request->trans_value);
        }

        return response()->json([
            'status' => true,
            'msg' => 'Data Created',
            'data' => $result,
        ]);
    }

    public function updateTransaction(Request $request)
    {
        $trans = Transaction::find($request->trans_id);

        if ($request->user()->user_id != $trans->trans_id_user) {
            return response()->json([
                'status' => false,
                'msg' => 'Access Denied',
            ]);
        }

        if ($trans->trans_status == "UP") {
            SubAsset::find($trans->trans_id_sub_asset)->decrement('sub_value', $trans->trans_value);
        }
        else {
            SubAsset::find($trans->trans_id_sub_asset)->increment('sub_value', $trans->trans_value);
        }

        $trans->trans_value = $request->trans_value;
        $trans->trans_status = $request->trans_status;
        $trans->trans_information = $request->trans_information;
        $trans->trans_date = date('Y-m-d');
        $trans->save();

        if ($request->trans_status == "UP") {
            SubAsset::find($trans->trans_id_sub_asset)->increment('sub_value', $request->trans_value);
        }
        else {
            SubAsset::find($trans->trans_id_sub_asset)->decrement('sub_value', $request->trans_value);
        }

        return response()->json([
            'status' => true,
            'msg' => 'Data Updated',
        ]);
    }

    public function deleteTransaction(Request $request)
    {
        $trans = Transaction::find($request->trans_id);

        if ($request->user()->user_id != $trans->trans_id_user) {
            return response()->json([
                'status' => false,
                'msg' => 'Access Denied',
            ]);
        }

        if ($trans->trans_status == "UP") {
            SubAsset::find($trans->trans_id_sub_asset)->decrement('sub_value', $trans->trans_value);
        }
        else {
            SubAsset::find($trans->trans_id_sub_asset)->increment('sub_value', $trans->trans_value);
        }

        $trans->delete();
        return response()->json([
            'status' => true,
            'msg' => 'Data Deleted',
        ]);
    }
}
