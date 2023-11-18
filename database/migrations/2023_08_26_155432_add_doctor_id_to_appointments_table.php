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
        Schema::table('appointments', function (Blueprint $table) {
            // Add the doctor_id column after the doctor column
            $table->unsignedBigInteger('doctor_id')->nullable()->after('doctor');
            $table->foreign('doctor_id')->references('id')->on('doctors');
        });

        // Update the doctor_id values based on the doctor column
        $appointments = DB::table('appointments')->get();
        foreach ($appointments as $appointment) {
            $doctorId = DB::table('doctors')
                ->where('name', $appointment->doctor)
                ->value('id');

            DB::table('appointments')
                ->where('id', $appointment->id)
                ->update(['doctor_id' => $doctorId]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('appointments', function (Blueprint $table) {
            $table->dropForeign(['doctor_id']);
            $table->dropColumn('doctor_id');
        });
    }
};
