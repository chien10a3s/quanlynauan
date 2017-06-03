<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetailDishsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Món ăn hàng ngày
        Schema::create('detail_dishs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_daily_dish')->comment('id kitchen');
            $table->string('name')->index();
            $table->integer('number')->default(0);
            $table->string('unit')->default(0);
            $table->decimal('money')->default(0);
            $table->tinyInteger('status')->default(0)->comment('0 :Gia vi,1:Thuc pham');
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
        Schema::dropIfExists('detail_dishs');
    }
}
