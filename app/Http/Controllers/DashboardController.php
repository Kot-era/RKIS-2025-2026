<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\News;
use App\Models\Schedule;
class DashboardController extends Controller {
    public function index() {
        $user = Auth::user();
        $news = News::where("is_published",1)->latest()->take(3)->get();
        $today = date("N");
        $schedule = collect();
        if($user->isStudent() && $user->group_name){
            $schedule = Schedule::where("group_name",$user->group_name)
                ->orderBy("day_of_week")->orderBy("lesson_number")
                ->with("teacher")->get();
        } elseif($user->isTeacher()){
            $schedule = Schedule::where("teacher_id",$user->id)
                ->orderBy("day_of_week")->orderBy("lesson_number")
                ->with("teacher")->get();
        }
        return view("dashboard.index",compact("user","news","schedule","today"));
    }
}