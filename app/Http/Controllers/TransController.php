<?php

namespace App\Http\Controllers;

use App\Helpers\Utils;
use App\Models\SubAsset;
use App\Models\Tag;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class TransController extends Controller
{

    public $up_code = 'trans_up';
    public $down_code = 'trans_down';
    public $delete_code = 'trans_delete';

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
        $code = $this->down_code;
        if ($tag->tag_is_belanja == 0) {
            $trans_status = 'UP';
            $code = $this->up_code;
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

        $subAsset = SubAsset::find($request->sub_id);
        $oldVal = $subAsset->sub_value;

        if ($trans_status == "UP") {
            $subAsset->increment('sub_value', $request->trans_value);
        } else {
            $subAsset->decrement('sub_value', $request->trans_value);
        }

        Utils::logInsert(
            $user->user_name,
            $subAsset->sub_name,
            $code,
            $request->trans_date,
            $request->trans_value,
            $oldVal,
            $subAsset->sub_value
        );

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

        $subAsset = SubAsset::find($trans->trans_id_sub_asset);
        $oldVal = $subAsset->sub_value;
        $tr_val = $trans->trans_value;

        if ($trans->trans_status == "UP") {
            $subAsset->decrement('sub_value', $trans->trans_value);
        } else {
            $subAsset->increment('sub_value', $trans->trans_value);
        }

        $trans->delete();

        Utils::logInsert(
            $user->user_name,
            $subAsset->sub_name,
            $this->delete_code,
            date('Y-m-d'),
            $tr_val,
            $oldVal,
            $subAsset->sub_value
        );

        return response()->json([
            'status' => true,
            'msg' => 'Data Deleted',
        ]);
    }
}
