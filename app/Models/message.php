<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class message extends Model
{
    protected $table = 'messages';
    protected $fillable = ["message","provider_id","receiver_id"];
}
