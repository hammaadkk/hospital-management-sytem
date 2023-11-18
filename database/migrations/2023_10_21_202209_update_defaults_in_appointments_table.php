<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('appointments', function (Blueprint $table) {
            // Change 'Is_Deleted' and 'Is_Completed' columns to 'boolean'
            $table->boolean('Is_Deleted')->default(0)->change();
            $table->boolean('Is_Completed')->default(0)->change();
        });
    }

    public function down()
    {
        Schema::table('appointments', function (Blueprint $table) {
            // Define how to revert the changes if necessary
            $table->boolean('Is_Deleted')->default(0)->change();
            $table->boolean('Is_Completed')->default(0)->change();
        });
    }
};
