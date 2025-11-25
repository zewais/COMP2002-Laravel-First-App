<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory; // To enable factory methods for testing and seeding 
    protected $fillable = ['title', 'body', 'user_id']; // Mass assignable attributes 
}
