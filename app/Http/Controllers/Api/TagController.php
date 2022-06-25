<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function getAllTag()
    {
        $data = Tag::orderBy('tag_kode', 'ASC')->get();
        return response()->json([
            'status' => true,
            'msg' => 'Data Received',
            'data' => $data,
        ]);
    }
}
