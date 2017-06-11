<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFeebacksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('feedbacks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('id_kitchen')->comment('id kitchen')->comment="ID cua bep";
            $table->date('date')->comment="Ngay phan hoi";
            $table->bigInteger('parent_id')->nullable()->comment="ID cua feeback. 2 cap";
            $table->text('title')->comment="Tieu de";
            $table->longText('content')->comment="Noi dung phan hoi";
            $table->tinyInteger('status')->default(1)->comment="Trang thai kich hoat. 0: Chua kich hoat; 1: Kich hoat";

            $table->integer('created_by');
            $table->integer('updated_by');
            //Index
            $table->index(['id_kitchen','parent_id','created_by','status'],'index_data');


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
