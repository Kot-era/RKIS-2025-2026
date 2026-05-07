<!DOCTYPE html><html lang="ru">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1">
<title>@yield('title','&#1040;&#1090;&#1090;&#1077;&#1085;&#1076;&#1086;&#1057;&#1090;&#1091;&#1076;')</title>
<link rel="icon" type="image/svg+xml" href="/favicon.svg">
<link rel="shortcut icon" href="/favicon.svg">
<style>
:root{--ac:#2563eb;--tx:#1e293b;--mu:#64748b;--bd:#e2e8f0;--bg:#f8fafc;--sw:260px;--bh:64px}
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
body{font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',sans-serif;background:var(--bg);color:var(--tx);line-height:1.5}
a{text-decoration:none;color:inherit}
.sidebar{position:fixed;top:0;left:0;bottom:0;width:var(--sw);background:#1e293b;display:flex;flex-direction:column;z-index:50;overflow-y:auto}
.sl{padding:20px 16px 16px;border-bottom:1px solid rgba(255,255,255,.08)}
.sl h1{font-size:1.2rem;font-weight:700;color:#fff}
.sl p{font-size:.75rem;color:rgba(255,255,255,.4);margin-top:2px}
.su{padding:16px;border-bottom:1px solid rgba(255,255,255,.08);display:flex;align-items:center;gap:10px}
.sua{width:36px;height:36px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:.8rem;font-weight:700;color:#fff;flex-shrink:0}
.su .nm{font-size:.875rem;font-weight:600;color:#f1f5f9}
.su .rl{font-size:.75rem;color:rgba(255,255,255,.4);margin-top:2px}
.snav{flex:1;padding:12px 8px}
.snav a{display:flex;align-items:center;gap:10px;padding:9px 12px;border-radius:8px;color:rgba(255,255,255,.6);font-size:.875rem;font-weight:500;transition:all .15s;margin-bottom:2px}
.snav a:hover{background:rgba(255,255,255,.06);color:#f1f5f9}
.snav a.active{background:#2563eb;color:#fff}
.sft{padding:12px 8px;border-top:1px solid rgba(255,255,255,.08)}
.sft form button{display:flex;align-items:center;gap:10px;width:100%;padding:9px 12px;border-radius:8px;background:none;border:none;color:rgba(255,255,255,.5);font-size:.875rem;font-weight:500;cursor:pointer;transition:all .15s;font-family:inherit}
.sft form button:hover{background:rgba(255,255,255,.06);color:#f1f5f9}
.main{margin-left:var(--sw);display:flex;flex-direction:column;min-height:100vh}
.topbar{display:none;background:#fff;border-bottom:1px solid var(--bd);padding:0 24px;height:60px;display:flex;align-items:center;justify-content:space-between;position:sticky;top:0;z-index:10}
.topbar h2{font-size:1.1rem;font-weight:600;color:var(--tx)}
.tbr{display:flex;align-items:center;gap:8px}
.topbadge{font-size:.75rem;background:#eff6ff;color:#2563eb;padding:4px 10px;border-radius:20px;font-weight:500}
.qrbtn{display:inline-flex;align-items:center;gap:6px;padding:7px 14px;background:linear-gradient(135deg,#6366f1,#8b5cf6);color:#fff;border-radius:10px;font-size:.8rem;font-weight:600;cursor:pointer;border:none;font-family:inherit;transition:opacity .15s}
.qrbtn:hover{opacity:.85}
.content{padding:24px;flex:1}
.alert{padding:12px 16px;border-radius:8px;margin-bottom:20px;font-size:.875rem;font-weight:500}
.alert-success{background:#f0fdf4;color:#166534;border:1px solid #bbf7d0}
.alert-error{background:#fef2f2;color:#991b1b;border:1px solid #fecaca}
.card{background:#fff;border-radius:12px;border:1px solid var(--bd);padding:24px;margin-bottom:24px}
.card-title{font-size:1rem;font-weight:600;color:var(--tx);margin-bottom:16px}
.table-wrap{overflow-x:auto}
table{width:100%;border-collapse:collapse;font-size:.875rem}
th{text-align:left;padding:10px 14px;font-weight:600;color:#64748b;border-bottom:2px solid var(--bd);white-space:nowrap}
td{padding:12px 14px;border-bottom:1px solid #f1f5f9;color:var(--tx);vertical-align:middle}
tr:last-child td{border-bottom:none}
tr:hover td{background:#f8fafc}
.btn{display:inline-flex;align-items:center;gap:6px;padding:9px 18px;border-radius:8px;font-size:.875rem;font-weight:500;cursor:pointer;border:none;text-decoration:none;transition:all .15s;font-family:inherit}
.btn-primary{background:#2563eb;color:#fff}.btn-primary:hover{background:#1d4ed8}
.btn-danger{background:#ef4444;color:#fff}.btn-danger:hover{background:#dc2626}
.btn-secondary{background:#f1f5f9;color:#475569;border:1px solid #e2e8f0}.btn-secondary:hover{background:#e2e8f0}
.btn-sm{padding:5px 12px;font-size:.8rem}
.badge-role{font-size:.7rem;padding:3px 8px;border-radius:20px;font-weight:600}
.badge-student{background:#eff6ff;color:#1d4ed8}
.badge-teacher{background:#f0fdf4;color:#166534}
.badge-admin{background:#fef3c7;color:#92400e}
.form-group{margin-bottom:20px}
.form-label{display:block;font-size:.875rem;font-weight:500;color:#374151;margin-bottom:6px}
.form-control{width:100%;padding:10px 14px;border:1px solid #d1d5db;border-radius:8px;font-size:.875rem;font-family:inherit;color:#1e293b;background:#fff;transition:border-color .15s;outline:none}
.form-control:focus{border-color:#2563eb;box-shadow:0 0 0 3px rgba(37,99,235,.12)}
.form-error{font-size:.8rem;color:#ef4444;margin-top:4px}
select.form-control{appearance:none;background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%2364748b' stroke-width='2'%3E%3Cpath d='M6 9l6 6 6-6'/%3E%3C/svg%3E");background-repeat:no-repeat;background-position:right 10px center;padding-right:36px}
.grid-2{display:grid;grid-template-columns:1fr 1fr;gap:20px}
.grid-3{display:grid;grid-template-columns:repeat(3,1fr);gap:20px}
.grid-4{display:grid;grid-template-columns:repeat(4,1fr);gap:20px}
.stat-card{background:#fff;border-radius:12px;border:1px solid var(--bd);padding:20px 24px;margin-bottom:24px}
.stat-label{font-size:.75rem;font-weight:500;color:#64748b;text-transform:uppercase;letter-spacing:.05em}
.stat-value{font-size:2rem;font-weight:700;color:#1e293b;margin-top:4px}
.stat-sub{font-size:.75rem;color:#94a3b8;margin-top:2px}
.section-header{display:flex;align-items:center;justify-content:space-between;margin-bottom:16px}
.section-title{font-size:1rem;font-weight:600;color:#1e293b}
.empty-state{text-align:center;padding:40px 20px;color:#94a3b8;font-size:.875rem}
.bnav{display:none;position:fixed;bottom:0;left:0;right:0;height:var(--bh);background:#fff;border-top:1px solid var(--bd);z-index:100;align-items:stretch}
.bnav a{flex:1;display:flex;flex-direction:column;align-items:center;justify-content:center;gap:3px;color:#94a3b8;font-size:.58rem;font-weight:600;text-decoration:none;transition:color .15s;text-transform:uppercase;letter-spacing:.04em;padding:6px 2px}
.bnav a.active,.bnav a:hover{color:#2563eb}
.bnav a svg{width:22px;height:22px}
.bqr{flex:1;display:flex;flex-direction:column;align-items:center;justify-content:center;gap:2px;cursor:pointer;padding:6px 2px;background:none;border:none;font-family:inherit}
.bqrw{width:44px;height:44px;background:linear-gradient(135deg,#6366f1,#8b5cf6);border-radius:14px;display:flex;align-items:center;justify-content:center;box-shadow:0 4px 12px rgba(99,102,241,.4)}
.bqrl{color:#6366f1;font-size:.58rem;font-weight:700;text-transform:uppercase;letter-spacing:.04em;margin-top:1px}
.qmodal{display:none;position:fixed;inset:0;z-index:200;background:rgba(0,0,0,.6);backdrop-filter:blur(4px);align-items:center;justify-content:center;padding:20px}
.qmodal.open{display:flex}
.qbox{background:#fff;border-radius:24px;padding:28px 20px;max-width:320px;width:100%;text-align:center;box-shadow:0 24px 64px rgba(0,0,0,.25);position:relative;animation:qIn .25s ease}
@keyframes qIn{from{transform:scale(.88);opacity:0}to{transform:scale(1);opacity:1}}
.qcl{position:absolute;top:12px;right:12px;background:#f1f5f9;border:none;border-radius:50%;width:32px;height:32px;cursor:pointer;display:flex;align-items:center;justify-content:center;color:#64748b;transition:background .15s}
.qcl:hover{background:#e2e8f0}
.qico{width:44px;height:44px;background:linear-gradient(135deg,#6366f1,#8b5cf6);border-radius:12px;margin:0 auto 10px;display:flex;align-items:center;justify-content:center}
.qtt{font-size:1rem;font-weight:700;color:#1e293b;margin-bottom:3px}
.qsb{font-size:.78rem;color:#64748b;margin-bottom:16px}
.qimw{background:#f8fafc;border-radius:16px;padding:14px;margin-bottom:14px;display:inline-block}
.qimw img{display:block;width:180px;height:180px;border-radius:8px}
.qnm{font-size:.95rem;font-weight:700;color:#1e293b;margin-bottom:2px}
.qmt{font-size:.75rem;color:#64748b}
.qhi{font-size:.68rem;color:#94a3b8;margin-top:10px}
@media(max-width:768px){
.sidebar{display:none}
.main{margin-left:0;padding-bottom:calc(var(--bh) + 4px)}
.topbar{display:none;padding:0 16px;height:54px}
.topbar h2{font-size:.95rem}
.content{padding:14px}
.bnav{display:flex}
.grid-2,.grid-3,.grid-4{grid-template-columns:1fr}
.card{padding:14px}.stat-card{padding:14px}
th,td{padding:8px 10px;font-size:.8rem}
.btn{padding:8px 14px;font-size:.82rem}
.topbadge{display:none}
}
@media(max-width:480px){.content{padding:10px}.card{padding:10px}table{font-size:.78rem}}
</style>
@stack('styles')
</head>
<body>
@auth
<nav class="sidebar">
<div class="sl"><h1>&#1040;&#1090;&#1090;&#1077;&#1085;&#1076;&#1086;&#1057;&#1090;&#1091;&#1076;</h1><p>&#1054;&#1073;&#1088;&#1072;&#1079;&#1086;&#1074;&#1072;&#1090;&#1077;&#1083;&#1100;&#1085;&#1099;&#1081; &#1087;&#1086;&#1088;&#1090;&#1072;&#1083;</p></div>
@php $u=auth()->user();$cl=['#6366f1','#8b5cf6','#ec4899','#f43f5e','#f97316','#10b981','#06b6d4','#3b82f6'];$bg=$cl[abs(crc32($u->login))%count($cl)];$ii=mb_strtoupper(mb_substr($u->last_name,0,1).mb_substr($u->first_name,0,1)); @endphp
<div class="su"><div class="sua" style="background:{{$bg}}">{{$ii}}</div><div><div class="nm">{{$u->last_name}} {{$u->first_name}}</div><div class="rl">{{$u->login}}</div></div></div>
<div class="snav">
<a href="{{route('dashboard')}}" class="{{request()->routeIs('dashboard')?'active':''}}"><svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/></svg>&#1043;&#1083;&#1072;&#1074;&#1085;&#1072;&#1103;</a>
<a href="{{route('schedule.index')}}" class="{{request()->routeIs('schedule.*')?'active':''}}"><svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>&#1056;&#1072;&#1089;&#1087;&#1080;&#1089;&#1072;&#1085;&#1080;&#1077;</a>
@if(auth()->user()->role==='student')
<a href="{{route('attendance.student')}}" class="{{request()->routeIs('attendance.student')?'active':''}}"><svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>&#1055;&#1086;&#1089;&#1077;&#1097;&#1072;&#1077;&#1084;&#1086;&#1089;&#1090;&#1100;</a>
@endif
@if(auth()->user()->role==='teacher')
<a href="{{route('attendance.teacher')}}" class="{{request()->routeIs('attendance.*')?'active':''}}"><svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>&#1055;&#1086;&#1089;&#1077;&#1097;&#1072;&#1077;&#1084;&#1086;&#1089;&#1090;&#1100;</a>
@endif
<a href="{{route('news.index')}}" class="{{request()->routeIs('news.*')?'active':''}}"><svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M4 6h16M4 10h16M4 14h10"/></svg>&#1053;&#1086;&#1074;&#1086;&#1089;&#1090;&#1080;</a>
<a href="{{route('schedule.index')}}" class="{{request()->routeIs('schedule.*')?'active':''}}"><svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M9 11l3 3L22 4"/><path d="M21 12v7a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2h11"/></svg>&#1055;&#1086;&#1089;&#1077;&#1097;&#1072;&#1077;&#1084;&#1086;&#1089;&#1090;&#1100;</a>
@if(auth()->user()->role==='student')<a href="{{route('settings.index')}}" class="{{request()->routeIs('settings.*')?'active':''}}"><svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/></svg>&#1055;&#1088;&#1086;&#1092;&#1080;&#1083;&#1100;</a>@endif
@if(auth()->user()->role==='admin')<a href="{{route('admin.index')}}" class="{{request()->routeIs('admin.*')?'active':''}}"><svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="3"/><path d="M12 2v2M12 20v2M2 12h2M20 12h2"/></svg>&#1040;&#1076;&#1084;&#1080;&#1085;&#1080;&#1089;&#1090;&#1088;&#1072;&#1094;&#1080;&#1103;</a>@endif
</div>
<div class="sft"><form method="POST" action="{{route('logout')}}">@csrf<button type="submit"><svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>&#1042;&#1099;&#1081;&#1090;&#1080;</button></form></div>
</nav>
@endauth
<div class="main">
@auth
@endauth
<div class="content">
@if(session('success'))<div class="alert alert-success">{{session('success')}}</div>@endif
@if(session('error'))<div class="alert alert-error">{{session('error')}}</div>@endif
@if(!empty($errors) && $errors->any())<div class="alert alert-error">@foreach($errors->all() as $e)<div>{{$e}}</div>@endforeach</div>@endif
@yield('content')
</div>
</div>
@auth
<nav class="bnav">
<a href="{{route('dashboard')}}" class="{{request()->routeIs('dashboard')?'active':''}}"><svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/></svg>&#1043;&#1083;&#1072;&#1074;&#1085;&#1072;&#1103;</a>
<a href="{{route('schedule.index')}}" class="{{request()->routeIs('schedule.*')?'active':''}}"><svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>&#1056;&#1072;&#1089;&#1087;&#1080;&#1089;&#1072;&#1085;&#1080;&#1077;</a>
@if(auth()->user()->role==='student')
<button class="bqr" onclick="document.getElementById('qrM').classList.add('open')"><div class="bqrw"><svg width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="#fff" stroke-width="2"><rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/><rect x="11" y="11" width="3" height="3"/><rect x="18" y="11" width="3" height="3"/><rect x="11" y="18" width="3" height="3"/><rect x="18" y="18" width="3" height="3"/></svg></div><span class="bqrl">QR</span></button>
@else
<a href="{{route('schedule.index')}}" class="{{request()->routeIs('schedule.*')?'active':''}}"><svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M9 11l3 3L22 4"/><path d="M21 12v7a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2h11"/></svg>&#1055;&#1086;&#1089;&#1077;&#1097;.</a>
@endif
@if(auth()->user()->role==="student')
<a href="{{route('attendance.student')}}" class="{{request()->routeIs('attendance.student')?'active':''}}"><svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>&#1055;&#1086;&#1089;&#1077;&#1097;&#1072;&#1077;&#1084;&#1086;&#1089;&#1090;&#1100;</a>
@endif
@if(auth()->user()->role==="teacher')
<a href="{{route('attendance.teacher')}}" class="{{request()->routeIs('attendance.*')?'active':''}}"><svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>&#1055;&#1086;&#1089;&#1077;&#1097;&#1072;&#1077;&#1084;&#1086;&#1089;&#1090;&#1100;</a>
@endif
<a href="{{route('news.index')}}" class="{{request()->routeIs('news.*')?'active':''}}"><svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M4 6h16M4 10h16M4 14h10"/></svg>&#1053;&#1086;&#1074;&#1086;&#1089;&#1090;&#1080;</a>
<a href="{{route('settings.index')}}" class="{{request()->routeIs('settings.*')?'active':''}}"><svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/></svg>&#1055;&#1088;&#1086;&#1092;&#1080;&#1083;&#1100;</a>
</nav>
@if(auth()->user()->role==='student')
@php $qu=auth()->user();$qd=urlencode('ATTENDOSTUD|'.($qu->last_name??'').' '.($qu->first_name??'').' '.($qu->middle_name??'').'|'.($qu->login??'').'|'.($qu->group_name??'').'|'.($qu->specialty_name??'')); @endphp
<div id="qrM" class="qmodal" onclick="if(event.target===this)this.classList.remove('open')">
<div class="qbox">
<button class="qcl" onclick="document.getElementById('qrM').classList.remove('open')"><svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg></button>
<div class="qico"><svg width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="#fff" stroke-width="2"><rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/><rect x="11" y="11" width="3" height="3"/><rect x="18" y="11" width="3" height="3"/><rect x="11" y="18" width="3" height="3"/><rect x="18" y="18" width="3" height="3"/></svg></div>
<div class="qtt">&#1055;&#1088;&#1086;&#1087;&#1091;&#1089;&#1082; &#1085;&#1072; &#1090;&#1077;&#1088;&#1088;&#1080;&#1090;&#1086;&#1088;&#1080;&#1102;</div>
<div class="qsb">&#1055;&#1088;&#1077;&#1076;&#1098;&#1103;&#1074;&#1080;&#1090;&#1077; &#1085;&#1072; &#1087;&#1086;&#1089;&#1090;&#1091; &#1086;&#1093;&#1088;&#1072;&#1085;&#1099; &#1050;&#1055;&#1055;</div>
<div class="qimw"><img src="https://api.qrserver.com/v1/create-qr-code/?size=200x200&color=1e293b&bgcolor=f8fafc&qzone=1&data={{$qd}}" alt="QR" loading="lazy"></div>
<div class="qnm">{{$qu->last_name}} {{$qu->first_name}} {{$qu->middle_name??''}}</div>
<div class="qmt">{{$qu->group_name}} &bull; {{$qu->specialty_name}}</div>
<div class="qhi">&#1057;&#1082;&#1072;&#1085;&#1080;&#1088;&#1091;&#1081;&#1090;&#1077; &#1076;&#1083;&#1103; &#1087;&#1086;&#1076;&#1090;&#1074;&#1077;&#1088;&#1078;&#1076;&#1077;&#1085;&#1080;&#1103; &#1083;&#1080;&#1095;&#1085;&#1086;&#1089;&#1090;&#1080;</div>
</div>
</div>
@endif
@endauth
</body></html>
