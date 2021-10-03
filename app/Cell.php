<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cell extends Model
{
    protected $fillable = [
        'id', 'color', 'id_field', 'x', 'y', 'playerId'
    ];
}
