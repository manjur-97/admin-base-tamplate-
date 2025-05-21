<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
        Schema::create('commands', function (Blueprint $table) {
            $table->id(); 
            $table->string('model'); 
            $table->string('controller'); 
            $table->string('database_table');
            $table->date('created_at'); 
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP')); 
            $table->timestamp('deleted_at')->nullable(); 
            $table->string('status')->default('Active'); 
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
