<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlestatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles_status', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('userid');
            $table->integer('articleid');
            $table->enum('likes', ['0', '1']);
            $table->enum('dislikes', ['0', '1']);
            $table->enum('blocked', ['0', '1']);
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
        Schema::dropIfExists('articles_status');
    }
}
