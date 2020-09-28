<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuitCasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suit_cases', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->dateTime('send_date');
            $table->string('airline');
            $table->float('weight');
            $table->string('comment')->nullable();
            $table->boolean('current_flag');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('suit_cases');
    }
}
