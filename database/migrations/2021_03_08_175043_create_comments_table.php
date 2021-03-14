<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('publication_id');
            $table->unsignedBigInteger('comment_state_id');

            $table->text('content');

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('publication_id')->references('id')->on('publications')->onDelete('cascade');
            $table->foreign('comment_state_id')->references('id')->on('comment_states');

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
        Schema::dropIfExists('comments');
    }
}
