<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('schedules', function (Blueprint $t) {
            $t->id();
            $t->string('group_name');
            $t->tinyInteger('day_of_week'); // 1=Mon..7=Sun
            $t->tinyInteger('lesson_number');
            $t->time('time_start');
            $t->time('time_end');
            $t->string('subject');
            $t->foreignId('teacher_id')->nullable()->constrained('users')->nullOnDelete();
            $t->string('room')->nullable();
            $t->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('schedules'); }
};