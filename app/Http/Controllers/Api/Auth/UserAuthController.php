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
        if(@$request->email && @$request->password) {
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
        } else {
            return response()->json([
                'status' => false, 
                'msg' => "Isi form yang kosong",
            ]);
        }
    }

    public function gasRegis(Request $request)
    {
        $user = User::where('user_email', $request->email)->first();
        if ($user) {
            return response()->json(['status' => false, 'msg' => "Email already registered. Please Login"]);
        }
        else{
            $user = User::create([
                'user_name' => $request->user_name,
                'user_email' => $request->email,
                'user_tlp' => '',
                'user_photo' => "https://i.ibb.co/wyYHccH/user-2.png",
                'password' => Hash::make($request->password),
            ]);
            $token = $user->createToken('token')->plainTextToken;
            return response()->json([
                'status' => true, 
                'msg' => "Register Success",
                'token' => $token, 
                'user' => $user,
            ]);
            
        }
    }

    public function gasLogout(Request $request)
    {
        // Revoke a specific token...
        // $request->user()->tokens()->delete();
        
        if(@$request->user()) {
            $request->user()->currentAccessToken()->delete();
        }

        return response()->json(['status' => true, 'msg' => "Logout Success"]);
    }
}
