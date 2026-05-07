@extends('layouts.app')
@section('title', 'Расписание')
@section('page-title', 'Расписание')
@section('content')

@if(auth()->user()->role !== 'student')
<div class="card" style="margin-bottom:24px">
    <div class="card-title">Добавить занятие</div>
    <form method="POST" action="{{ route('schedule.store') }}">
        @csrf
        <div class="grid-3">
            <div class="form-group">
                <label class="form-label">Предмет *</label>
                <input type="text" name="subject" class="form-control" value="{{ old('subject') }}" required>
            </div>
            <div class="form-group">
                <label class="form-label">Группа *</label>
                <input type="text" name="group_name" class="form-control" value="{{ old('group_name') }}" required placeholder="Например: ИС-21">
            </div>
            <div class="form-group">
                <label class="form-label">Преподаватель</label>
                <select name="teacher_id" class="form-control">
                    <option value="">— не указан —</option>
                    @foreach($teachers as $teacher)
                    <option value="{{ $teacher->id }}" {{ old('teacher_id') == $teacher->id ? 'selected' : '' }}>{{ $teacher->last_name }} {{ $teacher->first_name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="grid-3">
            <div class="form-group">
                <label class="form-label">День недели *</label>
                <select name="day_of_week" class="form-control" required>
                    @foreach($days as $num => $name)
                    <option value="{{ $num }}" {{ old('day_of_week') == $num ? 'selected' : '' }}>{{ $name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label class="form-label">Начало *</label>
                <input type="time" name="time_start" class="form-control" value="{{ old('time_start') }}" required>
            </div>
            <div class="form-group">
                <label class="form-label">Конец *</label>
                <input type="time" name="time_end" class="form-control" value="{{ old('time_end') }}" required>
            </div>
        </div>
        <div class="grid-2">
            <div class="form-group">
                <label class="form-label">Номер пары *</label>
                <input type="number" name="lesson_number" class="form-control" value="{{ old('lesson_number', 1) }}" min="1" max="10" required>
            </div>
            <div class="form-group">
                <label class="form-label">Аудитория</label>
                <input type="text" name="room" class="form-control" value="{{ old('room') }}">
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Добавить</button>
    </form>
</div>
@endif

@php $grouped = $schedule->groupBy('day_of_week'); @endphp

@if($schedule->isEmpty())
    <div class="card"><div class="empty-state">Расписание пока не добавлено</div></div>
@else
    @foreach($days as $num => $name)
    @if($grouped->has($num))
    <div class="card" style="margin-bottom:16px">
        <div class="card-title">{{ $name }}</div>
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>Пара</th>
                        <th>Время</th>
                        <th>Предмет</th>
                        <th>Преподаватель</th>
                        <th>Группа</th>
                        <th>Аудитория</th>
                        @if(auth()->user()->role !== 'student')<th></th>@endif
                    </tr>
                </thead>
                <tbody>
                    @foreach($grouped[$num]->sortBy('lesson_number') as $item)
                    <tr>
                        <td style="font-weight:600;text-align:center;width:50px">{{ $item->lesson_number }}</td>
                        <td style="font-weight:600;white-space:nowrap">{{ $item->time_start }} – {{ $item->time_end }}</td>
                        <td>{{ $item->subject }}</td>
                        <td style="color:#64748b;font-size:0.85rem">
                            @if($item->teacher){{ $item->teacher->last_name }} {{ $item->teacher->first_name }}@else—@endif
                        </td>
                        <td style="color:#64748b">{{ $item->group_name }}</td>
                        <td style="color:#64748b">{{ $item->room ?? '—' }}</td>
                        @if(auth()->user()->role !== 'student')
                        <td>
                            <form method="POST" action="{{ route('schedule.destroy', $item) }}" onsubmit="return confirm('Удалить занятие?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Удалить</button>
                            </form>
                        </td>
                        @endif
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif
    @endforeach
@endif
@endsection