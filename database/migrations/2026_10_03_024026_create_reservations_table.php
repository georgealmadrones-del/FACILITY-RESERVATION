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
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('resource_name');
            $table->string('resource_type'); // 'facility' or 'equipment'
            $table->string('category'); // 'rooms', 'labs', 'equipment'
            $table->dateTime('start_time');
            $table->dateTime('end_time');
            $table->integer('quantity_or_attendees')->default(1);
            $table->text('purpose');
            $table->string('status')->default('PENDING'); // PENDING, APPROVED, ACTIVE, RETURNED, CANCELLED
            $table->timestamp('returned_at')->nullable();
            $table->timestamps();
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