@extends('layouts.app')
@section('title', 'Редактировать пользователя')
@section('page-title', 'Редактировать пользователя')
@section('content')
<div class="card" style="max-width:700px">
    <div style="margin-bottom:20px">
        <span class="badge-role {{ $user->role === 'student' ? 'badge-student' : ($user->role === 'teacher' ? 'badge-teacher' : 'badge-admin') }}">
            {{ $user->role === 'student' ? 'Студент' : ($user->role === 'teacher' ? 'Преподаватель' : 'Администратор') }}
        </span>
        <span style="color:#64748b;font-size:0.875rem;margin-left:10px">{{ $user->last_name }} {{ $user->first_name }}</span>
    </div>
    <form method="POST" action="{{ route('admin.users.update', $user) }}">
        @csrf
        @method('PUT')
        <div class="grid-2">
            <div class="form-group">
                <label class="form-label">Фамилия *</label>
                <input type="text" name="last_name" class="form-control" value="{{ old('last_name', $user->last_name) }}" required>
                @error('last_name')<div class="form-error">{{ $message }}</div>@enderror
            </div>
            <div class="form-group">
                <label class="form-label">Имя *</label>
                <input type="text" name="first_name" class="form-control" value="{{ old('first_name', $user->first_name) }}" required>
                @error('first_name')<div class="form-error">{{ $message }}</div>@enderror
            </div>
        </div>
        <div class="form-group">
            <label class="form-label">Отчество</label>
            <input type="text" name="patronymic" class="form-control" value="{{ old('patronymic', $user->patronymic) }}">
        </div>
        <div class="grid-2">
            <div class="form-group">
                <label class="form-label">Логин *</label>
                <input type="text" name="login" class="form-control" value="{{ old('login', $user->login) }}" required>
                @error('login')<div class="form-error">{{ $message }}</div>@enderror
            </div>
            <div class="form-group">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}">
                @error('email')<div class="form-error">{{ $message }}</div>@enderror
            </div>
        </div>
        <div class="grid-2">
            <div class="form-group">
                <label class="form-label">Новый пароль <span style="color:#94a3b8;font-weight:400">(оставьте пустым)</span></label>
                <input type="password" name="password" class="form-control" placeholder="Оставьте пустым, если не меняете">
                @error('password')<div class="form-error">{{ $message }}</div>@enderror
            </div>
            <div class="form-group">
                <label class="form-label">Роль *</label>
                <select name="role" class="form-control" required id="roleSelect" onchange="toggleFields()">
                    <option value="student" {{ old('role', $user->role) === 'student' ? 'selected' : '' }}>Студент</option>
                    <option value="teacher" {{ old('role', $user->role) === 'teacher' ? 'selected' : '' }}>Преподаватель</option>
                    <option value="admin" {{ old('role', $user->role) === 'admin' ? 'selected' : '' }}>Администратор</option>
                </select>
                @error('role')<div class="form-error">{{ $message }}</div>@enderror
            </div>
        </div>
        <div id="studentFields">
            <div class="grid-2">
                <div class="form-group"><label class="form-label">Группа</label><input type="text" name="group_name" class="form-control" value="{{ old('group_name', $user->group_name) }}"></div>
                <div class="form-group"><label class="form-label">Курс</label><input type="number" name="course" class="form-control" value="{{ old('course', $user->course) }}" min="1" max="6"></div>
            </div>
            <div class="grid-2">
                <div class="form-group"><label class="form-label">Код специальности</label><input type="text" name="specialty_code" class="form-control" value="{{ old('specialty_code', $user->specialty_code) }}"></div>
                <div class="form-group"><label class="form-label">Специальность</label><input type="text" name="specialty_name" class="form-control" value="{{ old('specialty_name', $user->specialty_name) }}"></div>
            </div>
        </div>
        <div id="teacherFields">
            <div class="grid-2">
                <div class="form-group"><label class="form-label">Предмет</label><input type="text" name="subject" class="form-control" value="{{ old('subject', $user->subject) }}"></div>
                <div class="form-group"><label class="form-label">Кафедра</label><input type="text" name="department" class="form-control" value="{{ old('department', $user->department) }}"></div>
            </div>
        </div>
        <div style="display:flex;gap:12px;margin-top:8px">
            <button type="submit" class="btn btn-primary">Сохранить</button>
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
toggleFields();
</script>
@endsection