<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToAarshgranthsTable extends Migration
{
    public function up()
    {
        Schema::table('aarshgranths', function (Blueprint $table) {
            $table->unsignedBigInteger('aarsh_book_id');
            $table->foreign('aarsh_book_id', 'aarsh_book_fk_4031828')->references('id')->on('aarshbooks');
            $table->unsignedBigInteger('created_by_id')->nullable();
            $table->foreign('created_by_id', 'created_by_fk_4031842')->references('id')->on('users');
        });
    }
}
