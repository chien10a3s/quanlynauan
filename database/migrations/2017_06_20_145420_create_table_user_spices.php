<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableUserSpices extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_spices', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_kitchen');
            $table->integer('id_food');
            $table->integer('status')->default(1)->comment('0:Hết, 1:Sắp hết, 2:Còn, 3:hủy không dùng');
            $table->integer('buy')->default(0)->comment('1:Đang đợi mua thêm');
            $table->integer('created_by');
            $table->integer('updated_by');
            $table->rememberToken();
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
        //
    }
}
