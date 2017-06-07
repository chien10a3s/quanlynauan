<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFoodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('food', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 255);
            $table->longText('description');
            $table->string('image', 255);
            $table->string('unit', 255);
            $table->decimal('quantity',10,2);
            $table->integer('id_category'); 
            $table->integer('id_supplier'); 
            $table->decimal('price',10,2);
            $table->tinyInteger('status');
            $table->integer('created_by');
            $table->integer('updated_by');
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
