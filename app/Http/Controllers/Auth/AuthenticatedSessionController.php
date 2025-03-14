<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
{
    // Cek jika user sudah login
    if (Auth::check()) {
        $role = Auth::user()->role;
        switch ($role) {
            case 'admin':
                return redirect()->route('admin.home');
            case 'user':
                return redirect()->route('subscriber.home');
            case 'author':
                return redirect()->route('author.home');
            default:
                logger('Unknown usertype: ' . $role);
                session()->flash('error', 'Jenis pengguna tidak dikenali!');
                return redirect()->back();
        }
    }

    try {
        // Lakukan autentikasi user
        $request->authenticate();

        // Regenerate session
        $request->session()->regenerate();

        // Set flash message untuk sukses
        session()->flash('success', 'Login berhasil!');

        // Redirect berdasarkan role user
        $role = $request->user()->role;
        switch ($role) {
            case 'admin':
                return redirect()->route('admin.home');
            case 'user':
                return redirect()->route('subscriber.home');
            case 'author':
                return redirect()->route('author.home');
            default:
                logger('Unknown usertype: ' . $role);
                session()->flash('error', 'Jenis pengguna tidak dikenali!');
                return redirect()->back();
        }
    } catch (ValidationException $e) {
        // Tangani kegagalan login
        session()->flash('error', 'Login gagal! Periksa kembali kredensial Anda.');
        return redirect()->back();
    }
}


    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
