<?php

use App\Models\Profession;
use App\Models\Nationality;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCandidatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candidates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('role_id')->nullable()->constrained('job_roles')->cascadeOnDelete();
            $table->foreignId('profession_id')->nullable()->constrained('professions')->cascadeOnDelete();
            $table->foreignId('experience_id')->nullable()->constrained('experiences')->cascadeOnDelete();
            $table->foreignId('education_id')->nullable()->constrained('education')->cascadeOnDelete();
            $table->foreignIdFor(Nationality::class, 'nationality_id')->nullable()->constrained()->cascadeOnDelete();
            $table->string('title')->nullable();
            $table->enum('gender', ['male', 'female', 'other'])->nullable();
            $table->string('website')->nullable();
            $table->string('photo')->nullable();
            $table->string('cv')->nullable();
            $table->text('bio')->nullable();
            $table->string('marital_status')->nullable();
            $table->datetime('birth_date')->nullable();
            $table->boolean('visibility')->default(1);
            $table->boolean('cv_visibility')->default(1);
            $table->boolean('received_job_alert')->default(1);
            $table->integer('profile_complete')->default(100);
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
        Schema::dropIfExists('candidates');
    }
}
