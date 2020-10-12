<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeletedDocumentsTrackerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deleted_documents_tracker', function (Blueprint $table) {
            $table->id();
            $table->integer('deleted_id');
            $table->integer('tree_id');
            $table->enum('document_type', ['صادر', 'وارد']);
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
        Schema::dropIfExists('deleted_documents_tracker');
    }
}
