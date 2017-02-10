<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRFIsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rfis', function (Blueprint $table) {
            $table->increments('id');
            $table->text('subject');
            $table->text('slug');
            $table->text('body');
            $table->integer('control_number');
            $table->integer('project_id');
            $table->foreign('project_id')->references('id')->on('projects');
            
            $table->integer('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            
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
        Schema::dropIfExists('rfis');
    }
}
