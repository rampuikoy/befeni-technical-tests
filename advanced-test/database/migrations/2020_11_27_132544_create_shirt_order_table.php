<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShirtOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shirt_order', function (Blueprint $table) {
            $table->id();
            $table->integer('customer_id');
            $table->integer('fabric_id');
            $table->integer('collar_size');
            $table->integer('chest_size');
            $table->integer('waist_size');
            $table->integer('wrist_size');
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
        Schema::dropIfExists('shirt_order');
    }
}
