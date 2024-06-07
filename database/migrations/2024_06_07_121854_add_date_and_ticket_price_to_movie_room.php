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
        Schema::table('movie_room', function (Blueprint $table) {
            $table->date('date')->after('room_id')->nullable(); //YY-MM-DD
            // $table->dateTime('time'); YY-MM-DD HH:MM
            // $table->time('time'); HH:MM
            $table->float('final_ticket_price', 4, 2)->after('room_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('movie_room', function (Blueprint $table) {
            $table->dropColumn(['date', 'final_ticket_price']);
        });
    }
};
