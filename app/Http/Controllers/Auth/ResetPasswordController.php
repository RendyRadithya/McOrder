<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use App\Models\User;

class ResetPasswordController extends Controller
{
    public function showResetForm(Request $request, $token = null)
    {
        return view('auth.passwords.reset')->with([
            'token' => $token,
            'email' => $request->query('email') ?? old('email'),
        ]);
    }

    public function reset(Request $request)
    {
        $request->validate([
            'token' => 'required|string',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:6',
        ]);

        $email = $request->input('email');
        $token = $request->input('token');

        $record = DB::table('password_resets')->where('email', $email)->first();

        if (! $record || $record->token !== $token) {
            Log::warning('Password reset failed: invalid token', ['email' => $email]);
            return back()->withErrors(['email' => 'Token reset tidak valid atau sudah kadaluarsa.']);
        }

        // optional: cek kadaluarsa 60 menit
        if (strtotime($record->created_at) < strtotime('-60 minutes')) {
            DB::table('password_resets')->where('email', $email)->delete();
            return back()->withErrors(['email' => 'Token sudah kadaluarsa. Silakan minta tautan baru.']);
        }

        $user = User::where('email', $email)->first();
        if (! $user) {
            return back()->withErrors(['email' => 'User tidak ditemukan.']);
        }

        // update password (hash wajib)
        $user->password = Hash::make($request->input('password'));
        $user->save();

        // hapus token
        DB::table('password_resets')->where('email', $email)->delete();

        Log::info('Password reset successful', ['email' => $email]);

        return redirect()->route('login')->with('status', 'Password berhasil direset. Silakan login dengan password baru.');
    }
}

// filepath: [web.php](http://_vscodecontentref_/0)
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;

Route::get('password/reset', [ForgotPasswordController::class,'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [ForgotPasswordController::class,'sendResetLinkEmail'])->name('password.email');

Route::get('password/reset/{token}', [ResetPasswordController::class,'showResetForm'])->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class,'reset'])->name('password.update');