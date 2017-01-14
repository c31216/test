<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('pat_uname')->unique()->nullable();
            $table->string('pat_pass')->nullable();
            $table->string('pat_fname');
            $table->string('pat_lname');
            $table->decimal('weight');
            $table->decimal('height');
            $table->integer('age');
            $table->char('sex');
            $table->string('mother_name');
            $table->string('address');
            $table->date('pat_bdate');
            $table->date('registration_date');
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
        Schema::dropIfExists('posts');
    }
}
