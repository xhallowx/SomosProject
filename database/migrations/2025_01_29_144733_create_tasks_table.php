<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('name_project');
            $table->string('owner');
            $table->string('request_area');
            $table->enum('priority', ['Low', 'Medium', 'High']);
            $table->date('request_date');
            $table->date('start_date')->nullable();
            $table->date('finish_date')->nullable();
            $table->text('project_description');
            $table->enum('project_state', ['Pending', 'In Progress', 'Completed'])->default('Pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
