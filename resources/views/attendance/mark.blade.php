@extends('layouts.app')
@section('title','Отметить посещаемость')
@section('content')
<div class="page-header" style="display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:1rem;">
    <div>
        <h1 class="page-title">{{ $schedule->subject }}</h1>
        <p style="color:#6b7280;margin:0;">Группа: {{ $schedule->group_name }} &bull; {{ \Carbon\Carbon::parse($date)->format('d.m.Y') }}</p>
    </div>
    <a href="{{ route('attendance.teacher') }}" style="background:#f3f4f6;border:1px solid #e5e7eb;border-radius:.5rem;padding:.5rem 1rem;text-decoration:none;color:#374151;font-size:.9rem;">
        ← Назад
    </a>
</div>

<div class="card">
<div class="card-body" style="padding:0;">
<form method="POST" action="{{ route('attendance.store', $schedule->id) }}">
    @csrf
    <input type="hidden" name="date" value="{{ $date }}">

    @if($students->isEmpty())
    <div style="padding:2rem;text-align:center;color:#6b7280;">В группе нет студентов</div>
    @else
    <div style="overflow-x:auto;">
    <table style="width:100%;border-collapse:collapse;font-size:.9rem;">
        <thead>
        <tr style="background:#f3f4f6;">
            <th style="padding:.75rem 1rem;text-align:left;border-bottom:1px solid #e5e7eb;">Студент</th>
            <th style="padding:.75rem;text-align:center;border-bottom:1px solid #e5e7eb;color:#16a34a;">Присутствует</th>
            <th style="padding:.75rem;text-align:center;border-bottom:1px solid #e5e7eb;color:#d97706;">Опоздал</th>
            <th style="padding:.75rem;text-align:center;border-bottom:1px solid #e5e7eb;color:#dc2626;">Отсутствует</th>
        </tr>
        </thead>
        <tbody>
        @foreach($students as $student)
        @php $cur = $existing[$student->id] ?? 'present'; @endphp
        <tr style="border-bottom:1px solid #f3f4f6;">
            <td style="padding:.75rem 1rem;font-weight:500;">{{ $student->last_name }} {{ $student->first_name }}</td>
            <td style="padding:.75rem;text-align:center;">
                <input type="radio" name="status[{{ $student->id }}]" value="present" {{ $cur==='present'?'checked':'' }} style="accent-color:#16a34a;width:1.1rem;height:1.1rem;">
            </td>
            <td style="padding:.75rem;text-align:center;">
                <input type="radio" name="status[{{ $student->id }}]" value="late" {{ $cur==='late'?'checked':'' }} style="accent-color:#d97706;width:1.1rem;height:1.1rem;">
            </td>
            <td style="padding:.75rem;text-align:center;">
                <input type="radio" name="status[{{ $student->id }}]" value="absent" {{ $cur==='absent'?'checked':'' }} style="accent-color:#dc2626;width:1.1rem;height:1.1rem;">
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
    </div>
    <div style="padding:1rem;border-top:1px solid #e5e7eb;display:flex;justify-content:flex-end;gap:.75rem;">
        <a href="{{ route('attendance.teacher') }}" style="background:#f3f4f6;border:1px solid #e5e7eb;border-radius:.5rem;padding:.6rem 1.25rem;text-decoration:none;color:#374151;font-weight:500;">Отмена</a>
        <button type="submit" style="background:linear-gradient(135deg,#6366f1,#2563eb);color:#fff;border:none;border-radius:.5rem;padding:.6rem 1.5rem;cursor:pointer;font-weight:600;">Сохранить</button>
    </div>
    @endif
</form>
</div>
</div>
@endsection
