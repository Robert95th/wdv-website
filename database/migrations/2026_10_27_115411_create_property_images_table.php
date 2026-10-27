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
         Schema::create('property_images', function (Blueprint $table) {
        $table->id();
        $table->foreignId('property_listing_id')->constrained('property_listings')->onDelete('cascade');
        $table->string('image_path');
        $table->boolean('is_primary')->default(false); // To mark the main thumbnail
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('property_images');
    }
};
