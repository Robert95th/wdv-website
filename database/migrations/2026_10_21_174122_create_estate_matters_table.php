<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('estate_matters', function (Blueprint $table) {
            $table->id();
            $table->string('estate_matter'); 
            $table->string('reference');
            $table->string('status');
            $table->string('next_action');
            $table->string('date_and_venue')->nullable(); // Nullable in case some don't have a date yet
            
            // The two new requested columns
            $table->date('expiry_date')->nullable();
            $table->boolean('view_status')->default(true); // true = public/visible, false = hidden
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('estate_matters');
    }
};