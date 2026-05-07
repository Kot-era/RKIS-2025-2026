@extends('layouts.app')
@section('title', $news->title)
@section('page-title', 'Новости')
@section('content')
<div class="card" style="max-width:800px">
    <a href="{{ route('news.index') }}" class="btn btn-secondary btn-sm" style="margin-bottom:20px">← Назад к новостям</a>
    <div style="font-size:0.85rem;color:#94a3b8;margin-bottom:10px">{{ $news->created_at->format('d F Y г.') }}</div>
    <h1 style="font-size:1.5rem;font-weight:700;color:#1e293b;margin-bottom:20px;line-height:1.3">{{ $news->title }}</h1>
    <div style="font-size:0.95rem;color:#374151;line-height:1.7">{!! nl2br(e($news->content)) !!}</div>
</div>
@endsection