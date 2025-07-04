<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('calendar', function (Blueprint $table) {
            $table -> id();
            $table -> string('name');
            $table -> string('doctor');
            $table -> string('clinic_id');
            $table -> string('time');
            $table -> text('requirements');
            $table -> string('price');
            $table -> string('number');
            $table -> string('payment_way');
            $table -> string('timeofwork');
            $table -> string("payment_status");
            $table -> string("introduce_way");

            $table -> timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
