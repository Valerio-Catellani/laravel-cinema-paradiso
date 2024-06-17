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
            $table->unsignedBigInteger('slot_id')->nullable()->after('id');
            $table->foreign('slot_id')->references('id')->on('slots')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('movie_room', function (Blueprint $table) {
            $table->dropForeign('movie_room_slot_id_foreign');
            $table->dropColumn('slot_id');
        });
    }
};
