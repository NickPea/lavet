<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessageActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('message_activities', function (Blueprint $table) {
            $table->id();
            $table->dateTime('read_at')->nullable();
            $table->timestamps();
            //FK
            $table->foreignId('recipient_id')->constrained('users', 'id');
            $table->foreignId('message_id')->constrained('messages', 'id');
            //PK
            $table->unique(['recipient_id', 'message_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('message_activities');
    }
}
