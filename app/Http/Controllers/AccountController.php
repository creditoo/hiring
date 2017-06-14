<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\User;

class AccountController extends Controller
{

    public function profile()
    {
        $user = Auth::user();

        return view('account/profile', [
            'user' => User::find($user->id)
        ]);
    }

}
