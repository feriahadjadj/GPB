<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAvancementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('avancements', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('projet_id');
            $table->decimal('montantAlloue',15,2);
            $table->decimal('montantEC',15,2);
            $table->decimal('montantPC',15,2);
            $table->string('delaiR');
            $table->string('etatPhysique');
            $table->integer('tauxA');
            $table->longText('observation')->nullable();
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
        Schema::dropIfExists('avancements');
    }
}
