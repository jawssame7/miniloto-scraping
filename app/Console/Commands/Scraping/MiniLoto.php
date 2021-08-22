<?php

namespace App\Console\Commands\Scraping;

use App\Models\MinilotoResult;
use App\Models\MinilotoPastUrl;
use DateTime;
use Illuminate\Console\Command;
use Goutte\Client;
use Illuminate\Support\Facades\DB;

/**
 * ミニロト結果スクレイピング
 * php artisan command:miniloto
 */
class MiniLoto extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scraping:miniloto';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'miniloto result scraping';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        $urls = $this->getPastResultUrls();

        // 520回以降が動的
        foreach ($urls as $urlData) {

            # code...
            dump($urlData);
            sleep(2);
            $results = $this->crawl($urlData->url);
            $results = $this->transformModel($results);

            DB::table('miniloto_results')->insert($results);
        }

        // $results = $this->crawl('https://www.mizuhobank.co.jp/retail/takarakuji/check/loto/backnumber/loto0001.html');
        // $results = $this->transformModel($results);

        // dump($results);

        // // MinilotoResult::create($results);
        // DB::table('miniloto_results')->insert($results);

        return 0;
    }

    /**
     *
     */
    private function getPastResultUrls ()
    {

        $result = MinilotoPastUrl::get();

        //dump($result);

        return $result;
    }

    // /**
    //  *
    //  */
    // private function pastResultsUrl ()
    // {
    //     // 動的ページにGoutte\Clientが対応できていないため
    //     // ajax等で取得しているコンテンツがとれない
    //     $client = new Client();
    //     $crawler = $client->request('GET', 'https://www.mizuhobank.co.jp/retail/takarakuji/check/loto/backnumber/index.html');
    //     //dump($crawler->filter('table.typeTK.js-backnumber-b tr td:nth-child(1)'));
    //     $results = $crawler->filter('table tr')->each(function ($node) {
    //         // print 'aaa  ◇◇◇◇◇◇◇◇◇◇◇◇◇◇◇ '. $node->text() ."\n";
    //         // $node->filter('a')->each(function ($link) {
    //         //     print 'bbb'."\n";
    //         //     print $link->extract('href') ."\n";
    //         // });
    //         //dump($node->text());
    //         //return $node->attr('href');
    //     });

    //     //dump($results);
    // }

    /**
     * 過去の当選結果のクローリング
     */
    private function crawl($url)
    {

        $client = new Client();
        $crawler = $client->request('GET', $url);
        $results = [];

        $results = $crawler->filter('.pc-none > table')->each(function ($table) {


            $row = $table->filter('td')->each(function ($td, $i) {
                $ret = [];
                switch ($i) {
                    case 0:
                        $ret['times'] = $td->text();
                        break;
                    case 1:
                        $ret['lottery_date'] = $td->text();
                        break;
                    case 2:
                        $ret['per_numbers'] = $td->text();
                        break;
                    case 3:
                        $ret['bonus_number'] = $td->text();
                        break;
                }

                return $td->text();
            });
            return $row;
        });

        return $results;
    }

    /**
     * モデルを使える形式に変換
     * @param {Array} data
     * @return {Array} []
     */
    private function transformModel($data = [])
    {

        $results = [];
        foreach ($data as $key => $value) {
            # code...
            $row = [
                'times' => $value[0],
                'lottery_date' => $value[1],
                'per_numbers' => $this->parsePerNumbers($value[2]),
                'bonus_number' => $value[3],
                'created_at' => new DateTime(),
                'updated_at' => new DateTime()
            ];
            $results[] = $row;
        }

        return $results;
    }

    /**
     * 当選番号の形式に変換
     * @param {String} value
     * @return {String} スペースをカンマに置き換えた文字列
     */
    private function parsePerNumbers($value = '')
    {
        return preg_replace('/( |　)/', ',', $value);
    }
}
