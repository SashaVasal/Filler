<?php

namespace App\Http\Controllers;
use App\Game;
use App\Player;
use App\Cell;
use App\Field;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

function GoToPlayer($x, $y, $color, $field, $player){
    Player::find($player->id)->update(['color'=>$color]);



    $cell = DB::table('Cells')->where('id_field',$field->id)->where('x',$x-1)->where('y',$y-1)->where('color',$color)->where('playerId',-1)->first();

    DB::table('Cells')->where('id_field',$field->id)->where('x',$x-1)->where('y',$y-1)->where('color',$color)->where('playerId',-1)->update(['playerId'=>$player->id]);
    if($cell){
        GoToPlayer($x-1, $y-1, $color, $field, $player);
    }


    $cell = DB::table('Cells')->where('id_field',$field->id)->where('x',$x+1)->where('y',$y+1)->where('color',$color)->where('playerId',-1)->first();

    DB::table('Cells')->where('id_field',$field->id)->where('x',$x+1)->where('y',$y+1)->where('color',$color)->where('playerId',-1)->update(['playerId'=>$player->id]);
    if($cell){
        GoToPlayer($x+1, $y+1, $color, $field, $player);
    }

    $cell = DB::table('Cells')->where('id_field',$field->id)->where('x',$x+1)->where('y',$y-1)->where('color',$color)->where('playerId',-1)->first();

    DB::table('Cells')->where('id_field',$field->id)->where('x',$x+1)->where('y',$y-1)->where('color',$color)->where('playerId',-1)->update(['playerId'=>$player->id]);
    if($cell){
        GoToPlayer($x+1, $y-1, $color, $field, $player);
    }

    $cell = DB::table('Cells')->where('id_field',$field->id)->where('x',$x-1)->where('y',$y+1)->where('color',$color)->where('playerId',-1)->first();

    DB::table('Cells')->where('id_field',$field->id)->where('x',$x-1)->where('y',$y+1)->where('color',$color)->where('playerId',-1)->update(['playerId'=>$player->id]);
    if($cell){
        GoToPlayer($x-1, $y+1, $color, $field, $player);
    }


}

class ApiController extends Controller
{

    public function CreateGame($height=11, $width=23){
        $players = Player::all();

        $colors =[ 'blue', 'green', 'cyan', 'red', 'magenta', 'yellow', 'white' ];
        ## короче тут надо сделать карту по нормальному. пока что не ебу как
        $field = Field::create([
           'width'=>$width,
           'height'=>$height
        ]);

        $begin = 0;
        for($i = 1; $i < $width -1; $i++){



            for($j = $begin; $j < $height; $j+=2){
                Cell::create([
                    'color'=>$colors[rand(0,6)],
                    'x'=> $i,
                    'y' => $j,
                    'id_field' => $field->id,
                    'playerId' => -1,
                ]);
            }

            if($begin == 1){
                $begin = 0;
            }
            else{
                $begin = 1;
            }
        }

        DB::table('Cells')->where('id_field',$field->id)->where('x',1)->where('y',$height-1)->update(['playerId'=>1]);
        $first = Cell::all()->where('id_field',$field->id)->where('x',1)->where('y',$height-1)->first();
        DB::table('Cells')->where('id_field',$field->id)->where('x',$width - 2)->where('y',$height-1)->update(['playerId'=>2]);
        $second = Cell::all()->where('id_field',$field->id)->where('x',$width - 2)->where('y',$height-1)->first();
        GoToPlayer(1,$height-1,$first->color, $field, $players[0]);
        GoToPlayer($width - 2,$height-1,$second->color, $field, $players[1]);
        $game = Game::create([
                'id_player_1'=> $players[0]->id,
                'id_player_2'=> $players[1]->id,
                'currentPlayerId' =>$players[0]->id,
                'winnerPlayerId' => 0,
                'id_field' => $field->id
            ]);

        return redirect('game/'.$game->id);
    }

    public function PressButton(Request $req){
        $mygame = Game::find($req->game);
        $id_player = $mygame->currentPlayerId;
        DB::table('cells')->where('playerId', $id_player)->update(['color'=>$req->color]);
        $cells = Cell::all()->where('id_field',$mygame->id_field);

        $cells = Cell::all()->where('id_field',$mygame->id_field)->where('playerId',$mygame->currentPlayerId);

        foreach($cells as $c){
            $field = Field::find($mygame->id_field);
            $player = Player::find($mygame->currentPlayerId);
            GoToPlayer($c->x,$c->y,$req->color, $field, $player);
        }

        $cells = Cell::all()->where('id_field',$mygame->id_field);
        $player_1 = $mygame->id_player_1;
        $player_2 = $mygame->id_player_2;

        if($mygame->currentPlayerId != $player_1){
            $mygame->update(['currentPlayerId'=>$player_1]);
        }
        else{
            $mygame->update(['currentPlayerId'=>$player_2]);
        }
        $example = $mygame->currentPlayerId;

        $percent_to_win_1 = Cell::all()->where('id_field',$mygame->id_field)->where('playerId',1)->count() / Cell::all()->where('id_field',$mygame->id_field)->count();
        $percent_to_win_2 = Cell::all()->where('id_field',$mygame->id_field)->where('playerId',2)->count() / Cell::all()->where('id_field',$mygame->id_field)->count();

        $winner = 0;
        if($percent_to_win_1 >= 0.50){
            Game::find($req->game)->update(['winnerPlayerId', 1]);
            $winner = 1;
        }

        if($percent_to_win_2 >= 0.50){
            Game::find($req->game)->update(['winnerPlayerId', 2]);
            $winner = 2;
        }
        return [$cells, $example,$percent_to_win_1,$percent_to_win_2,$winner];
    }

    public function Game($id){
        $game = Game::find($id);
        $field = Field::find($game->id_field);
        $cells = Cell::all()->where('id_field',$field->id);
        return view('game',['game'=>$game, 'field'=>$field, 'cells'=>$cells]);
    }
}
