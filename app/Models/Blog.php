<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'image',
        'description',
        'content'
    ];
    public function comments(){
        return $this->hasMany(Comment::class,'id_blog')->where('level',0);
    }
    public function ratings()
    {
        return $this->hasMany(Rating::class, 'id_blog');
    }
}
