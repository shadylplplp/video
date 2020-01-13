<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDanmuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('danmu', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->float('time');
            $table->string('text');
            $table->integer('type')->default(0);
            $table->integer('size');
            $table->string('color');
            $table->integer('video_id');
            $table->integer('user_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('danmu');
    }
}
