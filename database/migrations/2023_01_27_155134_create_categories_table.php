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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            // $table->uuid('uuid_category');
            $table->string('category_code', 1);
            $table->string('category_name', 20);
            $table->timestamps();
            // $table->integer('created_by');
            // $table->integer('updated_by')->nullable();
            // $table->timestamp('updated_at')->nullable();
            // $table->integer('deleted_by')->nullable();
            // $table->timestamp('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
};
