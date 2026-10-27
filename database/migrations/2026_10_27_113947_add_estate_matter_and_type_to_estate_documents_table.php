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
        Schema::table('estate_documents', function (Blueprint $table) {
            $table->foreignId('estate_matter_id')->nullable()->constrained('estate_matters')->onDelete('cascade');
            $table->string('document_type')->default('Other');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('estate_documents', function (Blueprint $table) {
            //
        });
    }
};
