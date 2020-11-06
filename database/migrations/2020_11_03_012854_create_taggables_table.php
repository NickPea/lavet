<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaggablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('taggables', function (Blueprint $table) {
            $table->timestamps();
            //FK
            $table->foreignId('tag_id')->constrained('tags', 'id');
            $table->foreignId('taggable_id');
            $table->string('taggable_type');
            //PK
            $table->primary(['tag_id', 'taggable_id', 'taggable_type'], 'taggables_triple_primary');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('taggables');
    }
}
