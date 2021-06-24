<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    // use HasFactory;
    // protected $table = '';
    protected $primaryKey = 'asset_id';
    protected $guarded = [];

    public function subAssets()
    {
        return $this->hasMany(SubAsset::class, 'sub_id_asset', 'asset_id');
    }
}
