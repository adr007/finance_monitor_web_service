<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $primaryKey = 'tag_id';
    protected $guarded = [];

    public function subAssets()
    {
        return $this->hasMany(SubAsset::class, 'trans_tag', 'tag_kode');
    }

}
