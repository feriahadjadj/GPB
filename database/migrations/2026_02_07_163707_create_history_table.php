<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoryTable extends Migration
{
    public function up(): void
    {
        Schema::create('history', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamp('date_time');
            $table->text('detail');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('history');
    }
}
