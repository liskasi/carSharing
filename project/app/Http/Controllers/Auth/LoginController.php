<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->stateless()->redirect();
    }
    public function handleGoogleCallback()
    {
        $user = Socialite::driver('google')->stateless()->user();
        $this->_registerOrLoginUser($user);

        return redirect()->route('home');
    }

    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->stateless()->redirect();
    }
    public function handleFacebookCallback()
    {
        $user = Socialite::driver('facebook')->stateless()->user();
        $this->_registerOrLoginUser($user);

        return redirect()->route('home');
    }

    
    // Route::get('/auth/redirect', function () {
//     return Socialite::driver('google')->redirect();
// });

// Route::get('/auth/callback', function () {
//     $user = Socialite::driver('google')->user();

//     // $user->token
// });

// Route::get('/auth/redirect', function () {
//     return Socialite::driver('facebook')->redirect();
// });

// Route::get('/auth/callback', function () {
//     $user = Socialite::driver('facebook')->user();

//     // $user->token
// });

    protected function _registerOrLoginUser($data)
    {
        $user = User::where('email','=', $data->email)->first();
        if(!$user)
        {
            // $user = new User();
            // $user->name = $data->name;
            // $user->email = $data->email;
            // $user->provider_id = $data->id;
            // //$user->avatar= $data->avatar;
            // $user->save;

            return User::create([
                'name' => $data->name,
                'email' => $data->email,
            ]);
    
        }
        Auth::login($user);
    }

}
