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
            $table->dateTime('send_date')->nullable();
            $table->string('airline')->nullable();
            $table->float('weight')->nullable();
            $table->string('comment')->nullable();
            $table->boolean('current_flag')->default(false);
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
