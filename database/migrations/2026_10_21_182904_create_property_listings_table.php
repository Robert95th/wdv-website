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
    Schema::create('property_listings', function (Blueprint $table) {
        $table->id();
        $table->string('category'); // Residential, Farmland, Commercial, Vehicles, Movables, Other
        $table->string('title');
        $table->text('description');
        $table->string('auctioneer')->nullable();
        $table->string('date_and_time')->nullable();
        $table->string('venue')->nullable();
        $table->string('image')->nullable(); // For when you add photos later
        $table->timestamps();
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('property_listings');
    }
};
