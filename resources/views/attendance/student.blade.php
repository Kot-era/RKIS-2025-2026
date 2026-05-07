@extends('layouts.app')
@section('title','Посещаемость')
@section('content')
<div class="page-header">
    <h1 class="page-title">Моя посещаемость</h1>
</div>

@if(count($data) === 0)
<div class="card"><div class="card-body" style="text-align:center;color:#6b7280;">Данные о посещаемости отсутствуют</div></div>
@else
<div class="card" style="margin-bottom:1rem;">
    <div class="card-body" style="display:flex;gap:2rem;flex-wrap:wrap;">
        <div><span style="font-size:1.5rem;font-weight:700;color:#1f2937;">{{ $total_absent }}</span><br><span style="color:#6b7280;font-size:.85rem;">Всего пропусков</span></div>
        @if($total_absent > 10)
        <div style="background:#fee2e2;border:1px solid #fca5a5;border-radius:.5rem;padding:.5rem 1rem;color:#dc2626;font-weight:600;">
            ⚠ Превышен лимит пропусков (>10)
        </div>
        @endif
    </div>
</div>

<div class="card">
    <div class="card-body" style="padding:0;">
    <div class="table-wrap" style="overflow-x:auto;">
    <table style="width:100%;border-collapse:collapse;font-size:.9rem;">
        <thead>
        <tr style="background:#f3f4f6;">
            <th style="padding:.75rem 1rem;text-align:left;border-bottom:1px solid #e5e7eb;">Предмет</th>
            <th style="padding:.75rem 1rem;text-align:left;border-bottom:1px solid #e5e7eb;">Преподаватель</th>
            <th style="padding:.75rem;text-align:center;border-bottom:1px solid #e5e7eb;">Всего</th>
            <th style="padding:.75rem;text-align:center;border-bottom:1px solid #e5e7eb;">Присутствовал</th>
            <th style="padding:.75rem;text-align:center;border-bottom:1px solid #e5e7eb;">Опоздал</th>
            <th style="padding:.75rem;text-align:center;border-bottom:1px solid #e5e7eb;color:#dc2626;">Пропустил</th>
            <th style="padding:.75rem;text-align:center;border-bottom:1px solid #e5e7eb;">% посещ.</th>
        </tr>
        </thead>
        <tbody>
        @foreach($data as $row)
        <tr style="{{ $row['red'] ? 'background:#fee2e2;' : '' }} border-bottom:1px solid #f3f4f6;">
            <td style="padding:.75rem 1rem;font-weight:600;">
                {{ $row['subject'] }}
                @if($row['red'])
                <span style="display:inline-block;background:#dc2626;color:#fff;border-radius:9999px;font-size:.7rem;padding:.1rem .45rem;margin-left:.3rem;font-weight:700;">!</span>
                @endif
            </td>
            <td style="padding:.75rem 1rem;color:#6b7280;">{{ $row['teacher'] }}</td>
            <td style="padding:.75rem;text-align:center;">{{ $row['total'] }}</td>
            <td style="padding:.75rem;text-align:center;color:#16a34a;">{{ $row['present'] }}</td>
            <td style="padding:.75rem;text-align:center;color:#d97706;">{{ $row['late'] }}</td>
            <td style="padding:.75rem;text-align:center;font-weight:600;color:{{ $row['red'] ? '#dc2626' : ($row['absent']>5?'#f59e0b':'#374151') }};">{{ $row['absent'] }}</td>
            <td style="padding:.75rem;text-align:center;">
                <div style="display:flex;align-items:center;gap:.5rem;justify-content:center;">
                    <div style="flex:1;max-width:80px;height:8px;background:#e5e7eb;border-radius:4px;overflow:hidden;">
                        <div style="width:{{ $row['pct'] }}%;height:100%;background:{{ $row['pct']>=80?'#16a34a':($row['pct']>=60?'#d97706':'#dc2626') }};border-radius:4px;"></div>
                    </div>
                    <span style="font-weight:600;color:{{ $row['pct']>=80?'#16a34a':($row['pct']>=60?'#d97706':'#dc2626') }};">{{ $row['pct'] }}%</span>
                </div>
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
    </div>
    </div>
</div>
@endif
@endsection
