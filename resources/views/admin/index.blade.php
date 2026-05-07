@extends('layouts.app')
@section('title', 'Панель управления')
@section('page-title', 'Панель управления')
@section('content')

<div class="grid-4" style="margin-bottom:24px">
    <div class="stat-card">
        <div class="stat-label">Всего пользователей</div>
        <div class="stat-value">{{ $stats['users'] }}</div>
    </div>
    <div class="stat-card">
        <div class="stat-label">Студентов</div>
        <div class="stat-value" style="color:#2563eb">{{ $stats['students'] }}</div>
    </div>
    <div class="stat-card">
        <div class="stat-label">Преподавателей</div>
        <div class="stat-value" style="color:#059669">{{ $stats['teachers'] }}</div>
    </div>
    <div class="stat-card">
        <div class="stat-label">Новостей</div>
        <div class="stat-value" style="color:#7c3aed">{{ $stats['news'] }}</div>
    </div>
</div>

<div class="card">
    <div class="section-header">
        <div class="section-title">Пользователи</div>
        <a href="{{ route('admin.users.create') }}" class="btn btn-primary btn-sm">+ Добавить пользователя</a>
    </div>
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>Фамилия Имя</th>
                    <th>Логин</th>
                    <th>Email</th>
                    <th>Роль</th>
                    <th>Группа / Предмет</th>
                    <th>Действия</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                <tr>
                    <td>{{ $user->last_name }} {{ $user->first_name }} {{ $user->patronymic }}</td>
                    <td style="font-family:monospace;font-size:0.8rem">{{ $user->login }}</td>
                    <td style="font-size:0.8rem;color:#64748b">{{ $user->email ?? '—' }}</td>
                    <td>
                        @if($user->role === 'student')
                            <span class="badge-role badge-student">Студент</span>
                        @elseif($user->role === 'teacher')
                            <span class="badge-role badge-teacher">Преподаватель</span>
                        @else
                            <span class="badge-role badge-admin">Администратор</span>
                        @endif
                    </td>
                    <td style="font-size:0.8rem;color:#64748b">{{ $user->group_name ?? $user->subject ?? '—' }}</td>
                    <td>
                        <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-secondary btn-sm">Изменить</a>
                        <form method="POST" action="{{ route('admin.users.destroy', $user) }}" style="display:inline" onsubmit="return confirm('Удалить пользователя {{ $user->last_name }}?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Удалить</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" class="empty-state">Пользователи не найдены</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="card">
    <div class="section-header">
        <div class="section-title">Новости</div>
    </div>
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>Заголовок</th>
                    <th>Дата</th>
                    <th>Статус</th>
                    <th>Действия</th>
                </tr>
            </thead>
            <tbody>
                @forelse($news as $item)
                <tr>
                    <td>{{ $item->title }}</td>
                    <td style="font-size:0.8rem;color:#64748b">{{ $item->created_at->format('d.m.Y') }}</td>
                    <td>
                        @if($item->is_published)
                            <span class="badge-role badge-teacher">Опубликовано</span>
                        @else
                            <span class="badge-role" style="background:#f1f5f9;color:#64748b">Скрыто</span>
                        @endif
                    </td>
                    <td>
                        <form method="POST" action="{{ route('admin.news.toggle', $item) }}" style="display:inline">
                            @csrf
                            <button type="submit" class="btn btn-secondary btn-sm">{{ $item->is_published ? 'Скрыть' : 'Опубликовать' }}</button>
                        </form>
                        <form method="POST" action="{{ route('admin.news.destroy', $item) }}" style="display:inline" onsubmit="return confirm('Удалить новость?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Удалить</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="4" class="empty-state">Новостей пока нет</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div style="margin-top:16px;text-align:right">
    <form method="POST" action="{{ route('admin.logout') }}" style="display:inline">
        @csrf
        <button type="submit" class="btn btn-secondary btn-sm">Выйти из панели</button>
    </form>
</div>
@endsection