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
        Schema::create('institute', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->integer('leader_id');
            $table->string('institute_name', 50);
            $table->integer('created_by');
            $table->timestamp('created_at')->nullable();
            $table->foreign('leader_id')->references('id')->on('leader')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('institute');
    }
};
