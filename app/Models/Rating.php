<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;
    protected $fillable = ['rating_star', 'id_user', 'id_blog'];
    public function blog()
    {
        return $this->belongsTo(Blog::class, 'id_blog');
    }
}
