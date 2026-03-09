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
        Schema::table('event_types', function (Blueprint $table) {
            if (!Schema::hasColumn('event_types', 'qr_code_image')) {
                $table->string('qr_code_image')->nullable();
            }
        });
        Schema::table('event_types', function (Blueprint $table) {
            if (!Schema::hasColumn('event_types', 'admin_photo')) {
                $table->string('admin_photo')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('event_types', function (Blueprint $table) {
            $table->dropColumn(['qr_code_image', 'admin_photo']);
        });
    }
};
