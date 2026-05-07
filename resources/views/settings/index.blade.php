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
</div>
@endsection