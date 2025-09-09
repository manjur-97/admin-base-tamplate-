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
        Schema::create('header_configurations', function (Blueprint $table) {
            $table->id();
            $table->boolean('topbar_enabled')->default(true);
            $table->string('topbar_phone', 20)->nullable();
            $table->string('topbar_email', 100)->nullable();
            $table->boolean('sticky_enabled')->default(true);
            $table->boolean('search_enabled')->default(false);
            $table->string('cta_button_text', 100)->nullable();
            $table->string('cta_button_url', 500)->nullable();
            $table->boolean('cta_button_enabled')->default(true);
            $table->boolean('login_button_enabled')->default(true);
            $table->string('primary_color', 7)->default('#2563eb');
            $table->string('secondary_color', 7)->default('#1d4ed8');
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
        Schema::dropIfExists('header_configurations');
    }
};
