<?php

namespace App\Http\Controllers\Admin;

use App\Actions\UpdateUserStatus;
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
                            ->get(['id', 'name', 'email', 'role_id', 'slug', 'is_active', 'disabled_by', 'disabled_at']),
        ]);
    }

    /**
     * Enable or disable user account
     */
    public function updateStatus(UpdateUserStatus $updateUserStatus, User $user): RedirectResponse
    {
        if (! $user->is_active && ($user->disabled_by !== auth()->id()) && $user->disabled_at) {
            toast(__('You cannot enable this account because it was disabled by its owner.'), 'info');
            return back();
        }

        $updateUserStatus->handle($user);

        $message = match (intval($user->is_active)) {
            1 => __('Account has been successfully unblocked.'),
            0 => __('Account has been successfully blocked.'),
        };

        toast($message, 'success');

        return back();
    }
}
