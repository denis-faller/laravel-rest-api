<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    public $timestamps = false;
    
    protected $fillable = ['title', 'description', 'complexity', 'isActive'];

    protected $hidden = ['deleted_at'];
}
