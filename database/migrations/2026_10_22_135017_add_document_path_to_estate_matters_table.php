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
        Schema::table('estate_matters', function (Blueprint $table) {
        // We will use 'document_path' instead of 'file_link'
        $table->string('document_path')->nullable()->after('view_status');
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('estate_matters', function (Blueprint $table) {
            //
        });
    }
};
