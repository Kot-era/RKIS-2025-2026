<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SettingsController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('settings.index', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'last_name'    => 'nullable|string|max:100',
            'first_name'   => 'nullable|string|max:100',
            'patronymic'   => 'nullable|string|max:100',
            'email'        => 'nullable|email|max:150|unique:users,email,' . $user->id,
            'password'     => 'nullable|string|min:6|confirmed',
            'current_password' => 'nullable|string',
        ], [
            'email.unique'    => 'Этот email уже используется.',
            'password.min'    => 'Пароль должен быть не менее 6 символов.',
            'password.confirmed' => 'Пароли не совпадают.',
        ]);

        if ($request->filled('current_password')) {
            if (!Hash::check($request->current_password, $user->password)) {
                return back()->withErrors(['current_password' => 'Неверный текущий пароль.']);
            }
            if ($request->filled('password')) {
                $user->password = Hash::make($request->password);
            }
        }

        if ($request->filled('last_name'))  $user->last_name  = $request->last_name;
        if ($request->filled('first_name')) $user->first_name = $request->first_name;
        if ($request->filled('patronymic')) $user->patronymic = $request->patronymic;
        if ($request->filled('email'))      $user->email      = $request->email;

        $user->save();

        return back()->with('success', 'Настройки профиля успешно сохранены.');
    }
}
