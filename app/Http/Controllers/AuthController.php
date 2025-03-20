<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\UserCreateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\ProfileRequest;

class AuthController extends Controller
{
    public function login()
    {
        return inertia('Auth/Login');
    }
    public function loginSave(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');
        if (auth()->attempt($credentials, true)) {
            $request->session()->regenerate();
            return redirect()->intended(route('posts.index'))->with('success', 'Logged In Successfully');
        }
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function register()
    {
        return inertia('Auth/Register');
    }

    public function registerSave(UserCreateRequest $request)
    {
        $data = $request->validated();
        $user = User::create($data);

        auth()->login($user);

        return redirect()->intended(route('posts.index'))->with('success', 'Logged In Successfully');
    }
    public function logout(Request $request)
    {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')->with('success', 'Logged Out Successfully');
    }

    public function profile()
    {
        $user = auth()->user();
        return inertia('Auth/Profile', get_defined_vars());
    }

    public function profileSave(ProfileRequest $request)
    {
        $data = $request->validated();
        $data['email'] = auth()->user()->provider ? auth()->user()->email : $data['email'];
        $user = auth()->user();
        $user->update($request->validated());
        return redirect()->route('profile')->with('success', 'Profile Updated Successfully');
    }
}
