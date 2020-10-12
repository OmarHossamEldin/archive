<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->string('serial');
            $table->enum('type', ['صادر', 'وارد']);
            $table->integer('type_id');
            $table->string('description')->nullable();
            $table->dateTime('date');
            $table->foreignId('organization_id')->constrained('organizations')->onDelete('restrict');
            $table->foreignId('subject_id')->constrained('subjects')->onDelete('restrict');
            $table->foreignId('suit_cases_id')->constrained('suit_cases')->onDelete('restrict');
            $table->string('file_path')->nullable();

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
        Schema::dropIfExists('documents');
    }
}
