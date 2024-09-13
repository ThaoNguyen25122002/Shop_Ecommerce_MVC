<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $fillable = [
        'comment',
        'id_user',
        'id_blog',
        'avatar_user',
        'name_user',
        'level'

    ];
    public function children()
    {
        return $this->hasMany(Comment::class, 'level');
    }
}
