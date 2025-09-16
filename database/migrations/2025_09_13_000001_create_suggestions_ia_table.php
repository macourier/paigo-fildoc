<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuggestionsIaTable extends Migration
{
    public function up()
    {
        Schema::create('suggestions_ia', function (Blueprint $table) {
            $table->id();
            $table->string('label');
            $table->string('action');
            $table->json('payload');
            $table->float('confidence')->nullable();
            $table->foreignId('company_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('suggestions_ia');
    }
}
