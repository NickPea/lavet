<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployTypeListingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employ_type_listing', function (Blueprint $table) {
            $table->timestamps();
            //FK
            $table->foreignId('employ_type_id')->constrained('employ_types', 'id');
            $table->foreignId('listing_id')->constrained('listings', 'id');
            //PK
            $table->primary(['employ_type_id', 'listing_id']);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employ_type_listing');
    }
}
