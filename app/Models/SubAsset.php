<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubAsset extends Model
{
    // use HasFactory;
    protected $table = 'sub_assets';
    protected $primaryKey = 'sub_id';
    protected $guarded = [];

    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'trans_id_sub_asset', 'sub_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'trans_id_user', 'user_id');
    }

    public function asset()
    {
        return $this->belongsTo(Asset::class, 'sub_id_asset', 'asset_id');
    }

    public static function getAllWithAssetByUser($user_id)
    {
        $joinTable = 'assets';
        return self::leftJoin($joinTable, 'sub_assets.sub_id_asset', '=', $joinTable.'.asset_id')
        ->where('sub_assets.sub_id_user', $user_id)
        ->orderBy('sub_assets.sub_id_asset', 'ASC')->orderBy('sub_assets.sub_value', 'DESC');
    }
}
