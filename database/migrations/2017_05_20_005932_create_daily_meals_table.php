<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDailyMealsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //phieu thuc an theo ngay
        Schema::create('daily_meals', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code')->unique();
            $table->integer('id_kitchen')->comment('id kitchen')->index();
            $table->date('day');
            $table->integer('number_of_meals');
            $table->decimal('money_meals', 10,2)->default(0);
            $table->tinyInteger('status')->comment('0:new ;1:active; 2:cancel');
            $table->integer('id_parent')->default(0)->comment('1 :create by job');
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
        Schema::dropIfExists('daily_meals');
    }
}
