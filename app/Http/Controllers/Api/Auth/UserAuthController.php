<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserAuthController extends Controller
{
    public function gasLogin(Request $request)
    {
        $user = User::where('user_email', $request->email)->first();
        if ($user) {
            if (!Hash::check($request->password, $user->password)) {
                return response()->json(['status' => false, 'msg' => "Wrong Password"]);
            } else {
                $token = $user->createToken('token')->plainTextToken;
                return response()->json([
                    'status' => true, 
                    'msg' => "Login Success",
                    'token' => $token, 
                    'user' => $user,
                ]);
            }
        }
        else{
            return response()->json(['status' => false, 'msg' => "Email not registered"]);
        }
    }

    public function gasLogout(Request $request)
    {
        $request->user()->tokens()->delete();
        return response()->json(['status' => true, 'msg' => "Logout Success"]);
    }
}
