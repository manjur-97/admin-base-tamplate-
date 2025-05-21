<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('user_name')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('phone')->nullable();
            $table->rememberToken();
            $table->foreignId('current_team_id')->nullable();
            $table->string('image', 2048)->nullable();
            $table->string('coverpic', 2048)->nullable();
            $table->string('location', 255)->nullable();
            $table->string('job_title', 255)->nullable();
            $table->string('social_link', 255)->nullable();
            $table->string('description_en', 1500)->nullable();
            $table->string('description_bn', 1500)->nullable();
            $table->enum('user_type', ['Instructor', 'Learner', 'Staff'])->default('Learner');
            $table->enum('status', ['Active', 'Inactive', 'Deleted'])->default('Active');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
