<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserKitchens extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_kitchens', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_kitchen');
            $table->integer('id_user');
            $table->integer('role');
            $table->integer('created_by');
            $table->integer('updated_by');
            $table->timestampsTz();
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
