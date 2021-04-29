<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('pay_id');
            $table->string('house_name');
            $table->string('area');
            $table->integer('owner_id');
            $table->integer('renter_id');
            $table->integer('bedroom');
            $table->integer('washroom');
            $table->string('houseDescription');
            $table->integer('housePrice');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
}
