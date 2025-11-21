<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\User;

class ForgotPasswordController extends Controller
{
    public function showLinkRequestForm()
    {
        return view('auth.passwords.email');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);
        $email = $request->input('email');

        $user = User::where('email', $email)->first();
        if (! $user) {
            return back()->withErrors(['email' => 'Email tidak ditemukan.']);
        }

        // buat token plain dan simpan (simple)
        $token = Str::random(64);

        // hapus token lama lalu simpan token baru
        DB::table('password_resets')->where('email', $email)->delete();
        DB::table('password_resets')->insert([
            'email' => $email,
            'token' => $token,
            'created_at' => now(),
        ]);

        // buat tautan reset (user bisa buka dari log saat development)
        $link = route('password.reset', $token) . '?email=' . urlencode($email);

        // tulis ke log supaya bisa diambil saat MAIL belum dikonfigurasi
        Log::info('Password reset link', ['email' => $email, 'link' => $link]);

        // balikkan pesan (link ada di log)
        return back()->with('status', 'Tautan reset dikirim. Cek laravel.log (MAIL_MAILER=log) untuk tautan di development.');
    }
}