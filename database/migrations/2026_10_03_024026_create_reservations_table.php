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
    Schema::create('reservations', function (Blueprint $table) {
    id();
    foreignId('user_id')->constrained()->onDelete('cascade');
    string('resource_name');
    string('resource_type'); // 'facility' or 'equipment'
    string('category'); // 'rooms', 'labs', 'equipment'
    dateTime('start_time');
    dateTime('end_time');
    integer('quantity_or_attendees')->default(1);
    text('purpose');
    string('status')->default('PENDING'); // PENDING, APPROVED, ACTIVE, RETURNED, CANCELLED
    timestamp('returned_at')->nullable();
    timestamps();
});
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
