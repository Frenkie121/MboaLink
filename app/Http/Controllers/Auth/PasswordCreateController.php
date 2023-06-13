<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class PasswordCreateController extends Controller
{
    public function create(Request $request)
    {
        return view('auth.create-password', [
            'signature' => $request->signature,
            'email' => $request->email,
        ]);
    }

    public function save(Request $request)
    {
        $request->validate([
            'signature' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);
        
        $user = User::query()->where('email', $request->email)->first();
        $user->password = $request->password;
        $user->save();

        toast(__('Your password has been successfully created.'), 'success');
        return redirect()->route('login')->with('email', $request->email);
    }
}
