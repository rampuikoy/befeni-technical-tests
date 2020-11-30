<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataSourceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_source', function (Blueprint $table) {
            $table->id();
            $table->string('tag');
            $table->enum('type', ['receive','update', 'create', 'delete']);
            $table->enum('method', ['get', 'post', 'delete', 'put', 'patch']);
            $table->string('url');
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
        Schema::dropIfExists('data_source');
    }
}
