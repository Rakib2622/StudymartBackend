<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class advertisement extends Model
{
    protected $table = 'advertisements';
    protected $fillable = ["content","image","user_id"];
}
