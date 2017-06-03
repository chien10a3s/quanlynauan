<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDailyDishsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Món ăn hàng ngày
        Schema::create('daily_dishs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code')->unique();
            $table->integer('id_daily_meal')->comment('id kitchen');
            $table->string('name')->index();
            $table->string('cooking_note');
            $table->string('note', 10,2)->default(0);
            $table->tinyInteger('status')->comment('0:new ;1:active; 2:cancel');
            $table->integer('id_parent')->default(0)->comment('0 :Không yêu cầu món,Có yêu cầu món ');
            $table->integer('created_by');
            $table->integer('updated_by');
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
        Schema::dropIfExists('daily_dishs');
    }
}
