<?php

namespace App\Http\Controllers;

use Session;
use App\Game\Sudoku;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index(Request $request)
    {
        $lvl = $request->lvl;

        if (!isset($lvl) || $lvl > 0.6  )
            return redirect('/');


        $game = new Sudoku($lvl);

        $solution = $game->getSolution();

        Session::put('solution',json_encode($solution));

        $arrays = $game->getGame();

        return view('game')->withArrays($arrays);
    }

    public function validCell(Request $request)
    {
        $solution = json_decode(Session::get('solution'));

        $explode = explode('-',$request->id);

        list($ver,$hor) = $explode;

        if ($solution[$ver][$hor] == $request->value){
            $result['status'] = 'success';
        } else {
            $result['status'] = 'danger';
        }

        $result['id'] = $request->id;

        return json_encode($result);
    }

}


