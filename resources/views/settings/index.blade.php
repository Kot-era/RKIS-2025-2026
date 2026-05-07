@extends('layouts.app')
@section('title', 'Настройки')
@section('page-title', 'Настройки профиля')
@section('content')
<div class="card" style="max-width:600px">
    <form method="POST" action="{{ route('settings.update') }}" enctype="multipart/form-data">
        @csrf

    {{-- Avatar --}}
    <div style="margin-bottom:24px;text-align:center;">
        @if($user->avatar)
            <img src="{{ Storage::url($user->avatar) }}" alt="Аватар"
                 style="width:100px;height:100px;border-radius:50%;object-fit:cover;border:3px solid #e2e8f0;margin-bottom:12px;display:block;margin-left:auto;margin-right:auto;">
        @else
            <div style="width:100px;height:100px;border-radius:50%;background:#e2e8f0;display:flex;align-items:center;justify-content:center;margin:0 auto 12px auto;">
                <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="#94a3b8" stroke-width="1.5"><circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/></svg>
            </div>
        @endif
        <label style="display:inline-block;cursor:pointer;background:#f1f5f9;border:1px solid #e2e8f0;border-radius:8px;padding:8px 16px;font-size:0.9rem;color:#475569;">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="vertical-align:middle;margin-right:4px;"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" y1="3" x2="12" y2="15"/></svg>
            Загрузить фото
            <input type="file" name="avatar" accept="image/*" style="display:none;" onchange="this.parentElement.querySelector('span') && (this.parentElement.querySelector('span').textContent = this.files[0].name)">
        </label>
    </div>
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