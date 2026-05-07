@extends('layouts.app')
@section('title','Посещаемость - преподаватель')
@section('content')
<div class="page-header">
    <h1 class="page-title">Отметка посещаемости</h1>
</div>

@if(session('success'))
<div style="background:#d1fae5;border:1px solid #6ee7b7;border-radius:.5rem;padding:.75rem 1rem;margin-bottom:1rem;color:#065f46;">
    {{ session('success') }}
</div>
@endif

@if($schedules->isEmpty())
<div class="card"><div class="card-body" style="text-align:center;color:#6b7280;">У вас нет закреплённых предметов</div></div>
@else
<div style="display:grid;gap:1rem;">
@foreach($schedules as $sch)
<div class="card">
    <div class="card-body" style="display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:1rem;">
        <div>
            <div style="font-weight:700;font-size:1rem;color:#1f2937;">{{ $sch->subject }}</div>
            <div style="color:#6b7280;font-size:.85rem;margin-top:.25rem;">Группа: {{ $sch->group_name }} &bull; Ауд. {{ $sch->room }}</div>
        </div>
        <form method="GET" action="{{ route('attendance.mark', $sch->id) }}" style="display:flex;gap:.5rem;align-items:center;">
            <input type="date" name="date" value="{{ date('Y-m-d') }}" style="border:1px solid #d1d5db;border-radius:.375rem;padding:.375rem .75rem;font-size:.9rem;">
            <button type="submit" style="background:linear-gradient(135deg,#6366f1,#2563eb);color:#fff;border:none;border-radius:.5rem;padding:.5rem 1rem;cursor:pointer;font-size:.9rem;font-weight:600;">
                Отметить
            </button>
        </form>
    </div>
</div>
@endforeach
</div>
@endif
@endsection
