<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImageablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('imageables', function (Blueprint $table) {
            $table->boolean('is_main')->nullable()->default(false);
            $table->boolean('is_shown')->nullable()->default(true);
            $table->boolean('is_logo')->nullable()->default(false);
            $table->timestamps();
            //FK
            $table->foreignId('image_id')->constrained('images', 'id');
            $table->foreignId('imageable_id');
            $table->string('imageable_type');
            //PK
            $table->primary(['image_id', 'imageable_id', 'imageable_type'], 'imageables_triple_primary');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('imageables');
    }
}
