<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('user_id');
            $table->string('designation');
            $table->string('nature');
            $table->char('finance', 5);
            $table->string('delaiE');
            $table->date('odsEtude');
            $table->date('odsRealisation');
            $table->date('dateReception')->nullable();
            $table->date('dateMiseEnOeuvre')->nullable();
            $table->decimal('montantAlloue',15,2);
            $table->decimal('montantEC',15,2);

            $table->string('delaiR');
            $table->string('etatPhysique');
            $table->integer('tauxA');
            $table->longText('observation')->nullable();
            $table->decimal('montantPC',15,2);
            //$table->longText('observation');
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
        Schema::dropIfExists('projets');
    }
}
