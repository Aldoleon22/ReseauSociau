<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login'); 
    }
    public function logout()
    {
        Auth::logout();
        return to_route('auth.login');
    }

    public function doLogin(LoginRequest $request)
    {
       $credentials = $request->validated();
        
       if(Auth::attempt($credentials)){
        $request->session()->regenerate();
        return redirect()->intended(route('blog.index'));
       }
       return to_route('auth.login')->withErrors([
        'email' => "Email inalide"
       ])->onlyInput('email');
    }
}

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        $user = $this->create($request->all());

        Auth::login($user);

        return redirect()->route('auth.login');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
    public function show()
    {
        $user = Auth::user();
        return view('profil', compact('user'));
    }
    public function friends()
    {
        $user = Auth::user();
        $friends = $user->friends; 
        return view('users.friend_user', compact('friends_user'));
    }
}
