<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\MinilotoResult;

class MiniLotoController extends Controller
{
    //

    public function index()
    {

        $sqlQuery = MinilotoResult::query();
        $sqlQuery->orderBy('id', 'desc');
        $sqlQuery->limit(30);
        $minilotoResults = $sqlQuery->get();
        //dump($minilotoResults);
        // $minilotoResults = MinilotoResult::orderBy('id', 'desc')->get();
        //dump($result);
        return view('miniloto.index', [
            'minilotoResults' => $minilotoResults
        ]);
    }
}
