<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\MinilotoResult;
use App\Models\MinilotoForecast;
use DateTime;

class MiniLotoController extends Controller
{
    //

    /**
     * 当選結果一覧
     */
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

    /**
     * 予想登録アクション
     */
    public function forecast_add(Request $request) {

        $data = [];
        $data['success'] = false;
        $data['message'] = '';

        $json = $request->json()->all();

        $insertData = [];

        foreach($json as $d) {
            $ret = [
                'times' => $d['times'],
                'event_date' => $d['eventDate'],
                'per_numbers' => $d['perNumbers'],
                'created_at' => new DateTime(),
                'updated_at' => new DateTime()
            ];
            $insertData[] = $ret;
        }

        if(MinilotoForecast::insert($insertData)) {
            $data['success'] = true;
            $data['message'] = 'データを登録しました。';
        } else {
            $data['message'] = 'データの登録に失敗しました。';
        }

        // MinilotoForecast->insert();
        // json レスポンス
        return response()->json($data);
    }

    public function collation() {
        return view('miniloto.collation');
    }
}
