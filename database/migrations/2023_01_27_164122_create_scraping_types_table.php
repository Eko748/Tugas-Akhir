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
        Schema::create('scraping_types', function (Blueprint $table) {
            $table->id();
            $table->string('type_code', 7);
            $table->string('type_name', 50);
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
        Schema::dropIfExists('scraping_types');
    }
};
