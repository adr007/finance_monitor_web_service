<?php

namespace App\Helpers;

use App\Models\Logs;
use Illuminate\Support\Facades\Auth;

class Utils
{

    public static function rupiah($number)
    {
        return number_format($number, 0, ',', '.');
    }

    public static function logInsert($user_name, $asset_name, $desc, $date, $tr_value, $from_value, $to_value)
    {
        $user = Auth::user();
        Logs::create([
            'user_id' => $user->user_id,
            'user_name' => $user_name,
            'asset_name' => $asset_name,
            'desc' => $desc,
            'date' => $date,
            'tr_value' => $tr_value,
            'from_value' => $from_value,
            'to_value' => $to_value,
        ]);
    }
}
