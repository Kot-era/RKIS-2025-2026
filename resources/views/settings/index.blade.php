@extends('layouts.app')
@section('title', 'Настройки')
@section('page-title', 'Настройки профиля')
@section('content')
<div class="card" style="max-width:600px">
    <form method="POST" action="{{ route('settings.update') }}">
        @csrf
        <div class="grid-2">
            <div class="form-group">
                <label class="form-label">Фамилия</label>
                <input type="text" name="last_name" class="form-control" value="{{ old('last_name', $user->last_name) }}">
                @error('last_name')<div class="form-error">{{ $message }}</div>@enderror
            </div>
            <div class="form-group">
                <label class="form-label">Имя</label>
                <input type="text" name="first_name" class="form-control" value="{{ old('first_name', $user->first_name) }}">
                @error('first_name')<div class="form-error">{{ $message }}</div>@enderror
            </div>
        </div>
        <div class="form-group">
            <label class="form-label">Отчество</label>
            <input type="text" name="patronymic" class="form-control" value="{{ old('patronymic', $user->patronymic) }}">
        </div>
        <div class="form-group">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}">
            @error('email')<div class="form-error">{{ $message }}</div>@enderror
        </div>
        <div style="border-top:1px solid #e2e8f0;margin:24px 0 20px;padding-top:20px">
            <div style="font-size:0.9rem;font-weight:600;color:#1e293b;margin-bottom:16px">Смена пароля</div>
            <div class="form-group">
                <label class="form-label">Текущий пароль</label>
                <input type="password" name="current_password" class="form-control" placeholder="Введите текущий пароль">
                @error('current_password')<div class="form-error">{{ $message }}</div>@enderror
            </div>
            <div class="grid-2">
                <div class="form-group">
                    <label class="form-label">Новый пароль</label>
                    <input type="password" name="password" class="form-control" placeholder="Минимум 6 символов">
                    @error('password')<div class="form-error">{{ $message }}</div>@enderror
                </div>
                <div class="form-group">
                    <label class="form-label">Повторите пароль</label>
                    <input type="password" name="password_confirmation" class="form-control" placeholder="Повторите пароль">
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Сохранить изменения</button>
    </form>

<div style="margin-top:32px;padding-top:24px;border-top:1px solid #e2e8f0;">
    <form method="POST" action="{{route('logout')}}">
        @csrf
        <button type="submit" class="btn" style="background:#fee2e2;color:#dc2626;border:1px solid #fca5a5;width:100%;padding:12px;font-size:1rem;font-weight:600;border-radius:8px;cursor:pointer;">
            <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" style="vertical-align:middle;margin-right:8px;"><path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h6a2 2 0 012 2v1"/></svg>
            Выйти из аккаунта
        </button>
    </form>
</div>
</div>
@endsection