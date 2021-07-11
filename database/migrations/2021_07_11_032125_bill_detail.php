<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class BillDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('bills_details', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('bill_id')->unsigned()->index();
            $table->foreign('bill_id')->references('id')->on('bills')->onDelete('cascade');
            $table->bigInteger('products')->unsigned()->index();
            $table->foreign('products')->references('id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
