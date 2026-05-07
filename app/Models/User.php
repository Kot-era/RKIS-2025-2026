<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
class User extends Authenticatable {
    use HasFactory, Notifiable;
    protected $fillable = ['last_name','first_name','patronymic','login','email','password','role','group_name','course','specialty_code','specialty_name','subject','department','phone','avatar','qr_token'];
    protected $hidden = ['password','remember_token'];
    protected function casts(): array { return []; }
    public function getAuthIdentifierName() { return 'login'; }
    public function fullName(): string { return trim("{$this->last_name} {$this->first_name} {$this->patronymic}"); }
    public function shortName(): string { $p=mb_substr($this->patronymic,0,1); return "{$this->last_name} ".mb_substr($this->first_name,0,1).".".($p?"$p.":""); }
    public function isAdmin(): bool { return $this->role==='admin'; }
    public function isTeacher(): bool { return $this->role==='teacher'; }
    public function isStudent(): bool { return $this->role==='student'; }
    public function news() { return $this->hasMany(\App\Models\News::class,'author_id'); }
    public function schedules() { return $this->hasMany(\App\Models\Schedule::class,'teacher_id'); }
}