<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Worker extends Model
{
    protected $fillable = [
        'name',
        'image_path',
        'email',
        'date_of_birth',
    ];
}
