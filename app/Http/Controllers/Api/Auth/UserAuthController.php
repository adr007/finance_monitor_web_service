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
                'user_photo' => "https://www.insoft.co.id/wp-content/uploads/2014/05/default-user-image.png",
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
        $request->user()->tokens()->delete();
        return response()->json(['status' => true, 'msg' => "Logout Success"]);
    }
}
