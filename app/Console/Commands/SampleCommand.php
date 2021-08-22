<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

/**
 * サンプルコマンド
 * php artisan make:command SampleCommand
 *
 * app/Console/Kernel.phpの$commands配列に、作成したクラスを追加
 *
 * $signature がコマンド名
 * php artisan sample:sample で実行
 */
class SampleCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sample:sample';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $this->info('start');
        $this->info('end');
        return 0;
    }
}
