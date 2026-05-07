@extends('layouts.app')
@section('title', 'Новости')
@section('page-title', 'Новости')
@section('content')
@if($news->isEmpty())
    <div class="card"><div class="empty-state">Новостей пока нет</div></div>
@else
<div style="display:flex;flex-direction:column;gap:16px">
    @foreach($news as $item)
    <a href="{{ route('news.show', $item) }}" style="text-decoration:none;color:inherit;display:block;background:#fff;border:1px solid #e2e8f0;border-radius:12px;padding:24px;transition:box-shadow 0.15s" onmouseover="this.style.boxShadow='0 4px 12px rgba(0,0,0,0.08)'" onmouseout="this.style.boxShadow=''">
        <div style="font-size:0.8rem;color:#94a3b8;margin-bottom:8px">{{ $item->created_at->format('d.m.Y') }}</div>
        <div style="font-size:1.1rem;font-weight:600;color:#1e293b;margin-bottom:8px">{{ $item->title }}</div>
        @if($item->content)
        <div style="font-size:0.875rem;color:#64748b;overflow:hidden;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical">{{ Str::limit(strip_tags($item->content), 180) }}</div>
        @endif
        <div style="margin-top:12px;font-size:0.8rem;color:#2563eb;font-weight:500">Читать далее →</div>
    </a>
    @endforeach
</div>
@endif
@endsection