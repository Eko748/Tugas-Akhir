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
        Schema::create('project', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->uuid('uuid_project');
            $table->integer('leader_id');
            // $table->string('subject');
            // $table->string('priority', 2);
            // $table->integer('target')->nullable()->default('10');
            // $table->text('description')->nullable();
            // $table->integer('status');
            // $table->timestamp('start_date')->nullable();
            // $table->timestamp('end_date')->nullable();
            $table->integer('created_by');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            // $table->integer('updated_by')->nullable();
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
        Schema::dropIfExists('project');
    }
};
