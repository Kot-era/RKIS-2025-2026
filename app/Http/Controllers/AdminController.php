<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\User;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function showLogin()
    {
        if (session('admin_authenticated')) {
            return redirect()->route('admin.index');
        }
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'password' => 'required|string',
        ], [
            'password.required' => 'Введите пароль.',
        ]);

        $hash = config('app.admin_password_hash');

        if ($hash && Hash::check($request->password, $hash)) {
            session(['admin_authenticated' => true]);
            return redirect()->route('admin.index');
        }

        return back()->withErrors(['password' => 'Неверный пароль.']);
    }

    public function logout()
    {
        session()->forget('admin_authenticated');
        return redirect()->route('admin.login')
            ->with('success', 'Вы вышли из панели управления.');
    }

    public function index()
    {
        $stats = [
            'users'    => User::count(),
            'students' => User::where('role', 'student')->count(),
            'teachers' => User::where('role', 'teacher')->count(),
            'news'     => News::count(),
            'schedule' => Schedule::count(),
        ];
        $users = User::orderBy('role')->orderBy('last_name')->get();
        $news  = News::latest()->get();
        return view('admin.index', compact('stats', 'users', 'news'));
    }

    public function createUser()
    {
        return view('admin.users.create');
    }

    public function storeUser(Request $request)
    {
        $request->validate([
            'last_name'  => 'required|string|max:100',
            'first_name' => 'required|string|max:100',
            'login'      => 'required|string|max:50|unique:users,login',
            'email'      => 'nullable|email|max:150|unique:users,email',
            'password'   => 'required|string|min:6',
            'role'       => 'required|in:student,teacher,admin',
        ], [
            'last_name.required'  => 'Введите фамилию.',
            'first_name.required' => 'Введите имя.',
            'login.required'      => 'Введите логин.',
            'login.unique'        => 'Этот логин уже занят.',
            'email.unique'        => 'Этот email уже используется.',
            'password.required'   => 'Введите пароль.',
            'password.min'        => 'Пароль должен быть не менее 6 символов.',
            'role.required'       => 'Выберите роль.',
            'role.in'             => 'Недопустимая роль.',
        ]);

        User::create([
            'last_name'      => $request->last_name,
            'first_name'     => $request->first_name,
            'patronymic'     => $request->patronymic,
            'login'          => $request->login,
            'email'          => $request->email,
            'password'       => Hash::make($request->password),
            'role'           => $request->role,
            'group_name'     => $request->group_name,
            'course'         => $request->course,
            'specialty_code' => $request->specialty_code,
            'specialty_name' => $request->specialty_name,
            'subject'        => $request->subject,
            'department'     => $request->department,
            'qr_token'       => \Illuminate\Support\Str::random(32),
        ]);

        return redirect()->route('admin.index')
            ->with('success', 'Пользователь успешно создан.');
    }

    public function editUser(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function updateUser(Request $request, User $user)
    {
        $request->validate([
            'last_name'  => 'required|string|max:100',
            'first_name' => 'required|string|max:100',
            'login'      => 'required|string|max:50|unique:users,login,' . $user->id,
            'email'      => 'nullable|email|max:150|unique:users,email,' . $user->id,
            'role'       => 'required|in:student,teacher,admin',
        ], [
            'last_name.required'  => 'Введите фамилию.',
            'first_name.required' => 'Введите имя.',
            'login.required'      => 'Введите логин.',
            'login.unique'        => 'Этот логин уже занят.',
            'email.unique'        => 'Этот email уже используется.',
            'role.required'       => 'Выберите роль.',
        ]);

        $data = [
            'last_name'      => $request->last_name,
            'first_name'     => $request->first_name,
            'patronymic'     => $request->patronymic,
            'login'          => $request->login,
            'email'          => $request->email,
            'role'           => $request->role,
            'group_name'     => $request->group_name,
            'course'         => $request->course,
            'specialty_code' => $request->specialty_code,
            'specialty_name' => $request->specialty_name,
            'subject'        => $request->subject,
            'department'     => $request->department,
        ];

        if ($request->filled('password')) {
            $request->validate(['password' => 'string|min:6']);
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('admin.index')
            ->with('success', 'Данные пользователя обновлены.');
    }

    public function destroyUser(User $user)
    {
        if ($user->id === auth()->id()) {
            return back()->with('error', 'Нельзя удалить собственную учётную запись.');
        }
        $user->delete();
        return redirect()->route('admin.index')
            ->with('success', 'Пользователь удалён.');
    }


    public function createNews()
    {
        return view('admin.news.create');
    }

    public function storeNews(Request $request)
    {
        $request->validate([
            'title'   => 'required|string|max:255',
            'content' => 'required|string',
            'category'=> 'nullable|string|max:100',
        ], [
            'title.required'   => 'Введите заголовок.',
            'content.required' => 'Введите текст новости.',
        ]);
        \App\Models\News::create([
            'title'        => $request->title,
            'content'      => $request->content,
            'category'     => $request->category ?? 'Общее',
            'is_published' => $request->has('is_published'),
            'author_id'    => null,
        ]);
        return redirect()->route('admin.index')->with('success', 'Новость добавлена.');
    }
    public function toggleNews(News $news)
    {
        $news->update(['is_published' => !$news->is_published]);
        $status = $news->is_published ? 'опубликована' : 'скрыта';
        return back()->with('success', "Новость {$status}.");
    }

    public function destroyNews(News $news)
    {
        $news->delete();
        return back()->with('success', 'Новость удалена.');
    }
}
