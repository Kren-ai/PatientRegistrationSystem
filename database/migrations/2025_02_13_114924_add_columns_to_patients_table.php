<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('patients', function (Blueprint $table) {
            // Split name into first, middle, and last names
            if (!Schema::hasColumn('patients', 'first_name')) {
                $table->string('first_name')->after('id');
            }
            if (!Schema::hasColumn('patients', 'middle_name')) {
                $table->string('middle_name')->nullable()->after('first_name');
            }
            if (!Schema::hasColumn('patients', 'last_name')) {
                $table->string('last_name')->after('middle_name');
            }

            // Check if 'name' column exists before renaming
            if (Schema::hasColumn('patients', 'name')) {
                $table->renameColumn('name', 'full_name');
            }

            // Check if 'phone' column exists before renaming
            if (Schema::hasColumn('patients', 'phone')) {
                $table->renameColumn('phone', 'contact_number');
            }
        });
    }

    public function down(): void
    {
        Schema::table('patients', function (Blueprint $table) {
            // Rollback the changes
            if (Schema::hasColumn('patients', 'first_name')) {
                $table->dropColumn('first_name');
            }
            if (Schema::hasColumn('patients', 'middle_name')) {
                $table->dropColumn('middle_name');
            }
            if (Schema::hasColumn('patients', 'last_name')) {
                $table->dropColumn('last_name');
            }

            // Check if 'full_name' column exists before renaming
            if (Schema::hasColumn('patients', 'full_name')) {
                $table->renameColumn('full_name', 'name');
            }

            // Check if 'contact_number' column exists before renaming
            if (Schema::hasColumn('patients', 'contact_number')) {
                $table->renameColumn('contact_number', 'phone');
            }
        });
    }
};
