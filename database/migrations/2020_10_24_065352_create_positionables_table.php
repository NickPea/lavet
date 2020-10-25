<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePositionablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('positionables', function (Blueprint $table) {
            $table->boolean('is_main')->default(false);
            $table->timestamps();
            //FK
            $table->foreignId('position_id')->constrained('positions', 'id');
            $table->foreignId('positionable_id');
            $table->string('positionable_type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('positionables');
    }
}
