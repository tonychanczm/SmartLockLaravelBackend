<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOpLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('op_log', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('type')->comment('操作类型ID');
            $table->bigInteger('op_time')->comment('执行操作时的时间戳');
            $table->text('data')->nullable()->comment('执行操作时可能涉及到的数据(json格式)');
            $table->text('msg')->nullable()->comment('执行操作时可能涉及到的信息');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('op_log');
    }
}
