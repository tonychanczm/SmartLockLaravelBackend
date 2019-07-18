<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditIdOnFingerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('finger', function (Blueprint $table) {
            $table->bigInteger('id')->comment('指纹号')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('finger', function (Blueprint $table) {
            $table->bigIncrements('id')->comment('指纹号')->change();
        });
    }
}
