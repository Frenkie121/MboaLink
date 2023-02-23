<?php

namespace App\Http\Controllers\Admin\Users;

use App\Models\User;
use App\Http\Controllers\Controller;

class UserStatusController extends Controller
{
    public function __invoke(User $user)
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
