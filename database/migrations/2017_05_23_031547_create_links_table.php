<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Create Links table
        Schema::create('links', function (Blueprint $table) {
            $table->increments('id');
            $table->string('url')->unique();
            $table->string('cover')->nullable();
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->string('short_url')->nullable();
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
        Schema::dropIfExists('links');
    }
}

