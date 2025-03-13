<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectTasksTable extends Migration
{
    public function up()
    {
        Schema::create('project_tasks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('project_id');
            $table->string('owner');
            $table->text('description_task');
            $table->date('start_date');
            $table->date('finish_date');
            $table->dateTime('task_date')->nullable();
            $table->enum('task_state', ['Pending', 'In Progress', 'Completed', 'Blocked'])->default('Pending');
            $table->timestamps();

            $table->foreign('project_id')->references('id')->on('tasks')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('project_tasks');
    }
}
