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
        Schema::create('website_pages', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->unsignedBigInteger('menu_id')->nullable();
            $table->foreign('menu_id')
                  ->references('id')
                  ->on('website_menus')
                  ->onDelete('set null');
            $table->string('slug')->nullable();
            $table->json('components')->nullable()->comment('Stores the page components with their positions');
            $table->enum('status', ['Active', 'Inactive', 'Deleted'])->default('Active');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('website_pages');
    }
};
