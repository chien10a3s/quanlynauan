<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlogPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blog_posts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->unique();
            $table->string('featured_image', 255)->nullable();
            $table->longText('content');
            $table->longText('excerpt')->nullable();
            $table->string('slug')->unique();
            
            $table -> integer('author_id') -> unsigned() -> default(0);
            $table->foreign('author_id')
              ->references('id')->on('users')
              ->onDelete('cascade');
            
            $table->integer('blog_id') -> unsigned() -> default(0);
            $table->foreign('blog_id')
              ->references('id')->on('blogs')
              ->onDelete('cascade');
            
            $table->longText('tags')->nullable();
            
            $table->string('meta_description', 255)->nullable();
            $table->string('meta_keywords', 255)->nullable();
            
            $table->boolean('active');
            
            
            
            
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
        Schema::dropIfExists('blog_posts');
    }
}
