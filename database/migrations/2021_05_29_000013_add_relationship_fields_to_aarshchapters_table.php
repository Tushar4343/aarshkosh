<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToAarshchaptersTable extends Migration
{
    public function up()
    {
        Schema::table('aarshchapters', function (Blueprint $table) {
            $table->unsignedBigInteger('granth_title_id');
            $table->foreign('granth_title_id', 'granth_title_fk_4031835')->references('id')->on('aarshgranths');
            $table->unsignedBigInteger('created_by_id')->nullable();
            $table->foreign('created_by_id', 'created_by_fk_4031841')->references('id')->on('users');
        });
    }
}
