<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameMinilotoResultToMinilotoResults extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       // Schema::rename('変更前のテーブル名', '変更後のテーブル名');
        // という形でテーブル名の変更を指定します。
        Schema::rename('miniloto_result', 'miniloto_results');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('miniloto_results', function (Blueprint $table) {
            //
        });
    }
}
