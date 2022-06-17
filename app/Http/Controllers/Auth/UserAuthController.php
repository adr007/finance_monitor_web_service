<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserAuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function gasLogin(Request $request)
    {
        $user = User::where('user_email', $request->user_email)->first();
        if ($user) {
            if (Auth::attempt(['user_email' => $request->user_email, 'password' => $request->user_pass])) {
                //SUCCESS
                $request->session()->regenerate();
                return redirect()->intended('/user/dashboard');
            } else {
                //FAIL
                return redirect()
                    ->back()
                    ->withInput()
                    ->withErrors(["loginFail" => "Login Gagal"]);
            }
        }
        else{
            //USER NOT FOUND
            return redirect()
                ->back()
                ->withInput()
                ->withErrors(["loginFail" => "Email tidak ditemukan."]);
        }
    }

    public function gasLogout(Request $request)
    {
        Auth::logout();
        session()->flush();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
