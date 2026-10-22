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
        Schema::create('service_requests', function (Blueprint $table) {
        $table->id();
        $table->string('service'); // To store which service they clicked on
        $table->string('name');
        $table->string('email');
        $table->string('phone');
        $table->dateTime('preferred_datetime')->nullable(); // For the Date and Time field
        $table->text('message')->nullable(); // In case you add a message field later
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_requests');
    }
};
