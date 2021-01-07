<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->string('subject')->nullable();
            $table->text('body');
            $table->dateTime('read_at')->nullable();
            
            $table->timestamps();
            //FK
            $table->foreignId('author_id')->constrained('users', 'id');
            $table->foreignId('parent_id')->nullable()->constrained('messages', 'id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('messages');
    }
}
