<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFoodOversTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('food_overs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('kitchen_id')->comment('Id cua bep');
            $table->bigInteger('food_id')->comment('Id cua thuc pham');
            $table->decimal('quantity',10,2)->comment('So luong thua');
            $table->string('unit', 255)->comment('Don vi thua');
            $table->dateTime('date')->comment('Ngay bat dau thua');
            $table->longText('description')->comment('Mo ta');
            $table->tinyInteger('status')->comment('0: Dang thua, 1: Da het, 2: Huy bo khong dung nua');
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
