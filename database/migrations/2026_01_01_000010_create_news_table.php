<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('news', function (Blueprint $t) {
            $t->id();
            $t->string('title');
            $t->text('content');
            $t->string('image')->nullable();
            $t->string('category')->default('Новости');
            $t->boolean('is_published')->default(true);
            $t->foreignId('author_id')->constrained('users')->onDelete('cascade');
            $t->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('news'); }
};