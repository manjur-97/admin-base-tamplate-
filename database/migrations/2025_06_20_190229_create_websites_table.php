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
        Schema::create('websites', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tanent_id');
            $table->unsignedBigInteger('category_id');
            $table->string('logo')->nullable();
            $table->string('title')->nullable();
            $table->string('slug')->unique();
            $table->string('description')->nullable();
            $table->string('email')->nullable();
            $table->string('mobile')->nullable();
            $table->string('address')->nullable();
            $table->string('facebook')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('youtube')->nullable();
            $table->string('twitter')->nullable();
            $table->string('instagram')->nullable();
            $table->string('git')->nullable();
            $table->enum('status', ['active', 'inactive', 'deleted'])->default('active');
            $table->softDeletes();
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
        Schema::dropIfExists('websites');
    }
};
