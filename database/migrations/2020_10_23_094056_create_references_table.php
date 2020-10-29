<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReferencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('references', function (Blueprint $table) {
            $table->id();
            $table->text('body');
            $table->boolean('is_shown')->default(false);
            $table->timestamps();
            //FK
            $table->foreignId('user_id')->constrained('users', 'id');
            $table->foreignId('profile_id')->constrained('profiles', 'id');
            //PK
            $table->unique(['user_id', 'profile_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('references');
    }
}
