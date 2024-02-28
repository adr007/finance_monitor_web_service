<?php

namespace App\Http\Controllers;

use App\Models\SubAsset;
use App\Models\Tag;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class TransController extends Controller
{
    public function dataUser()
    {
        $user = Auth::user();
        $data = Transaction::getAllByUserJoinSubAssets($user->user_id);

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('status', function ($row) {
                $lbl = '<span class="text-danger">SPENDING</span>';
                if ($row->trans_status == 'UP') {
                    $lbl = '<span class="text-success">INCOME</span>';
                }
                return $lbl;
            })
            ->addColumn('menu', function ($row) {
                return '<div class="btn-group" role="group">
                <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                  <i class="fa fa-align-justify"></i>
                </button>
                <div class="dropdown-menu">
                  <button class="dropdown-item text-danger" type="button" onclick="initHapus(' . $row->trans_id . ')">Hapus</button>
                </div>
              </div>
            ';
            })
            ->rawColumns(['status', 'menu'])
            ->make(true);
    }

    public function insert(Request $request)
    {
        $user = Auth::user();
        $tag = Tag::find($request->tag_id);

        $trans_status = 'DOWN';
        if ($tag->tag_is_belanja == 0) {
            $trans_status = 'UP';
        }

        Transaction::create([
            'trans_id_user' => $user->user_id,
            'trans_id_sub_asset' => $request->sub_id,
            'trans_value' => $request->trans_value,
            'trans_tag' => $tag->tag_kode,
            'trans_status' => $trans_status,
            'trans_information' => $request->trans_information,
            'trans_date' => $request->trans_date,
        ]);

        if ($trans_status == "UP") {
            SubAsset::find($request->sub_id)->increment('sub_value', $request->trans_value);
        } else {
            SubAsset::find($request->sub_id)->decrement('sub_value', $request->trans_value);
        }

        return response()->json([
            'status' => true,
            'msg' => 'Data Created',
        ]);
    }

    public function delete(Request $request)
    {
        $user = Auth::user();
        $trans = Transaction::find($request->trans_id);

        if ($user->user_id != $trans->trans_id_user) {
            return response()->json([
                'status' => false,
                'msg' => 'Access Denied',
            ]);
        }

        if ($trans->trans_status == "UP") {
            SubAsset::find($trans->trans_id_sub_asset)->decrement('sub_value', $trans->trans_value);
        } else {
            SubAsset::find($trans->trans_id_sub_asset)->increment('sub_value', $trans->trans_value);
        }

        $trans->delete();
        return response()->json([
            'status' => true,
            'msg' => 'Data Deleted',
        ]);
    }
}
