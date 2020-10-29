<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('locations', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            //FK
            $table->foreignId('country_id')->nullable()->constrained('countries', 'id');
            $table->foreignId('area_code_id')->nullable()->constrained('area_codes', 'id');
            $table->foreignId('province_id')->nullable()->constrained('provinces', 'id');
            $table->foreignId('city_id')->nullable()->constrained('cities', 'id');
            $table->foreignId('township_id')->nullable()->constrained('townships', 'id');
            //PK
            $table->unique(['country_id', 'area_code_id', 'province_id', 'city_id', 'township_id'], 'locations_parents_unique');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('locations');
    }
}
