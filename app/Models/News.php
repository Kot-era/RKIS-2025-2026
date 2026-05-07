<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class News extends Model {
    protected $fillable=['title','content','image','category','is_published','author_id'];
    public function author() { return $this->belongsTo(User::class,'author_id'); }
}