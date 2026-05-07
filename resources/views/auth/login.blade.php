<!DOCTYPE html>
<html lang="ru">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0,viewport-fit=cover">
<title>&#1042;&#1093;&#1086;&#1076; &mdash; &#1040;&#1090;&#1090;&#1077;&#1085;&#1076;&#1086;&#1057;&#1090;&#1091;&#1076;</title>
<style>
*{margin:0;padding:0;box-sizing:border-box}
:root{--accent:#2563eb;--accent2:#7c3aed}
body{min-height:100vh;display:flex;align-items:center;justify-content:center;background:linear-gradient(135deg,#0f172a 0%,#1e3a8a 40%,#312e81 100%);font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,sans-serif;position:relative;overflow:hidden}
.blob{position:absolute;border-radius:50%;filter:blur(80px);opacity:.25;animation:bm 8s ease-in-out infinite alternate}
.b1{width:500px;height:500px;background:#3b82f6;top:-150px;left:-150px}
.b2{width:400px;height:400px;background:#7c3aed;bottom:-100px;right:-100px;animation-delay:2s}
.b3{width:300px;height:300px;background:#06b6d4;top:50%;left:50%;animation-delay:4s}
@keyframes bm{from{transform:scale(1)}to{transform:scale(1.15) translate(30px,20px)}}
.pts{position:absolute;inset:0;overflow:hidden;pointer-events:none}
.pt{position:absolute;width:4px;height:4px;background:rgba(255,255,255,.3);border-radius:50%;animation:fl linear infinite}
@keyframes fl{0%{transform:translateY(100vh) rotate(0);opacity:0}10%{opacity:1}90%{opacity:1}100%{transform:translateY(-100px) rotate(720deg);opacity:0}}
.card{position:relative;z-index:10;background:rgba(255,255,255,.08);backdrop-filter:blur(24px);-webkit-backdrop-filter:blur(24px);border:1px solid rgba(255,255,255,.18);border-radius:32px;padding:48px 44px;width:100%;max-width:420px;box-shadow:0 32px 80px rgba(0,0,0,.4);animation:su .6s cubic-bezier(.16,1,.3,1) both}
@keyframes su{from{opacity:0;transform:translateY(40px) scale(.97)}to{opacity:1;transform:translateY(0) scale(1)}}
.logo{display:flex;align-items:center;gap:14px;margin-bottom:36px;justify-content:center}
.logo-icon{width:52px;height:52px;border-radius:16px;background:linear-gradient(135deg,var(--accent),var(--accent2));display:flex;align-items:center;justify-content:center;box-shadow:0 8px 24px rgba(37,99,235,.5);animation:lp .6s .2s cubic-bezier(.34,1.56,.64,1) both}
.logo-icon svg{width:28px;height:28px;fill:none;stroke:#fff;stroke-width:2;stroke-linecap:round}
@keyframes lp{from{opacity:0;transform:scale(0) rotate(-20deg)}to{opacity:1;transform:scale(1) rotate(0)}}
.logo-text{font-size:22px;font-weight:800;color:#fff;letter-spacing:-.5px}
.logo-text span{background:linear-gradient(135deg,#60a5fa,#c084fc);-webkit-background-clip:text;-webkit-text-fill-color:transparent}
.heading{text-align:center;margin-bottom:32px;animation:fu .5s .25s both}
@keyframes fu{from{opacity:0;transform:translateY(16px)}to{opacity:1;transform:translateY(0)}}
.heading h1{font-size:26px;font-weight:800;color:#fff;margin-bottom:6px}
.heading p{font-size:14px;color:rgba(255,255,255,.55);font-weight:500}
.alert{padding:12px 16px;border-radius:12px;margin-bottom:20px;font-size:13px;font-weight:600;display:flex;align-items:center;gap:8px;animation:fu .4s ease both}
.ae{background:rgba(239,68,68,.15);border:1px solid rgba(239,68,68,.35);color:#fca5a5}
.as{background:rgba(34,197,94,.15);border:1px solid rgba(34,197,94,.35);color:#86efac}
form{animation:fu .5s .35s both}
.field{margin-bottom:18px}
.field label{display:block;font-size:12px;font-weight:700;color:rgba(255,255,255,.6);margin-bottom:8px;text-transform:uppercase;letter-spacing:.08em}
.iw{position:relative}
.ii{position:absolute;left:14px;top:50%;transform:translateY(-50%);color:rgba(255,255,255,.4);pointer-events:none;display:flex;align-items:center}
.ii svg{width:18px;height:18px;stroke:currentColor;fill:none;stroke-width:2;stroke-linecap:round}
.field input{width:100%;padding:14px 16px 14px 44px;background:rgba(255,255,255,.08);border:1px solid rgba(255,255,255,.15);border-radius:14px;color:#fff;font-size:15px;font-weight:500;outline:none;transition:all .25s;font-family:inherit}
.field input::placeholder{color:rgba(255,255,255,.3)}
.field input:focus{border-color:rgba(96,165,250,.6);background:rgba(255,255,255,.12);box-shadow:0 0 0 4px rgba(37,99,235,.2)}
.field input.err{border-color:rgba(239,68,68,.5);box-shadow:0 0 0 3px rgba(239,68,68,.15)}
.ferr{font-size:12px;color:#fca5a5;margin-top:6px;padding-left:4px}
.btn{width:100%;padding:16px;margin-top:8px;background:linear-gradient(135deg,var(--accent),var(--accent2));color:#fff;font-size:16px;font-weight:700;border:none;border-radius:14px;cursor:pointer;transition:all .25s;letter-spacing:.02em;box-shadow:0 8px 24px rgba(37,99,235,.4);position:relative;overflow:hidden}
.btn:hover{transform:translateY(-2px);box-shadow:0 12px 32px rgba(37,99,235,.5)}
.btn:active{transform:translateY(0)}
.btn::after{content:'';position:absolute;inset:0;background:linear-gradient(rgba(255,255,255,.15),transparent);border-radius:inherit}
.foot{text-align:center;margin-top:28px;font-size:12px;color:rgba(255,255,255,.3);animation:fu .5s .5s both}
.foot a{color:rgba(96,165,250,.7);text-decoration:none;font-weight:600}
@media(max-width:480px){.card{padding:36px 24px;border-radius:24px;margin:16px}.heading h1{font-size:22px}}
</style>
</head>
<body>
<div class="blob b1"></div><div class="blob b2"></div><div class="blob b3"></div>
<div class="pts" id="pts"></div>
<div class="card">
  <div class="logo">
    <div class="logo-icon">
      <svg viewBox="0 0 24 24"><path d="M12 3L2 9l10 6 10-6-10-6z"/><path d="M2 17l10 6 10-6"/><path d="M2 13l10 6 10-6"/></svg>
    </div>
    <div class="logo-text">&#1040;&#1090;&#1077;&#1085;&#1076;&#1086;<span>&#1057;&#1090;&#1091;&#1076;</span></div>
  </div>
  <div class="heading">
    <h1>&#1057; &#1074;&#1086;&#1079;&#1074;&#1088;&#1072;&#1097;&#1077;&#1085;&#1080;&#1077;&#1084;!</h1>
    <p>&#1042;&#1086;&#1081;&#1076;&#1080;&#1090;&#1077; &#1074; &#1089;&#1074;&#1086;&#1081; &#1072;&#1082;&#1072;&#1091;&#1085;&#1090;</p>
  </div>
  @if(session('error'))
    <div class="alert ae">&#9888; {{ session('error') }}</div>
  @endif
  @if(session('success'))
    <div class="alert as">&#10003; {{ session('success') }}</div>
  @endif
  <form method="POST" action="{{ route('login') }}">
    @csrf
    <div class="field">
      <label>&#1051;&#1086;&#1075;&#1080;&#1085;</label>
      <div class="iw">
        <div class="ii"><svg viewBox="0 0 24 24"><circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/></svg></div>
        <input type="text" name="login" autocomplete="username" placeholder="&#1042;&#1074;&#1077;&#1076;&#1080;&#1090;&#1077; &#1083;&#1086;&#1075;&#1080;&#1085;" value="{{ old('login') }}" class="{{ $errors->has('login') ? 'err' : '' }}" required autofocus>
      </div>
      @error('login')<div class="ferr">{{ $message }}</div>@enderror
    </div>
    <div class="field">
      <label>&#1055;&#1072;&#1088;&#1086;&#1083;&#1100;</label>
      <div class="iw">
        <div class="ii"><svg viewBox="0 0 24 24"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0110 0v4"/></svg></div>
        <input type="password" name="password" autocomplete="current-password" placeholder="&#1042;&#1074;&#1077;&#1076;&#1080;&#1090;&#1077; &#1087;&#1072;&#1088;&#1086;&#1083;&#1100;" class="{{ $errors->has('password') ? 'err' : '' }}" required>
      </div>
      @error('password')<div class="ferr">{{ $message }}</div>@enderror
    </div>
    <button type="submit" class="btn">&#1042;&#1086;&#1081;&#1090;&#1080; &rarr;</button>
  </form>
  <div class="foot">&#1057;&#1080;&#1089;&#1090;&#1077;&#1084;&#1072; &#1091;&#1087;&#1088;&#1072;&#1074;&#1083;&#1077;&#1085;&#1080;&#1103; &#1087;&#1086;&#1089;&#1077;&#1097;&#1072;&#1077;&#1084;&#1086;&#1089;&#1090;&#1100;&#1102; &mdash; <a href="https://attendostud.pro">attendostud.pro</a></div>
</div>
<script>
const c=document.getElementById('pts');
for(let i=0;i<18;i++){const p=document.createElement('div');p.className='pt';p.style.cssText='left:'+Math.random()*100+'%;width:'+(2+Math.random()*4)+'px;height:'+(2+Math.random()*4)+'px;animation-duration:'+(8+Math.random()*12)+'s;animation-delay:'+(Math.random()*10)+'s';c.appendChild(p);}
</script>
</body>
</html>