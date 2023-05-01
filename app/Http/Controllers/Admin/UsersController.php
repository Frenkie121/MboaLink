<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;

class UsersController extends Controller
{
    public function index()
    {
        return view('admin.users.index', [
            'users' => User::query()
                            ->with('role:id,name')
                            ->get(['id', 'name', 'email', 'role_id', 'slug', 'is_active']),
        ]);
    }

    /**
     * Enable or disable user account
     */
    public function updateStatus(User $user): RedirectResponse
    {
        if ($user->is_active) {
            $user->is_active = false;
            $message = trans('Account has been successfully unblocked.');
        } else {
            $user->is_active = true;
            $message = trans('Account has been successfully blocked.');
        }
        $user->save();

        toast($message, 'success');

        return back();
    }
}
