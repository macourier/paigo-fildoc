<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class DropSuggestionsIaTable extends Migration
{
    public function up()
    {
        Schema::dropIfExists('suggestions_ia');
    }

    public function down()
    {
        // no-op
    }
}
