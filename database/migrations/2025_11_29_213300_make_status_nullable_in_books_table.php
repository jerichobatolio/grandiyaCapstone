<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $driver = Schema::getConnection()->getDriverName();
        if ($driver === 'mysql') {
            DB::statement('ALTER TABLE books MODIFY COLUMN status VARCHAR(255) NULL DEFAULT NULL');
        } else {
            DB::statement('ALTER TABLE books ALTER COLUMN status TYPE varchar(255)');
            DB::statement('ALTER TABLE books ALTER COLUMN status DROP NOT NULL');
            DB::statement('ALTER TABLE books ALTER COLUMN status DROP DEFAULT');
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $driver = Schema::getConnection()->getDriverName();
        if ($driver === 'mysql') {
            DB::statement("ALTER TABLE books MODIFY COLUMN status VARCHAR(255) NOT NULL DEFAULT 'pending'");
        } else {
            DB::statement("ALTER TABLE books ALTER COLUMN status SET DEFAULT 'pending'");
            DB::statement("ALTER TABLE books ALTER COLUMN status SET NOT NULL");
        }
    }
};

