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
        Schema::table('sessions', function (Blueprint $table) {
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }
    

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
{
    Schema::table('sessions', function (Blueprint $table) {
        $table->dropColumn(['user_id', 'ip_address', 'user_agent', 'payload', 'last_activity']);
    });
}

};