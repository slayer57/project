<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\ForgetPasswordRequest;
use App\Http\Requests\Frontend\StoreRegisterRequest;
use App\Mail\ForgetPassword;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;


class AuthController extends Controller
{
    public function login()
    {
        if (Auth::check()) {
            return view('frontend.user.dashboard');
        }

        Session::put('url.intended', URL::previous());
        return view('frontend.auth.login');
    }

    public function loginCheck(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return Redirect::to(Session::get('url.intended'));
            // return redirect()->route('mydashboard');
        }

        return redirect()->back()->with('error', 'Invalid Email/Password');
    }

    public function register()
    {
        if (Auth::check()) {
            return view('frontend.user.dashboard');
        }
        return view('frontend.auth.register');
    }

    public function storeRegister(StoreRegisterRequest $request)
    {
        $input = $request->except('password', 'user_type');
        $input['password'] = $request->password;
        $input['user_type'] = 'User';
        $user = User::create($input);
        Auth::login($user);
        return redirect()->route('mydashboard');
    }

    public function logout()
    {
        Session::flush();
        Auth::logout();
        return redirect()->route('home');
    }

    public function redirectToProvider()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function handleProviderCallback()
    {
        try {

            $user = Socialite::driver('facebook')->user();

            $finduser = User::where('facebook_id', $user->id)->first();

            $name = explode(' ', $user->name);

            if ($finduser) {

                Auth::login($finduser);

                // return redirect()->route('mydashboard');
                return Redirect::to(Session::get('url.intended'));
            } else {
                $newUser = User::create([
                    'first_name' => $name[0] ?? NULL,
                    'last_name' => $name[1] ?? NULL,
                    'email' => $user->email,
                    'facebook_id' => $user->id,
                    'password' => 'password',
                    'user_type' => 'User'
                ]);

                Auth::login($newUser);
                // return redirect()->route('mydashboard');
                return Redirect::to(Session::get('url.intended'));
            }
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }

    public function redirectToProviderGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleProviderCallbackGoogle()
    {
        try {
            $user = Socialite::driver('google')->user();

            $finduser = User::where('google_id', $user->id)->first();

            $name = explode(' ', $user->name);

            if ($finduser) {

                Auth::login($finduser);
                // return redirect()->route('mydashboard');
                return Redirect::to(Session::get('url.intended'));
            } else {
                $newUser = User::create([
                    'first_name' => $name[0] ?? NULL,
                    'last_name' => $name[1] ?? NULL,
                    'email' => $user->email,
                    'google_id' => $user->id,
                    'password' => 'password',
                    'user_type' => 'User'
                ]);

                Auth::login($newUser);

                // return redirect()->route('mydashboard');
                return Redirect::to(Session::get('url.intended'));
            }
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }

    public function forgotPassword()
    {
        return view('frontend.auth.forgot-password');
    }

    public function sendResetLink(ForgetPasswordRequest $request)
    {
        $userExist = User::where('email', $request->email)->where('user_type', 'User')->first();
        if ($userExist) {
            $randomString = Str::random(30);
            $userExist->update(['remember_token' => $randomString]);
            Mail::to($userExist->email)->send(new ForgetPassword($randomString));
            return redirect()->route('login')->with('success', 'Email sent. Please check your valid email for further process');
        } else {
            return redirect()->back()->with('error', 'Invalid Email Address');
        }
    }

    public function resetPasswordForm($token)
    {
        return view('frontend.auth.reset-form', compact('token'));
    }

    public function updateResetpassword(Request $request)
    {
        $request->validate([
            'new_password' => 'required|min:6',
            'new_confirm_password' => ['same:new_password'],
        ]);

        $existUser = User::where('remember_token', $request->token)->first();
        $existUser->update(['password' => $request->new_password]);
        return redirect()->route('login')->with('success', 'Password change successfully! You can login with new password');
    }
}
