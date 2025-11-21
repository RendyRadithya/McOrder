<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ChangePasswordController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // tampilkan form ubah password
    public function show()
    {
        return view('auth.passwords.change'); // buat view ini jika belum ada
    }

    // proses ubah password
    public function update(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|confirmed|min:6',
        ]);

        $user = Auth::user();
        if (! Hash::check($request->input('current_password'), $user->password)) {
            return back()->withErrors(['current_password' => 'Password lama salah.']);
        }

        $user->password = Hash::make($request->input('password'));
        $user->remember_token = Str::random(60);
        $user->save();

        return redirect()->route('login')->with('status', 'Password berhasil diubah. Silakan login.');
    }
}