<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAarshchaptersTable extends Migration
{
    public function up()
    {
        Schema::create('aarshchapters', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('arshchapter_no');
            $table->string('arshchapter_title');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
