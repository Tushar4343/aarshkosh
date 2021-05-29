<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAarshgranthsTable extends Migration
{
    public function up()
    {
        Schema::create('aarshgranths', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('arshbook_no');
            $table->string('arshbook_title');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
