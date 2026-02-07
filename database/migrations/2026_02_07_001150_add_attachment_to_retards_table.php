<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAttachmentToRetardsTable extends Migration
{
    public function up(): void
    {
        Schema::table('retards', function (Blueprint $table) {
            if (!Schema::hasColumn('retards', 'attachment')) {
                $table->string('attachment')->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::table('retards', function (Blueprint $table) {
            if (Schema::hasColumn('retards', 'attachment')) {
                $table->dropColumn('attachment');
            }
        });
    }
}


