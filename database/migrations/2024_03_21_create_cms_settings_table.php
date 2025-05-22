<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('cms_settings', function (Blueprint $table) {
            $table->id();
            $table->text('header')->nullable();
            $table->text('footer')->nullable();
            $table->text('form')->nullable();
            $table->text('gallery')->nullable();
            $table->text('slider')->nullable();
            $table->text('page_header')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('cms_settings');
    }
};
