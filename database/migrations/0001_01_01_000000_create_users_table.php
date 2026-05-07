<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('users', function (Blueprint $t) {
            $t->id();
            $t->string('last_name');
            $t->string('first_name');
            $t->string('patronymic')->nullable();
            $t->string('login')->unique();
            $t->string('email')->nullable()->unique();
            $t->string('password');
            $t->enum('role',['student','teacher','admin'])->default('student');
            $t->string('group_name')->nullable();
            $t->integer('course')->nullable();
            $t->string('specialty_code')->nullable();
            $t->string('specialty_name')->nullable();
            $t->string('subject')->nullable();
            $t->string('department')->nullable();
            $t->string('phone')->nullable();
            $t->string('avatar')->nullable();
            $t->string('qr_token')->unique()->nullable();
            $t->rememberToken();
            $t->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('users'); }
};