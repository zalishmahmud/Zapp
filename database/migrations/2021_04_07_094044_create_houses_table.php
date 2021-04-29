<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHousesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('houses', function (Blueprint $table) {
            $table->id();
            $table->string('area');
            $table->string('houseDescription');
            $table->double('housePrice',8,2);
            $table->bigInteger('owner_id')->unassigned();
            $table->string('houseName');
            $table->string('ownerContact');
            $table->integer('bedroom');
            $table->integer('washroom');
            $table->string('picture');
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
        Schema::dropIfExists('houses');
    }
}
