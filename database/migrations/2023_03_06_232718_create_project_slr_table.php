<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_slr', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid_project_slr');
            $table->integer('project_id');
            $table->integer('category_id');
            $table->string('code', 5);
            $table->text('title'); 
            $table->string('publisher', 50);
            $table->text('publication');
            $table->string('year', 10);
            $table->string('type', 20);
            $table->integer('cited');
            $table->text('authors', 50);
            $table->text('abstracts');
            $table->text('keywords');
            $table->text('references')->nullable();
            $table->enum('snowball', ['yes', 'no'])->default('no');
            $table->string('reference_source')->nullable();
            $table->integer('created_by');
            $table->timestamp('created_at')->nullable();
            $table->integer('updated_by')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->integer('deleted_by')->nullable();
            $table->timestamp('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('project_slr');
    }
};
