<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user', function (Blueprint $table) {
            $table->bigIncrements('id')->comment('uid');
            $table->string('name', 32)->comment('名字');
            $table->string('pass', 256)->comment('密码hash');
            $table->string('no', 32)->unique()->comment('用户号码（学号或工号）');
            $table->integer('level')->comment('用户等级');
            $table->bigInteger('totalTime')->default(0)->comment('统计在线时间');
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
        Schema::dropIfExists('user');
    }
}
