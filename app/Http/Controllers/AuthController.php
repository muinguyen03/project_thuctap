<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\ForgotPass;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\PasswordReset;
use App\Models\User;
use App\Notifications\ResetPasswordRequest;
use App\Notifications\UserRegister;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->user = new User();
    }

    public function login(): Factory|View|Application{
        return view('auth.login');
    }
    public function register(): Factory|View|Application{
        return view('auth.register');
    }
    public function forgot(){
        return view('auth.forgot');
    }
    public function login_gg(): RedirectResponse{
        return Redirect::to(Socialite::driver('google')->stateless()->redirect()->getTargetUrl());
    }
    public function process_login(LoginRequest $request){
        $authUser = $this->user->where(function ($query) use ($request) {
            $query->where('email', $request->email);
        })->first();
        if($authUser){
            if(!Hash::check($request->password, $authUser->password)){
                return redirect()->route('auth.login')->with('error','Invalid password');
            }
            else {
                if($authUser->status == 1){
                    return redirect()->route('auth.login')->with('error','Account is waiting test !');
                }
                else if($authUser->status == 2){
                    return redirect()->route('auth.login')->with('error','Account is block !');
                }
                else if($authUser->status == 0) {
                    Auth::login($authUser);
                    return redirect()->route('client.home');
                }
                else {
                    return redirect()->route('client.home')->with('error','Error !');
                }
            }
        }else {
            return redirect()->route('auth.login')->with('error','Username or Email invalid !');
        }
    }
    public function process_register(RegisterRequest $request): RedirectResponse
    {
        $user = $this->user->create([
            'name'      => $request->name,
            'email'     => $request->email,
            'password'  => Hash::make($request->password),
        ]);
        $authUser = $this->user->where(function ($query) use ($request) {
            $query->where('email', $request->email);
        })->first();
        $user->notify(new UserRegister($user->email, $request->password));
        return redirect()->route('auth.login')->with('success','Register Success');
    }
    public function callback(Request $request): RedirectResponse
    {
        $state = $request->input('state');
        parse_str($state, $result);
        $googleUser = Socialite::driver('google')->stateless()->user();
        $authUser = User::where('email', $googleUser->email)->first();

        if(!$authUser){
            $createUser = $this->user->create([
                'name'      => $googleUser->name,
                'email'     => $googleUser->email,
                'password'  => Hash::make('123'),
                'image'     => $googleUser->avatar
            ]);
            $user = $this->user->where('email', $googleUser->email)->first();
            $user->notify(new UserRegister($googleUser->email, '123'));
            return redirect()->route('auth.login')->with('success','Register Success');
        }
        else {
            if($authUser->status == 1){
                return redirect()->route('auth.login')->with('error','Account is waiting test !');
            }
            else if($authUser->status == 2){
                return redirect()->route('auth.login')->with('error','Account is block !');
            }
            else if($authUser->status == 0) {
                Auth::login($authUser);
                return redirect()->route('client.home');
            }
            else {
                return redirect()->route('client.home')->with('error','Error !');
            }
        }
    }
    public function logout()
    {
        Auth::logout();
        return redirect()->refresh();
    }
    public function sendMail(ForgotPass $request)
    {
        $user = User::where('email', $request->email)->firstOrFail();
        PasswordReset::where('email', $user->email)->delete();
        $passwordReset = PasswordReset::create([
            'email' => $user->email,
            'token' => Str::random(50),
        ]);
        if ($passwordReset) {
            $user->notify(new ResetPasswordRequest($passwordReset->token));
        }
        return redirect()->route('auth.forgot')->with('success','We have e-mailed your password reset link!');
    }
    public function reset_pass($token){
        $passwordReset = PasswordReset::where('token', $token)->first();
        if($passwordReset){
            return view('auth.reset',compact('token'));
        }
        else {
            return redirect()->route('auth.forgot')->with('error','Error !');
        }
    }
    public function reset(Request $request)
    {
        $passwordReset = PasswordReset::where('token',$request->token)->first();
        if (Carbon::parse($passwordReset->updated_at)->addMinutes(10)->isPast()) {
            $passwordReset->delete();
            return redirect()->route('auth.forgot')->with('error','This password reset token is invalid.');
        }else {
            $user = User::where('email', $passwordReset->email)->first();
            $user->password = Hash::make($request->new_password);
            $user->save();
            $passwordReset->delete();
            return redirect()->route('auth.login')->with('success','Password reset successfully !');
        }
    }
}
