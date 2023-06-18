<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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
     * Attempt to authenticate the request's credentials.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $message = '';
        $remember = (bool) $request->remember;
        if (! Auth::attemptWhen([
            'email' => $request->email,
            'password' => $request->password,
        ], fn (User $user) => $user->canLogin())
        ) {
            $user = User::where('email', $request->email)->first();
            if ($user) {
                if (Hash::check($request->password, $user->password) && (! $user->canLogin())) {
                    $message = 'auth.disabled';
                } else {
                    $message = 'auth.failed';
                }
            } else {
                $message = 'auth.failed';
            }
            throw ValidationException::withMessages([
                'email' => trans($message),
            ]);
        }
        $request->authenticate();
        $request->session()->regenerate();

        $auth = auth()->user();
        if ($auth->role_id === 1) {
            $redirect = 'admin/dashboard';
        } elseif (
            ($auth->role_id === 2 && $auth->userable->jobs->isEmpty())
            || ($auth->role_id === 6 && $auth->userable_type === 'App\Models\Company')
        ) {
            $redirect = '/jobs/create';
        } elseif (
            in_array($auth->role_id, [2, 3, 4, 5])
            || ($auth->role_id === 2 && $auth->userable->jobs->isNotEmpty())
        ) {
            $redirect = '/me';
        } else {
            $redirect = '/jobs';
        }

        return redirect()->intended($redirect);
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
