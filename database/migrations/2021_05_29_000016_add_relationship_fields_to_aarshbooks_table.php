<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToAarshbooksTable extends Migration
{
    public function up()
    {
        Schema::table('aarshbooks', function (Blueprint $table) {
            $table->unsignedBigInteger('language_id');
            $table->foreign('language_id', 'language_fk_4031819')->references('id')->on('languages');
            $table->unsignedBigInteger('created_by_id')->nullable();
            $table->foreign('created_by_id', 'created_by_fk_4031824')->references('id')->on('users');
        });
    }
}
