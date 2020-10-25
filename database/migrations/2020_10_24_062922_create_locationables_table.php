<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocationablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('locationables', function (Blueprint $table) {
            $table->string('description')->nullable();
            $table->boolean('is_main')->default(false);
            $table->timestamps();
            //FK
            $table->foreignId('location_id')->constrained('locations', 'id');
            $table->foreignId('locationable_id');
            $table->string('locationable_type');
            //PK
            $table->primary(['location_id', 'locationable_id', 'locationable_type'], 'locationables_triple_primary');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('locationables');
    }
}
