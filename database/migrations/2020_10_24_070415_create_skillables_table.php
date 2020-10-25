<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSkillablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('skillables', function (Blueprint $table) {
            $table->boolean('is_main')->default(false);
            $table->timestamps();
             //FK
             $table->foreignId('skill_id')->constrained('skills', 'id');
             $table->foreignId('skillable_id');
             $table->string('skillable_type');
             //PK
             $table->primary(['skill_id', 'skillable_id', 'skillable_type'], 'skillables_triple_primary');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('skillables');
    }
}
