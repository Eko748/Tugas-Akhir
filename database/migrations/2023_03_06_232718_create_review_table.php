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
        Schema::create('scraped_data', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->uuid('uuid_scrape');
            $table->integer('project_id');
            $table->integer('category_id');
            $table->string('code', 5);
            $table->text('title'); 
            $table->string('publisher', 150);
            $table->text('publication');
            $table->string('year', 30);
            $table->string('type', 50);
            $table->integer('cited');
            $table->text('authors');
            $table->text('abstracts');
            $table->text('keywords');
            $table->text('references')->nullable();
            $table->text('link');
            // $table->enum('snowball', ['yes', 'no'])->default('no');
            $table->string('reference_source', 10)->nullable();
            $table->integer('created_by');
            $table->timestamp('created_at')->nullable();
            $table->integer('updated_by')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->integer('deleted_by')->nullable();
            $table->timestamp('deleted_at')->nullable();
            $table->foreign('project_id')->references('id')->on('project')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('review');
    }
};
