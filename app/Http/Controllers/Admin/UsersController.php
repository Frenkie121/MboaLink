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
                            ->get(['id', 'name', 'email', 'role_id', 'slug', 'is_active']),
        ]);
    }

    /**
     * Enable or disable user account
     */
    public function updateStatus(UpdateUserStatus $updateUserStatus, User $user): RedirectResponse
    {
        $updateUserStatus->handle($user);

        $message = match (intval($user->is_active)) {
            1 => __('Account has been successfully unblocked.'),
            0 => __('Account has been successfully blocked.'),
        };

        toast($message, 'success');

        return back();
    }
}
