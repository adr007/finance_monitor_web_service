<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function getUserLogin(Request $request)
    {
        $data = $request->user();
        return response()->json([
            'status' => true,
            'msg' => 'Data Received',
            'data' => $data,
        ]);
    }
}
