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
            DB::statement("ALTER TABLE event_bookings MODIFY COLUMN status ENUM('Pending', 'Accepted', 'Confirmed', 'Paid', 'Cancelled') DEFAULT 'Pending'");
        } else {
            // PostgreSQL: use varchar + check (idempotent)
            $col = DB::selectOne("SELECT data_type FROM information_schema.columns WHERE table_name = 'event_bookings' AND column_name = 'status'");
            if ($col && $col->data_type !== 'character varying') {
                DB::statement("ALTER TABLE event_bookings ALTER COLUMN status TYPE varchar(50) USING status::text");
            }
            DB::statement("ALTER TABLE event_bookings ALTER COLUMN status SET DEFAULT 'Pending'");
            $exists = DB::selectOne("SELECT 1 FROM pg_constraint WHERE conname = ?", ['event_bookings_status_check']);
            if (!$exists) {
                DB::statement("ALTER TABLE event_bookings ADD CONSTRAINT event_bookings_status_check CHECK (status IN ('Pending', 'Accepted', 'Confirmed', 'Paid', 'Cancelled'))");
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $driver = Schema::getConnection()->getDriverName();
        if ($driver === 'mysql') {
            DB::statement("ALTER TABLE event_bookings MODIFY COLUMN status ENUM('Pending', 'Confirmed', 'Paid', 'Cancelled', 'Completed') DEFAULT 'Pending'");
        } else {
            DB::statement("ALTER TABLE event_bookings DROP CONSTRAINT IF EXISTS event_bookings_status_check");
            DB::statement("ALTER TABLE event_bookings ALTER COLUMN status SET DEFAULT 'Pending'");
        }
    }
};
