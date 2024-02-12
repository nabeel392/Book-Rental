<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Contracts\Auth\Guard;


class AuthController extends Controller
{

    protected $guard;

    public function __construct(Guard $guard)
    {
        $this->guard = $guard;
    }

    protected function validator(array $data)
{
    return Validator::make($data, [
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'password' => ['required', 'string', 'min:8', 'confirmed'],
        'image' => ['nullable', 'image', 'max:2048'],
    ]);
}

public function showLoginForm()
{
    return view('auth.login');
}

public function showRegistrationForm()
{
    return view('auth.register');
}


    public function login(Request $request)
{
    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        return redirect()->intended('/');
    }

    return back()->withErrors(['email' => 'Invalid email or password']);
}

public function register(Request $request)
{
    $this->validator($request->all())->validate();

    $imagePath = null;

    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $imageName = Str::random(20) . '.' . $image->getClientOriginalExtension();

        $imagePath = $image->move(public_path('images'), $imageName);
    }

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'image' => $imageName,
    ]);

    Auth::login($user);

    return redirect()
        ->route('home')
        ->with('success', 'Registration successful. You are logged in.');
}


public function logout(Request $request)
{
    Auth::logout();

    return redirect('/');
}

}
