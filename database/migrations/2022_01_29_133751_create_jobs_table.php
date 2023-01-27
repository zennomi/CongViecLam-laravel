<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained('companies')->cascadeOnDelete();
            $table->foreignId('category_id')->constrained('job_categories')->cascadeOnDelete();
            $table->foreignId('role_id')->constrained('job_roles')->cascadeOnDelete();
            $table->foreignId('experience_id')->constrained('experiences')->cascadeOnDelete();
            $table->foreignId('education_id')->constrained('education')->cascadeOnDelete();
            $table->foreignId('job_type_id')->constrained('job_types')->cascadeOnDelete();
            $table->foreignId('salary_type_id')->constrained('salary_types')->cascadeOnDelete();
            $table->string('title');
            $table->string('slug')->nullable();
            $table->string('vacancies');
            $table->integer('min_salary');
            $table->integer('max_salary');
            $table->date('deadline')->nullable();
            $table->longText('description');
            $table->enum('status', ['pending', 'active', 'expired'])->default('pending');
            $table->enum('apply_on', ['app', 'email', 'custom_url'])->default('app');
            $table->string('apply_email')->nullable();
            $table->string('apply_url')->nullable();
            $table->boolean('featured')->default(0);
            $table->boolean('highlight')->default(0);
            $table->boolean('is_remote')->default(0);
            $table->unsignedBigInteger('total_views')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jobs');
    }
}
