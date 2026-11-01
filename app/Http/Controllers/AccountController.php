<?php

namespace App\Http\Controllers;

use App\Models\{SubAsset, Transaction, User};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Auth, File, Hash};
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class AccountController extends Controller
{
    // Folder (di dalam public/) untuk menyimpan foto profil yang di-upload
    private $photoDir = 'uploads/profile';

    public function profile()
    {
        $user = User::find(Auth::user()->user_id);

        $data['user'] = $user;
        $data['stats'] = [
            'transactions' => Transaction::where('trans_id_user', $user->user_id)->count(),
            'assets' => SubAsset::where('sub_id_user', $user->user_id)->count(),
            'totalAssets' => SubAsset::where('sub_id_user', $user->user_id)->sum('sub_value'),
        ];

        return view('app.profile', $data);
    }

    public function updateProfile(Request $request)
    {
        $user = User::find(Auth::user()->user_id);

        $request->validate([
            'user_name' => 'required|string|max:100',
            'username' => [
                'required', 'string', 'max:50', 'alpha_dash',
                Rule::unique('users', 'username')->ignore($user->user_id, 'user_id'),
            ],
            'user_email' => [
                'required', 'email', 'max:100',
                Rule::unique('users', 'user_email')->ignore($user->user_id, 'user_id'),
            ],
            'user_tlp' => 'nullable|string|max:20|regex:/^[0-9+\-\s()]+$/',
            'user_photo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ], [], [
            'user_name' => 'Nama lengkap',
            'username' => 'Username',
            'user_email' => 'Email',
            'user_tlp' => 'No. telepon',
            'user_photo' => 'Foto profil',
        ]);

        $user->user_name = $request->user_name;
        $user->username = $request->username;
        $user->user_email = $request->user_email;
        $user->user_tlp = $request->user_tlp;

        if ($request->hasFile('user_photo')) {
            $file = $request->file('user_photo');
            $fileName = $user->user_id . '_' . time() . '_' . Str::random(6) . '.' . $file->extension();
            // Buat folder upload jika belum ada
            $dir = public_path($this->photoDir);
            if (!File::isDirectory($dir)) {
                File::makeDirectory($dir, 0755, true);
            }

            $file->move($dir, $fileName);

            $this->deleteLocalPhoto($user->user_photo);
            $user->user_photo = $this->photoDir . '/' . $fileName;
        } elseif ($request->boolean('remove_photo')) {
            $this->deleteLocalPhoto($user->user_photo);
            $user->user_photo = null;
        }

        $user->save();

        return redirect()->route('user.profile')->with('account_success', 'Profil berhasil diperbarui.');
    }

    public function setting()
    {
        $data['user'] = User::find(Auth::user()->user_id);
        return view('app.setting', $data);
    }

    public function updatePassword(Request $request)
    {
        $user = User::find(Auth::user()->user_id);

        $request->validate([
            'current_password' => 'required',
            'password' => ['required', 'confirmed', 'different:current_password', 'min:8', 'regex:/[A-Za-z]/', 'regex:/[0-9]/'],
        ], [
            'password.different' => 'Password baru harus berbeda dari password saat ini.',
            'password.regex' => 'Password baru harus mengandung huruf dan angka.',
        ], [
            'current_password' => 'Password saat ini',
            'password' => 'Password baru',
        ]);

        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()
                ->withErrors(['current_password' => 'Password saat ini tidak sesuai.']);
        }

        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('user.setting')->with('account_success', 'Password berhasil diubah.');
    }

    private function deleteLocalPhoto($path)
    {
        // Hanya hapus file hasil upload lokal, bukan URL eksternal
        if ($path && Str::startsWith($path, $this->photoDir . '/') && File::exists(public_path($path))) {
            File::delete(public_path($path));
        }
    }
}
