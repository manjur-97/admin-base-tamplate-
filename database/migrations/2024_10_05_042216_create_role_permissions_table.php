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
        Schema::create('role_permissions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('role_id')->nullable(); 
            $table->string('uri'); 
            $table->string('name'); 
            $table->string('controller_function'); 
            $table->string('method'); 
            $table->string('controller_name'); 
            $table->timestamps(); 

            $table->foreign('role_id')->references('id')->on('roles')->onDelete('set null');
        });
    }
 
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('role_permissions');
    }
};
