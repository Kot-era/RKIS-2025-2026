<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (Auth::check()) return redirect()->route('dashboard');
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'login'    => 'required|string',
            'password' => 'required|string',
        ], [
            'login.required'    => 'Введите логин',
            'password.required' => 'Введите пароль',
        ]);

        $user = User::where('login', $request->login)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return back()->withErrors(['login' => 'Неверный логин или пароль'])->withInput();
        }

        Auth::login($user, $request->boolean('remember'));

        return redirect()->intended(route('dashboard'));
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'login'    => 'required|string|unique:users|max:50',
            'password' => 'required|string|min:6|confirmed',
            'role'     => 'required|in:student,teacher',
            'group'    => 'nullable|string|max:50',
        ], [
            'name.required'      => 'Введите имя',
            'login.required'     => 'Введите логин',
            'login.unique'       => 'Этот логин уже занят',
            'password.required'  => 'Введите пароль',
            'password.min'       => 'Пароль минимум 6 символов',
            'password.confirmed' => 'Пароли не совпадают',
        ]);

        if ($request->role === 'teacher') {
            if (!Auth::check() || Auth::user()->role !== 'teacher') {
                return back()->withErrors(['role' => 'Только преподаватель может добавить другого преподавателя'])->withInput();
            }
        }

        $user = User::create([
            'name'     => $request->name,
            'login'    => $request->login,
            'password' => Hash::make($request->password),
            'role'     => $request->role,
            'group'    => $request->group,
            'avatar'   => null,
        ]);

        if ($request->role === 'student') {
            Auth::login($user);
            return redirect()->route('dashboard')->with('success', 'Добро пожаловать, ' . $user->name . '!');
        }

        return redirect()->route('login')->with('success', 'Преподаватель успешно добавлен');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')->with('success', 'Вы вышли из системы');
    }

    public function dashboard()
    {
        return view('dashboard', ['user' => Auth::user()]);
    }
}