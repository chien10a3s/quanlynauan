<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('table', 255)->comment('Ten bang');
            $table->bigInteger('item_id')->comment('Id cua table');
            $table->longText('data')->comment('Mo ta');
            $table->tinyInteger('action_type')->comment('0: Them, 1: Sua, 2: Xoa, 4: Tru tien');
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
        //
    }
}
