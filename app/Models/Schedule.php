<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Schedule extends Model {
    protected $fillable=['group_name','day_of_week','lesson_number','time_start','time_end','subject','teacher_id','room'];
    public function teacher() { return $this->belongsTo(User::class,'teacher_id'); }
    public static function dayName(int $d): string {
        return [1=>'Понедельник',2=>'Вторник',3=>'Среда',4=>'Четверг',5=>'Пятница',6=>'Суббота',7=>'Воскресенье'][$d]??'?';
    }
}