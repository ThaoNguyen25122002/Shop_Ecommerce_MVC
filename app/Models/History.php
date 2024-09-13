<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    use HasFactory;
    protected $table = 'History';
    protected $fillable = [
        'email',
        'product_name',
        'price',
        'phone',
        'user_id'
    ];
}
