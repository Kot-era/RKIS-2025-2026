<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ScheduleController extends Controller
{
    private $days = [1=>'Понедельник',2=>'Вторник',3=>'Среда',4=>'Четверг',5=>'Пятница',6=>'Суббота',7=>'Воскресенье'];

    public function index(Request $request)
    {
        $user = Auth::user();
        $group = $request->group ?? $user->group_name;
        $teachers = User::where('role', 'teacher')->orderBy('last_name')->get();
        $groups = Schedule::select('group_name')->distinct()->pluck('group_name');

        if ($user->role === 'student') {
            $schedule = Schedule::where('group_name', $user->group_name)
                ->orderBy('day_of_week')->orderBy('lesson_number')->with('teacher')->get();
        } elseif ($user->role === 'teacher') {
            $schedule = Schedule::where('teacher_id', $user->id)
                ->orderBy('day_of_week')->orderBy('lesson_number')->with('teacher')->get();
        } else {
            $schedule = Schedule::where('group_name', $group)
                ->orderBy('day_of_week')->orderBy('lesson_number')->with('teacher')->get();
        }

        $days = $this->days;
        return view('schedule.index', compact('schedule', 'group', 'groups', 'teachers', 'days'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'group_name'    => 'required|string|max:50',
            'day_of_week'   => 'required|integer|between:1,7',
            'lesson_number' => 'required|integer|min:1|max:10',
            'time_start'    => 'required',
            'time_end'      => 'required',
            'subject'       => 'required|string|max:200',
        ], [
            'group_name.required'    => 'Укажите группу.',
            'day_of_week.required'   => 'Выберите день недели.',
            'lesson_number.required' => 'Укажите номер пары.',
            'time_start.required'    => 'Укажите время начала.',
            'time_end.required'      => 'Укажите время окончания.',
            'subject.required'       => 'Укажите предмет.',
        ]);

        Schedule::create($request->only(['group_name', 'day_of_week', 'lesson_number', 'time_start', 'time_end', 'subject', 'teacher_id', 'room']));

        return back()->with('success', 'Занятие добавлено.');
    }

    public function destroy(Schedule $schedule)
    {
        $schedule->delete();
        return back()->with('success', 'Занятие удалено.');
    }
}
