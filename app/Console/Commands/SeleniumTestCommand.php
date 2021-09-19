<?php

namespace App\Console\Commands;

use Facebook\WebDriver\Chrome\ChromeDriver;
use Facebook\WebDriver\Chrome\ChromeOptions;
use Facebook\WebDriver\Exception\WebDriverException;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriver;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverExpectedCondition;
use Illuminate\Console\Command;

class SeleniumTestCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'chrome:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Seleniumでスクレイピング！！';

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

        // 参考 https://qiita.com/masuraoProg/items/0d863f18e862fdc41fa8

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

        $driver = null;

        try {

            // $driver = retry(3, function () use ($host, $caps) {
            //     return RemoteWebDriver::create($host, $caps, 60000, 60000);
            // }, 1000);

            $driver = RemoteWebDriver::create($host, $caps, 60000, 60000);

            $driver->get('http://news.yahoo.co.jp');

            // dump($driver->getCurrentUrl());

            // ページタイトル現れるまでまつ
            $driver->wait()->until(
                WebDriverExpectedCondition::titleIs('過去の当せん番号案内(ミニロト) 第1081回〜第1091回 | みずほ銀行')
            );

            // トピックスをリストを取得
            $topics = $driver->findElement(WebDriverBy::cssSelector('.topics'));
            // トピックスないのliの数
            $topics_counts = $topics->findElements(WebDriverBy::cssSelector('li a'));

            // トップページのリンクをたどる
            // $topics_counts = count(
            //     $driver->findElement(WebDriverBy::className('topics'))
            //     ->findElements(WebDriverBy::className('topicsListItem'))
            // );

            // リンク集
            $links = [];

            // ループ内でリンクを取得して、リンクにアクセスすると
            // エラーになるため
            // 事前にhref（リンク）を取得しとく
            foreach($topics_counts as $topic) {
                // $topic = $topics[$i];
                // $topic->findElements(WebDriverBy::tagName('li'));

                // $links[] = $driver->findElement(WebDriverBy::className('topics'))
                //             ->findElements(WebDriverBy::tagName('li'))[$i]
                //             ->findElement(WebDriverBy::tagName('a'))
                //             ->getAttribute('href');
                $links[] = $topic->getAttribute('href');

            }

            // リンクの数分ループ
            foreach($links as $link) {

                // リンクが取得できているか
                dump($link);

                // URLにアクセス
                $driver->get($link);

                // ページタイトルにyahooニュースが現れるまで待機
                $driver->wait()->until(WebDriverExpectedCondition::titleContains('Yahoo!ニュース'));


                // 記事のタイトルをクローリング
                $article_title = $driver->findElement(WebDriverBy::cssSelector('p.sc-faswKr'))->getText();

                // 記事のタイトルが取得できているか
                dump($article_title);
            }

            // 処理終了
            return;
        } catch (\Exception $e) {
            echo 'エラーによりスクレイピングが失敗しました。ERROR MESSAGE : '.$e->getMessage().' TRACE : '.$e->getTraceAsString();
        } finally {
            if (!empty($driver)) {
                $driver->quit();
            }

        }

        // $driverPath = realpath("/usr/local/bin/chromedriver");
        // putenv("webdriver.chrome.driver=" . $driverPath);

        // // chrome option
        // $options = new ChromeOptions();
        // $options->addArguments([
        //     'disable-infobars',
        //     '--headless',
        //     //'start-maximized',
        //     'window-size=1920,1600',
        // ]);

        // $capabilitites = DesiredCapabilities::chrome();
        // $capabilitites->setCapability(ChromeOptions::CAPABILITY, $options);
        // $driver = ChromeDriver::start($capabilitites);

        // // googleのページ取得
        // $driver->get('https://www.google.co.jp/');
        // // 表示されるまで待つ
        // $driver->wait(2)->until(
        //     WebDriverExpectedCondition::presenceOfElementLocated(WebDriverBy::name('q'))
        // );

        // // フォームに文字列を入力して検索実行
        // $element = $driver->findElement(WebDriverBy::name('q'))
        //     ->sendKeys('うっかりさん　困った時の備忘録')
        //     ->submit();

        // // 表示されるまで待つ
        // $driver->wait(3)->until(WebDriverExpectedCondition::titleContains('うっかりさん'));

        // // キャプチャをとる
        // $file = __DIR__."/sample.png";
        // $driver->takeScreenshot($file);

        // // ブラウザを閉じる
        // $driver->quit();

        return 0;
    }
}
