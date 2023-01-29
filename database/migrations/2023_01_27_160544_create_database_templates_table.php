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
        Schema::create('database_templates', function (Blueprint $table) {
            $table->id();
            $table->integer('category_id');
            $table->string('code', 7)->unique();
            $table->string('icon', 50);
            $table->string('title', 50);
            $table->string('publication', 50);
            $table->string('year', 50);
            $table->string('authors', 50);
            $table->string('abstracts', 50);
            $table->string('keywords', 50);
            $table->string('type', 50);
            $table->string('publisher', 50);
            $table->string('references', 50);
            $table->string('bahasa', 50);
            $table->string('cited', 50);
            $table->string('citing', 50);
            $table->integer('created_by');
            $table->timestamp('created_at')->nullable();
            $table->integer('updated_by');
            $table->timestamp('updated_at')->nullable();
            $table->integer('deleted_by');
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
        Schema::dropIfExists('database_templates');
    }
};
