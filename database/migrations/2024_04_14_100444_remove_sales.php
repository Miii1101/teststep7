<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveTimestampsFromSales extends Migration
{
    public function up()
    {
        Schema::table('sales', function (Blueprint $table) {
            $table->dropTimestamps();
        });
    }

    public function down()
    {
        Schema::table('sales', function (Blueprint $table) {
            // down メソッドでは、元の状態に戻す必要がないため、このメソッドの内容は空にする
        });
    }
}