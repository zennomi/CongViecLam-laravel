<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('username')->nullable();
            $table->string('email')->unique();
            $table->string('password')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('image')->default('backend/image/default.png');
            $table->enum('role', ['company', 'candidate'])->default('candidate');
            $table->boolean('recent_activities_alert')->default(true);
            $table->boolean('job_expired_alert')->default(true);
            $table->boolean('new_job_alert')->default(true);
            $table->boolean('shortlisted_alert')->default(true);
            $table->boolean('status')->default(true);
            $table->boolean('is_demo_field')->default(false);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
