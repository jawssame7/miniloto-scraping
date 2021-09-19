<?php

namespace App\Console\Commands\Scraping;

use App\Models\MinilotoResult;
use App\Models\MinilotoPastUrl;
use DateTime;
use Facebook\WebDriver\Chrome\ChromeOptions;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverExpectedCondition;
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

        $chrome = $this->initSeleniumDriver();

        $asyncUrls = [];

        // 520回以降が動的
        foreach ($urls as $urlData) {

            # code...
            // dump($urlData);
            //sleep(2);
            // $results = $this->crawl($urlData->url);
            // $results = $this->transformModel($results);

            // DB::table('miniloto_results')->insert($results);

            // 対象ページが非同期でデータ取得している場合
            // https://www.mizuhobank.co.jp/retail/takarakuji/check/loto/backnumber/detail.html?fromto=1081_1091&type=miniloto


            if ($urlData->async) {

                $asyncUrls[] = $urlData->url;
                // $data = $this->asyncCrawl($chrome, $urlData->url);
                // dump($data);
            }




        }


        foreach($asyncUrls as $url) {
            sleep(3);
            $data = $this->asyncCrawl($chrome, $url);
            dump($data);
            DB::table('miniloto_results')->insert($data);
        }

        // $results = $this->crawl('https://www.mizuhobank.co.jp/retail/takarakuji/check/loto/backnumber/loto0001.html');
        // $results = $this->transformModel($results);

        // dump($results);

        // // MinilotoResult::create($results);
        // DB::table('miniloto_results')->insert($results);

        // $retUrl = 'https://www.mizuhobank.co.jp/retail/takarakuji/check/loto/backnumber/detail.html?fromto=1081_1091&type=miniloto';

        // $data = $this->asyncCrawl($chrome, $retUrl);
        // dump($data);

        // $chrome->get($retUrl);
        // // ページタイトル現れるまでまつ
        // $chrome->wait();

        // $resultTable = $chrome->findElement(WebDriverBy::cssSelector('table.typeTK'));
        // $resultTr = $resultTable->findElements(WebDriverBy::cssSelector('tr.js-lottery-backnumber-temp-pc'));

        // // データを抜き出す
        // foreach($resultTr as $tr) {
        //     $timesEl = $tr->findElement(WebDriverBy::tagName('th'));
        //     $times = $timesEl->getText();

        //     $tds = $tr->findElements(WebDriverBy::tagName('td'));

        //     $lotteryDate = '';
        //     $results = [];

        //     $cnt = 0;
        //     foreach($tds as $td) {
        //         $css = $td->getCSSValue('js-lottery-date');
        //         // 0番目は開催日
        //         if ($cnt === 0)  {
        //             $lotteryDate =  $td->getText();
        //         } else {
        //             $results[] = $td->getText();
        //         }
        //         $cnt++;
        //     }

        // }


        return 0;
    }

    /**
     *
     */
    private function getPastResultUrls ()
    {

        $result = MinilotoPastUrl::where('already_acquired', 0)->get();

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

    /**
     * seleniumドライバーを初期化したインスタンス
     */
    private function initSeleniumDriver()
    {

        // Chrome機能を管理するクラスのインスタンス化
        $options = new ChromeOptions();
        // Chrome起動時のオプション指定
        $options->addArguments([
            '--no-sandbox',
            '--headless'
        ]);

        // Chromeブラウザを起動
        $caps = DesiredCapabilities::chrome();
        $caps->setCapability(ChromeOptions::CAPABILITY, $options);
        // ブラウザを実行するプラットフォームを指定。クロームとのセッションがスムーズになる？？？
        $caps->setPlatform('LINUX');

        // hostを指定（docker-compose ）
        $host = 'http://selenium:4444/wd/hub';

        $driver = RemoteWebDriver::create($host, $caps, 60000, 60000);

        return $driver;
    }

    /**
     * 非同期でデータを取得する結果ページからデータを取得する。
     *
     */
    private function asyncCrawl($chrome, $url)
    {
        $title = $this->transeformTitle($url);
        $data = [];

        $chrome->get($url);
        // ページタイトル現れるまでまつ
        $chrome->wait();

        sleep(3);

        $resultTable = $chrome->findElement(WebDriverBy::cssSelector('table.typeTK'));
        $resultTr = $resultTable->findElements(WebDriverBy::cssSelector('tr.js-lottery-backnumber-temp-pc'));

        // データを抜き出す
        foreach($resultTr as $tr) {

            $ret = [];
            $timesEl = $tr->findElement(WebDriverBy::tagName('th'));
            $times = $timesEl->getText();

            $tds = $tr->findElements(WebDriverBy::tagName('td'));

            $lotteryDate = null;
            $bonusNumber = null;
            $results = [];

            $cnt = 0;
            foreach($tds as $td) {
                // 0番目は開催日
                if ($cnt === 0)  {
                    $lotteryDate =  $td->getText();
                } else if ($cnt === 6) {
                    $bonusNumber = $td->getText();
                } else {
                    $results[] = $td->getText();
                }
                $cnt++;
            }

            $ret['times'] = $times;
            $ret['lottery_date'] = $lotteryDate;
            $ret['per_numbers'] = implode(',', $results);
            $ret['bonus_number'] = $bonusNumber;

            $data[] = $ret;

        }

        return $data;
    }

    /**
     * urlのクエリからタイトルの文字列を生成
     */
    private function transeformTitle($url = '')
    {
        if ($url === '') {
            return false;
        }

        $titlePreffix = '過去の当せん番号案内(ミニロト) ';
        $titleTimesPreffix = '第';
        $titleTimesSuffix = '回';
        $dash = '〜';
        $title = '';

        // $ret = [];
        // parse_str($url, $ret);

        // $times = $ret[1];

        $urlSplit = explode('?', $url);
        //var_dump($urlSplit);

        $querySplit = explode('&', $urlSplit[1]);

        //var_dump($querySplit);

        $ret = [];
        parse_str($urlSplit[1], $ret);

        //var_dump($ret);


        dump($ret);

        if (!empty($ret['fromto'])) {
            $times = explode('_', $ret['fromto']);
            $title = $titlePreffix . $titleTimesPreffix . $times[0] . $titleTimesSuffix . $dash . $times[1] . $titleTimesSuffix;
        }

        return $title;

    }

}
