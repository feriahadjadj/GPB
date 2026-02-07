<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('project_histories', function (Blueprint $table) {
        $table->bigIncrements('id');

        $table->unsignedBigInteger('projet_id'); // assuming projets.id is bigint; if it's int tell me
        $table->unsignedBigInteger('user_id')->nullable();

        $table->string('action', 20); // created | updated | deleted
        $table->string('field', 100)->nullable(); // e.g. montantAlloue, delaiE, etc.
        $table->text('old_value')->nullable();
        $table->text('new_value')->nullable();

        $table->timestamps();

        // FK (optional but recommended if your DB supports it cleanly)
        // If SQL Server complains later, we can remove FKs quickly.
        $table->foreign('projet_id')->references('id')->on('projets')->onDelete('cascade');
        $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('project_histories');
    }
}
