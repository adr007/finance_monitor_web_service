<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    // use HasFactory;
    // protected $table = '';
    protected $primaryKey = 'trans_id';
    protected $guarded = [];
    const CREATED_AT = 'created_time';
    const UPDATED_AT = 'updated_time';

    public function user()
    {
        return $this->belongsTo(User::class, 'trans_id_user', 'user_id');
    }

    public function subAsset()
    {
        return $this->belongsTo(SubAsset::class, 'trans_id_sub_asset', 'sub_id');
    }

    public function tag()
    {
        return $this->belongsTo(Tag::class, 'trans_tag', 'tag_kode');
    }

    public static function getAllByUserJoinSubAssets($user_id)
    {
        return self::leftJoin('sub_assets', 'transactions.trans_id_sub_asset', '=', 'sub_assets.sub_id')
        ->leftJoin('assets', 'sub_assets.sub_id_asset', '=', 'assets.asset_id')
        ->where('transactions.trans_id_user', $user_id)
        ->whereYear('transactions.trans_date', date('Y'))
        ->whereMonth('transactions.trans_date', date('m'))
        ->with('tag')
        ->orderBy('transactions.trans_date', 'DESC')->orderBy('transactions.trans_value', 'DESC');
    }
}
