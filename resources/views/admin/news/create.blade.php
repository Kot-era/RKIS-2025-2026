<!DOCTYPE html>
<html lang="ru">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>&#1044;&#1086;&#1073;&#1072;&#1074;&#1080;&#1090;&#1100; &#1085;&#1086;&#1074;&#1086;&#1089;&#1090;&#1100; &mdash; AttendoStud</title>
<link rel="icon" type="image/svg+xml" href="/favicon.svg">
<style>
*{box-sizing:border-box;margin:0;padding:0}
body{font-family:system-ui,sans-serif;background:#f1f5f9;min-height:100vh;display:flex;align-items:center;justify-content:center;padding:20px}
.card{background:#fff;border-radius:16px;box-shadow:0 4px 24px rgba(0,0,0,.08);padding:36px;width:100%;max-width:640px}
.logo{display:flex;align-items:center;gap:10px;margin-bottom:28px}
.logo-icon{width:40px;height:40px;background:linear-gradient(135deg,#6366f1,#2563eb);border-radius:12px;display:flex;align-items:center;justify-content:center;color:#fff;font-weight:700;font-size:1rem}
.logo-text{font-size:1.1rem;font-weight:700;color:#1e293b}
h1{font-size:1.4rem;font-weight:700;color:#1e293b;margin-bottom:24px}
.form-group{margin-bottom:18px}
label{display:block;font-size:.85rem;font-weight:600;color:#475569;margin-bottom:6px}
input[type=text],textarea,select{width:100%;padding:10px 14px;border:1.5px solid #e2e8f0;border-radius:10px;font-size:.95rem;font-family:inherit;outline:none;transition:border .15s}
input[type=text]:focus,textarea:focus,select:focus{border-color:#6366f1}
textarea{min-height:180px;resize:vertical}
.row{display:grid;grid-template-columns:1fr 1fr;gap:16px}
.check-row{display:flex;align-items:center;gap:10px;padding:12px 14px;background:#f8fafc;border-radius:10px;border:1.5px solid #e2e8f0}
.check-row input[type=checkbox]{width:18px;height:18px;accent-color:#6366f1;cursor:pointer}
.check-row label{margin:0;font-size:.95rem;color:#1e293b;cursor:pointer}
.error{color:#ef4444;font-size:.8rem;margin-top:4px}
.btns{display:flex;gap:12px;margin-top:8px}
.btn-save{flex:1;padding:12px;background:linear-gradient(135deg,#6366f1,#2563eb);color:#fff;border:none;border-radius:10px;font-size:1rem;font-weight:600;cursor:pointer;transition:opacity .15s}
.btn-save:hover{opacity:.88}
.btn-back{padding:12px 20px;background:#f1f5f9;color:#475569;border:none;border-radius:10px;font-size:1rem;font-weight:600;cursor:pointer;text-decoration:none;display:inline-flex;align-items:center}
.btn-back:hover{background:#e2e8f0}
</style>
</head>
<body>
<div class="card">
  <div class="logo">
    <div class="logo-icon">AS</div>
    <div class="logo-text">AttendoStud</div>
  </div>
  <h1>&#1044;&#1086;&#1073;&#1072;&#1074;&#1080;&#1090;&#1100; &#1085;&#1086;&#1074;&#1086;&#1089;&#1090;&#1100;</h1>
  @if($errors->any())
  <div style="background:#fef2f2;border:1px solid #fca5a5;color:#dc2626;padding:12px 16px;border-radius:10px;margin-bottom:18px;font-size:.9rem">
    @foreach($errors->all() as $e)<div>&#8226; {{$e}}</div>@endforeach
  </div>
  @endif
  <form method="POST" action="{{route('admin.news.store')}}">
    @csrf
    <div class="form-group">
      <label>&#1047;&#1072;&#1075;&#1086;&#1083;&#1086;&#1074;&#1086;&#1082;</label>
      <input type="text" name="title" value="{{old('title')}}" placeholder="&#1042;&#1074;&#1077;&#1076;&#1080;&#1090;&#1077; &#1079;&#1072;&#1075;&#1086;&#1083;&#1086;&#1074;&#1086;&#1082;">
      @error('title')<div class="error">{{$message}}</div>@enderror
    </div>
    <div class="form-group">
      <label>&#1050;&#1072;&#1090;&#1077;&#1075;&#1086;&#1088;&#1080;&#1103;</label>
      <select name="category">
        <option value="&#1054;&#1073;&#1097;&#1077;&#1077;" {{old('category')=='&#1054;&#1073;&#1097;&#1077;&#1077;'?'selected':''}}>&#1054;&#1073;&#1097;&#1077;&#1077;</option>
        <option value="&#1054;&#1073;&#1098;&#1103;&#1074;&#1083;&#1077;&#1085;&#1080;&#1077;" {{old('category')=='&#1054;&#1073;&#1098;&#1103;&#1074;&#1083;&#1077;&#1085;&#1080;&#1077;'?'selected':''}}>&#1054;&#1073;&#1098;&#1103;&#1074;&#1083;&#1077;&#1085;&#1080;&#1077;</option>
        <option value="&#1052;&#1077;&#1088;&#1086;&#1087;&#1088;&#1080;&#1103;&#1090;&#1080;&#1077;" {{old('category')=='&#1052;&#1077;&#1088;&#1086;&#1087;&#1088;&#1080;&#1103;&#1090;&#1080;&#1077;'?'selected':''}}>&#1052;&#1077;&#1088;&#1086;&#1087;&#1088;&#1080;&#1103;&#1090;&#1080;&#1077;</option>
        <option value="&#1059;&#1095;&#1077;&#1073;&#1072;" {{old('category')=='&#1059;&#1095;&#1077;&#1073;&#1072;'?'selected':''}}>&#1059;&#1095;&#1077;&#1073;&#1072;</option>
      </select>
    </div>
    <div class="form-group">
      <label>&#1058;&#1077;&#1082;&#1089;&#1090; &#1085;&#1086;&#1074;&#1086;&#1089;&#1090;&#1080;</label>
      <textarea name="content" placeholder="&#1042;&#1074;&#1077;&#1076;&#1080;&#1090;&#1077; &#1090;&#1077;&#1082;&#1089;&#1090;...">{{old('content')}}</textarea>
      @error('content')<div class="error">{{$message}}</div>@enderror
    </div>
    <div class="form-group">
      <div class="check-row">
        <input type="checkbox" name="is_published" id="pub" {{old('is_published')?'checked':''}}>
        <label for="pub">&#1054;&#1087;&#1091;&#1073;&#1083;&#1080;&#1082;&#1086;&#1074;&#1072;&#1090;&#1100; &#1089;&#1088;&#1072;&#1079;&#1091;</label>
      </div>
    </div>
    <div class="btns">
      <a href="{{route('admin.index')}}" class="btn-back">&#8592; &#1053;&#1072;&#1079;&#1072;&#1076;</a>
      <button type="submit" class="btn-save">&#1057;&#1086;&#1093;&#1088;&#1072;&#1085;&#1080;&#1090;&#1100;</button>
    </div>
  </form>
</div>
</body>
</html>
