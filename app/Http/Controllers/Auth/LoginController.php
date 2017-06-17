<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use App\User;

class LoginController extends Controller
{
    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('github')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return Response
     */
    public function handleProviderCallback()
    {
        $user = Socialite::driver('github')->user();

        $authUser = $this->findOrCreateUser($user);

        Auth::login($authUser, true);

        return redirect(route('profile'));
    }

    /**
     * Create or Update a User
     *
     * @param $user Object should contain account data from Github
     *
     * @return User
     */
    private function findOrCreateUser($user)
    {
        $data =[
            'id'        => $user->id,
            'nickname'  => $user->nickname,
            'name'      => $user->name,
            'email'     => $user->email,
            'avatar'    => $user->avatar,
            'url'       => "http://github.com/{$user->nickname}"
        ];

        if ($authUser = User::where('id', $user->id)->first()) {
            $authUser->update($data);

            return $authUser;
        }

        return User::create($data);
    }
}