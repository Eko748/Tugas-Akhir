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
        Schema::create('database_scrapings', function (Blueprint $table) {
            $table->id();
            $table->integer('database_id');
            $table->string('code', 7)->unique();
            $table->integer('type');
            $table->string('link')->unique();
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
        Schema::dropIfExists('database_scrapings');
    }
};
