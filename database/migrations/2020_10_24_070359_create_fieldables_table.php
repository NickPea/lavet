<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFieldablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fieldables', function (Blueprint $table) {
            $table->boolean('is_main')->default(false);
            $table->timestamps();
            //FK
            $table->foreignId('field_id')->constrained('fields', 'id');
            $table->foreignId('fieldable_id');
            $table->string('fieldable_type');
            //PK
            $table->primary(['field_id', 'fieldable_id', 'fieldable_type'], 'fieldables_triple_primary');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fieldables');
    }
}
