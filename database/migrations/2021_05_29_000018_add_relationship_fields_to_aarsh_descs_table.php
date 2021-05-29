<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToAarshDescsTable extends Migration
{
    public function up()
    {
        Schema::table('aarsh_descs', function (Blueprint $table) {
            $table->unsignedBigInteger('chapter_title_id');
            $table->foreign('chapter_title_id', 'chapter_title_fk_4031844')->references('id')->on('aarshchapters');
            $table->unsignedBigInteger('created_by_id')->nullable();
            $table->foreign('created_by_id', 'created_by_fk_4031849')->references('id')->on('users');
        });
    }
}
