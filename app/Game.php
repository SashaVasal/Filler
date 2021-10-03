<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $fillable = [
        'id', 'id_field', 'id_player_1', 'id_player_2', 'currentPlayerId', 'winnerPlayerId'
    ];
}
