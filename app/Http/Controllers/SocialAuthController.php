<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Http\Request;

class SocialAuthController extends Controller
{
    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function callback($provider)
    {
        $socialUser = Socialite::driver($provider)->user();

        $email = $socialUser->getEmail();
        $providerIdColumn = $provider . '_id';

        $existingUser = User::where('email', $email)->first();

        if ($existingUser && !$existingUser->$providerIdColumn) {
            return redirect()->route('login')->withErrors([
                'email' => __('login_register.email_exists'),
            ]);
        }

        $user = User::updateOrCreate(
            [$providerIdColumn => $socialUser->getId()],
            [
                'name' => $socialUser->getName() ?? $socialUser->getNickname() ?? ucfirst($provider).'User',
                'email' => $email,
            ]
        );

        Auth::login($user);

        return redirect('/home');
    }
}
