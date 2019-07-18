<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIoLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('io_log', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('uid')->comment('用户id');
            $table->bigInteger('in_time')->comment('进入房间时的UNIX时间戳');
            $table->bigInteger('out_time')->default(0)->comment('离开房间时的UNIX时间戳');
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
        Schema::dropIfExists('io_log');
    }
}
