<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    protected $fillable=[
        'name'
    ];

    protected $table = 'roles';
}
