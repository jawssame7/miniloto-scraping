<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MinilotoPastUrls extends Seeder
{

    private $urls = [
        'https://www.mizuhobank.co.jp/retail/takarakuji/check/loto/backnumber/loto0001.html',
        'https://www.mizuhobank.co.jp/retail/takarakuji/check/loto/backnumber/loto0021.html',
        'https://www.mizuhobank.co.jp/retail/takarakuji/check/loto/backnumber/loto0041.html',
        'https://www.mizuhobank.co.jp/retail/takarakuji/check/loto/backnumber/loto0061.html',
        'https://www.mizuhobank.co.jp/retail/takarakuji/check/loto/backnumber/loto0081.html',
        'https://www.mizuhobank.co.jp/retail/takarakuji/check/loto/backnumber/loto0101.html',
        'https://www.mizuhobank.co.jp/retail/takarakuji/check/loto/backnumber/loto0121.html',
        'https://www.mizuhobank.co.jp/retail/takarakuji/check/loto/backnumber/loto0141.html',
        'https://www.mizuhobank.co.jp/retail/takarakuji/check/loto/backnumber/loto0161.html',
        'https://www.mizuhobank.co.jp/retail/takarakuji/check/loto/backnumber/loto0181.html',
        'https://www.mizuhobank.co.jp/retail/takarakuji/check/loto/backnumber/loto0201.html',
        'https://www.mizuhobank.co.jp/retail/takarakuji/check/loto/backnumber/loto0221.html',
        'https://www.mizuhobank.co.jp/retail/takarakuji/check/loto/backnumber/loto0241.html',
        'https://www.mizuhobank.co.jp/retail/takarakuji/check/loto/backnumber/loto0261.html',
        'https://www.mizuhobank.co.jp/retail/takarakuji/check/loto/backnumber/loto0281.html',
        'https://www.mizuhobank.co.jp/retail/takarakuji/check/loto/backnumber/loto0301.html',
        'https://www.mizuhobank.co.jp/retail/takarakuji/check/loto/backnumber/loto0321.html',
        'https://www.mizuhobank.co.jp/retail/takarakuji/check/loto/backnumber/loto0341.html',
        'https://www.mizuhobank.co.jp/retail/takarakuji/check/loto/backnumber/loto0361.html',
        'https://www.mizuhobank.co.jp/retail/takarakuji/check/loto/backnumber/loto0381.html',
        'https://www.mizuhobank.co.jp/retail/takarakuji/check/loto/backnumber/loto0401.html',
        'https://www.mizuhobank.co.jp/retail/takarakuji/check/loto/backnumber/loto0421.html',
        'https://www.mizuhobank.co.jp/retail/takarakuji/check/loto/backnumber/loto0441.html',
        'https://www.mizuhobank.co.jp/retail/takarakuji/check/loto/backnumber/loto0461.html',
        'https://www.mizuhobank.co.jp/retail/takarakuji/check/loto/backnumber/loto0481.html',
        'https://www.mizuhobank.co.jp/retail/takarakuji/check/loto/backnumber/loto0501.html',
        'https://www.mizuhobank.co.jp/retail/takarakuji/check/loto/backnumber/detail.html?fromto=521_540&type=miniloto',
        'https://www.mizuhobank.co.jp/retail/takarakuji/check/loto/backnumber/detail.html?fromto=541_560&type=miniloto',
        'https://www.mizuhobank.co.jp/retail/takarakuji/check/loto/backnumber/detail.html?fromto=561_580&type=miniloto',
        'https://www.mizuhobank.co.jp/retail/takarakuji/check/loto/backnumber/detail.html?fromto=581_600&type=miniloto',
        'https://www.mizuhobank.co.jp/retail/takarakuji/check/loto/backnumber/detail.html?fromto=601_620&type=miniloto',
        'https://www.mizuhobank.co.jp/retail/takarakuji/check/loto/backnumber/detail.html?fromto=621_640&type=miniloto',
        'https://www.mizuhobank.co.jp/retail/takarakuji/check/loto/backnumber/detail.html?fromto=641_660&type=miniloto',
        'https://www.mizuhobank.co.jp/retail/takarakuji/check/loto/backnumber/detail.html?fromto=661_680&type=miniloto',
        'https://www.mizuhobank.co.jp/retail/takarakuji/check/loto/backnumber/detail.html?fromto=681_700&type=miniloto',
        'https://www.mizuhobank.co.jp/retail/takarakuji/check/loto/backnumber/detail.html?fromto=701_720&type=miniloto',
        'https://www.mizuhobank.co.jp/retail/takarakuji/check/loto/backnumber/detail.html?fromto=721_740&type=miniloto',
        'https://www.mizuhobank.co.jp/retail/takarakuji/check/loto/backnumber/detail.html?fromto=741_760&type=miniloto',
        'https://www.mizuhobank.co.jp/retail/takarakuji/check/loto/backnumber/detail.html?fromto=761_780&type=miniloto',
        'https://www.mizuhobank.co.jp/retail/takarakuji/check/loto/backnumber/detail.html?fromto=781_800&type=miniloto',
        'https://www.mizuhobank.co.jp/retail/takarakuji/check/loto/backnumber/detail.html?fromto=801_820&type=miniloto',
        'https://www.mizuhobank.co.jp/retail/takarakuji/check/loto/backnumber/detail.html?fromto=821_840&type=miniloto',
        'https://www.mizuhobank.co.jp/retail/takarakuji/check/loto/backnumber/detail.html?fromto=841_860&type=miniloto',
        'https://www.mizuhobank.co.jp/retail/takarakuji/check/loto/backnumber/detail.html?fromto=861_880&type=miniloto',
        'https://www.mizuhobank.co.jp/retail/takarakuji/check/loto/backnumber/detail.html?fromto=881_900&type=miniloto',
        'https://www.mizuhobank.co.jp/retail/takarakuji/check/loto/backnumber/detail.html?fromto=901_920&type=miniloto',
        'https://www.mizuhobank.co.jp/retail/takarakuji/check/loto/backnumber/detail.html?fromto=921_940&type=miniloto',
        'https://www.mizuhobank.co.jp/retail/takarakuji/check/loto/backnumber/detail.html?fromto=941_960&type=miniloto',
        'https://www.mizuhobank.co.jp/retail/takarakuji/check/loto/backnumber/detail.html?fromto=961_980&type=miniloto',
        'https://www.mizuhobank.co.jp/retail/takarakuji/check/loto/backnumber/detail.html?fromto=981_1000&type=miniloto',
        'https://www.mizuhobank.co.jp/retail/takarakuji/check/loto/backnumber/detail.html?fromto=1001_1020&type=miniloto',
        'https://www.mizuhobank.co.jp/retail/takarakuji/check/loto/backnumber/detail.html?fromto=1021_1040&type=miniloto',
        'https://www.mizuhobank.co.jp/retail/takarakuji/check/loto/backnumber/detail.html?fromto=1041_1060&type=miniloto',
        'https://www.mizuhobank.co.jp/retail/takarakuji/check/loto/backnumber/detail.html?fromto=1061_1080&type=miniloto',
        'https://www.mizuhobank.co.jp/retail/takarakuji/check/loto/backnumber/detail.html?fromto=1081_1087&type=miniloto'
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [];

        foreach ($this->urls as $value) {
            # code...
            $ret = [];
            $ret['url'] = $value;
            $data[] = $ret;
        }
        //
        DB::table('miniloto_past_urls')->insert($data);

    }
}
