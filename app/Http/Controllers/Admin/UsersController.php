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
                            ->get(),
        ]);
    }

    /**
     * Enable or disable user account
     *
     * @param User $user
     * 
     * @return \Illuminate\Http\RedirectResponse
     * 
     */
    public function updateStatus(User $user) : RedirectResponse
    {
        if ($user->is_active) {
            $user->is_active = false;
            $content = trans('disabled');
        } else {
            $user->is_active = true;
            $content = trans('enabled');
        }
        $message = trans('Account has been successfully ') . $content;
        $user->save();

        return back();
    }
}
