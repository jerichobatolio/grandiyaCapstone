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
            DB::statement("ALTER TABLE event_bookings MODIFY COLUMN status ENUM('Pending', 'Accepted', 'Paid', 'Cancelled') DEFAULT 'Pending'");
        } else {
            DB::statement("ALTER TABLE event_bookings DROP CONSTRAINT IF EXISTS event_bookings_status_check");
            DB::statement("ALTER TABLE event_bookings ADD CONSTRAINT event_bookings_status_check CHECK (status IN ('Pending', 'Accepted', 'Paid', 'Cancelled'))");
            DB::statement("ALTER TABLE event_bookings ALTER COLUMN status SET DEFAULT 'Pending'");
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $driver = Schema::getConnection()->getDriverName();
        if ($driver === 'mysql') {
            DB::statement("ALTER TABLE event_bookings MODIFY COLUMN status ENUM('Pending', 'Accepted', 'Confirmed', 'Paid', 'Cancelled') DEFAULT 'Pending'");
        } else {
            DB::statement("ALTER TABLE event_bookings DROP CONSTRAINT IF EXISTS event_bookings_status_check");
            DB::statement("ALTER TABLE event_bookings ADD CONSTRAINT event_bookings_status_check CHECK (status IN ('Pending', 'Accepted', 'Confirmed', 'Paid', 'Cancelled'))");
            DB::statement("ALTER TABLE event_bookings ALTER COLUMN status SET DEFAULT 'Pending'");
        }
    }
};
