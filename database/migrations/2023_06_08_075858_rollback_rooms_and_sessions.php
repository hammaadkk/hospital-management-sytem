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
    Schema::dropIfExists('rooms');
    
    Schema::create('sessions', function (Blueprint $table) {
        // Define the session table columns here
        $table->id();
        // ...
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
    Schema::dropIfExists('sessions');
    
    Schema::create('rooms', function (Blueprint $table) {
        // Define the rooms table columns here
        $table->id();
        // ...
        $table->timestamps();
    });
}

};
