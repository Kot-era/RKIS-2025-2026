<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AttendanceController extends Controller
{
    public function studentIndex()
    {
        $user = Auth::user();
        $schedules = DB::table('schedules')->where('group_name',$user->group_name)->get();
        $data = [];
        foreach ($schedules as $sch) {
            $rows = DB::table('attendances')->where('user_id',$user->id)->where('schedule_id',$sch->id)->get();
            $total=$rows->count(); $present=$rows->where('status','present')->count();
            $late=$rows->where('status','late')->count(); $absent=$rows->where('status','absent')->count();
            $pct=$total>0?round(($present+$late)/$total*100):0;
            $t=DB::table('users')->where('id',$sch->teacher_id)->first();
            $data[]=['subject'=>$sch->subject,'teacher'=>$t?$t->last_name.' '.$t->first_name:'',
                'total'=>$total,'present'=>$present,'late'=>$late,'absent'=>$absent,'pct'=>$pct,'red'=>$absent>10];
        }
        $total_absent=array_sum(array_column($data,'absent'));
        return view('attendance.student',compact('data','total_absent'));
    }

    public function teacherIndex()
    {
        if (Auth::user()->role !== 'teacher') { abort(403); }
        $schedules=DB::table('schedules')->where('teacher_id',Auth::id())->get();
        return view('attendance.teacher',compact('schedules'));
    }

    public function markForm(Request $request,$scheduleId)
    {
        $date=$request->get('date',now()->format('Y-m-d'));
        $schedule=DB::table('schedules')->where('id',$scheduleId)->firstOrFail();
        if($schedule->teacher_id!=Auth::id()) abort(403);
        $students=DB::table('users')->where('role','student')->where('group_name',$schedule->group_name)->orderBy('last_name')->get();
        $existing=DB::table('attendances')->where('schedule_id',$scheduleId)->where('date',$date)->pluck('status','user_id');
        return view('attendance.mark',compact('schedule','students','date','existing'));
    }

    public function markStore(Request $request,$scheduleId)
    {
        $schedule=DB::table('schedules')->where('id',$scheduleId)->firstOrFail();
        if($schedule->teacher_id!=Auth::id()) abort(403);
        $date=$request->input('date');
        foreach($request->input('status',[]) as $uid=>$status){
            DB::table('attendances')->updateOrInsert(
                ['user_id'=>$uid,'schedule_id'=>$scheduleId,'date'=>$date],
                ['status'=>$status,'updated_at'=>now(),'created_at'=>now()]
            );
        }
        return redirect()->route('attendance.teacher')->with('success','Saved');
    }
}
