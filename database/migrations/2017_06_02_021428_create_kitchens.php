<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKitchens extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kitchens', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code')->unique();
            $table->string('name', 255)->nullable();
            $table->tinyInteger('status'    )->comment('0: Locked; 1: Active');
            $table->decimal('money',10,2)->comment('money of Kitchen');
            $table->string('address')->nullable()->comment('address of Kitchen');
            $table->string('avatar')->nullable()->comment('avatar of Kitchen');
            $table->string('note')->nullable();
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
