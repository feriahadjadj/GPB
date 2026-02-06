<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRetardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('retards', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('projet_id')->nullable();
            $table->string('type');
            $table->date('date_arret');
            $table->date('date_reprise');
            $table->text('reason');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('retards');
    }
}
//ALTER TABLE `retards` ADD `reason` TEXT NULL AFTER `date_reprise`;
