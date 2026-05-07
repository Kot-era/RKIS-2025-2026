@extends('layouts.app')
@section('title', 'Добавить пользователя')
@section('page-title', 'Добавить пользователя')
@section('content')
<div class="card" style="max-width:700px">
    <form method="POST" action="{{ route('admin.users.store') }}">
        @csrf
        <div class="grid-2">
            <div class="form-group">
                <label class="form-label">Фамилия *</label>
                <input type="text" name="last_name" class="form-control" value="{{ old('last_name') }}" required>
                @error('last_name')<div class="form-error">{{ $message }}</div>@enderror
            </div>
            <div class="form-group">
                <label class="form-label">Имя *</label>
                <input type="text" name="first_name" class="form-control" value="{{ old('first_name') }}" required>
                @error('first_name')<div class="form-error">{{ $message }}</div>@enderror
            </div>
        </div>
        <div class="form-group">
            <label class="form-label">Отчество</label>
            <input type="text" name="patronymic" class="form-control" value="{{ old('patronymic') }}">
        </div>
        <div class="grid-2">
            <div class="form-group">
                <label class="form-label">Логин *</label>
                <input type="text" name="login" class="form-control" value="{{ old('login') }}" required>
                @error('login')<div class="form-error">{{ $message }}</div>@enderror
            </div>
            <div class="form-group">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" value="{{ old('email') }}">
                @error('email')<div class="form-error">{{ $message }}</div>@enderror
            </div>
        </div>
        <div class="grid-2">
            <div class="form-group">
                <label class="form-label">Пароль *</label>
                <input type="password" name="password" class="form-control" required>
                @error('password')<div class="form-error">{{ $message }}</div>@enderror
            </div>
            <div class="form-group">
                <label class="form-label">Роль *</label>
                <select name="role" class="form-control" required id="roleSelect" onchange="toggleFields()">
                    <option value="">— выберите роль —</option>
                    <option value="student" {{ old('role') === 'student' ? 'selected' : '' }}>Студент</option>
                    <option value="teacher" {{ old('role') === 'teacher' ? 'selected' : '' }}>Преподаватель</option>
                    <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>Администратор</option>
                </select>
                @error('role')<div class="form-error">{{ $message }}</div>@enderror
            </div>
        </div>
        <div id="studentFields" style="display:none">
            <div class="grid-2">
                <div class="form-group"><label class="form-label">Группа</label><input type="text" name="group_name" class="form-control" value="{{ old('group_name') }}"></div>
                <div class="form-group"><label class="form-label">Курс</label><input type="number" name="course" class="form-control" value="{{ old('course') }}" min="1" max="6"></div>
            </div>
            <div class="grid-2">
                <div class="form-group"><label class="form-label">Код специальности</label><input type="text" name="specialty_code" class="form-control" value="{{ old('specialty_code') }}"></div>
                <div class="form-group"><label class="form-label">Специальность</label><input type="text" name="specialty_name" class="form-control" value="{{ old('specialty_name') }}"></div>
            </div>
        </div>
        <div id="teacherFields" style="display:none">
            <div class="grid-2">
                <div class="form-group"><label class="form-label">Предмет</label><input type="text" name="subject" class="form-control" value="{{ old('subject') }}"></div>
                <div class="form-group"><label class="form-label">Кафедра</label><input type="text" name="department" class="form-control" value="{{ old('department') }}"></div>
            </div>
        </div>
        <div style="display:flex;gap:12px;margin-top:8px">
            <button type="submit" class="btn btn-primary">Создать</button>
            <a href="{{ route('admin.index') }}" class="btn btn-secondary">Отмена</a>
        </div>
    </form>
</div>
<script>
function toggleFields() {
    const r = document.getElementById('roleSelect').value;
    document.getElementById('studentFields').style.display = r === 'student' ? 'block' : 'none';
    document.getElementById('teacherFields').style.display = r === 'teacher' ? 'block' : 'none';
}
</script>
@endsection