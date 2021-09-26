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
    public function forecast_add(Request $request)
    {

        $data = [];
        $data['success'] = false;
        $data['message'] = '';

        $json = $request->json()->all();

        $insertData = [];

        foreach($json as $d) {
            $ret = [
                'times' => $d['times'],
                'lottery_date' => $d['lotteryDate'],
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
        // json レスポンス
        return response()->json($data);
    }



    public function collation()
    {
        $ret = null;
        $lotteryDate = null;
        $forecastResults = [];

        // 最新の一件取得
        $resultQuery = MinilotoResult::query();
        $resultQuery->orderBy('id', 'desc');
        $resultQuery->limit(1);
        $minilotoResults = $resultQuery->get();

        if (!empty($minilotoResults[0])) {
            $ret = $minilotoResults[0];
        }

        if (!empty($ret)) {
            $lotteryDate = $ret->lottery_date;
        }

        // 最新一件と同じ予想結果を取得
        if (!empty($lotteryDate)) {
            $forecastQuery = MinilotoForecast::query();
            $forecastQuery->where('lottery_date', $lotteryDate);
            $forecastResults = $forecastQuery->get();
        }


        //dd($minilotoResults, $forecastResults);

        return view('miniloto.collation', [
            'minilotoResults' => $minilotoResults,
            'forecastResults' => $forecastResults
        ]);
    }
}
