<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Панель управления — Вход</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'Inter', sans-serif; background: #0f172a; min-height: 100vh; display: flex; align-items: center; justify-content: center; }
        .wrap { width: 100%; max-width: 420px; padding: 16px; }
        .logo { text-align: center; margin-bottom: 32px; }
        .logo h1 { font-size: 1.5rem; font-weight: 700; color: #f1f5f9; }
        .logo p { color: #64748b; font-size: 0.85rem; margin-top: 4px; }
        .logo .badge { display: inline-block; margin-top: 10px; background: #1e293b; border: 1px solid #334155; color: #94a3b8; font-size: 0.75rem; padding: 4px 12px; border-radius: 20px; }
        .card { background: #1e293b; border-radius: 16px; border: 1px solid #334155; padding: 36px 32px; }
        .card h2 { font-size: 1.15rem; font-weight: 600; color: #f1f5f9; margin-bottom: 6px; }
        .card p { font-size: 0.875rem; color: #64748b; margin-bottom: 28px; }
        .form-group { margin-bottom: 18px; }
        .form-label { display: block; font-size: 0.875rem; font-weight: 500; color: #94a3b8; margin-bottom: 6px; }
        .form-control { width: 100%; padding: 11px 14px; border: 1px solid #334155; border-radius: 8px; font-size: 0.9rem; font-family: inherit; color: #f1f5f9; background: #0f172a; transition: border-color 0.15s, box-shadow 0.15s; outline: none; }
        .form-control:focus { border-color: #2563eb; box-shadow: 0 0 0 3px rgba(37,99,235,0.2); }
        .form-control.is-invalid { border-color: #ef4444; }
        .form-error { font-size: 0.8rem; color: #f87171; margin-top: 4px; }
        .btn-submit { width: 100%; padding: 12px; background: #2563eb; color: #fff; border: none; border-radius: 8px; font-size: 0.9rem; font-weight: 600; cursor: pointer; font-family: inherit; transition: background 0.15s; margin-top: 8px; }
        .btn-submit:hover { background: #1d4ed8; }
        .alert { padding: 12px 16px; border-radius: 8px; margin-bottom: 20px; font-size: 0.875rem; }
        .alert-error { background: rgba(239,68,68,0.15); color: #f87171; border: 1px solid rgba(239,68,68,0.3); }
        .alert-success { background: rgba(34,197,94,0.15); color: #4ade80; border: 1px solid rgba(34,197,94,0.3); }
        .back { text-align: center; margin-top: 20px; }
        .back a { font-size: 0.8rem; color: #475569; text-decoration: none; }
        .back a:hover { color: #64748b; }
    </style>
</head>
<body>
<div class="wrap">
    <div class="logo">
        <h1>АттендоСтуд</h1>
        <p>Образовательный портал</p>
        <span class="badge">Панель управления</span>
    </div>
    <div class="card">
        <h2>Вход для администратора</h2>
        <p>Введите пароль администратора</p>

        @if(session('error'))
            <div class="alert alert-error">{{ session('error') }}</div>
        @endif
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if($errors->any())
            <div class="alert alert-error">
                @foreach($errors->all() as $err)<div>{{ $err }}</div>@endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('admin.login.post') }}">
            @csrf
            <div class="form-group">
                <label class="form-label" for="password">Пароль</label>
                <input type="password" id="password" name="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" placeholder="Пароль администратора" autofocus>
                @error('password')<div class="form-error">{{ $message }}</div>@enderror
            </div>
            <button type="submit" class="btn-submit">Войти в панель</button>
        </form>
    </div>
    <div class="back">
        <a href="{{ route('login') }}">← Вернуться к обычному входу</a>
    </div>
</div>
</body>
</html>