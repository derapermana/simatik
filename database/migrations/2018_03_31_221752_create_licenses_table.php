<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLicensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('licenses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('institution_id');
            $table->integer('person_id');
            $table->string('name');
            $table->string('type');
            $table->string('manufacture');
            $table->string('distributor');
            $table->string('distributor_address');
            $table->string('order_no');
            $table->date('order_date');
            $table->string('enduser_name');
            $table->date('active_term');
            $table->date('end_term');
            $table->integer('qty');
            $table->string('sku');
            $table->string('serial_number');
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
        Schema::dropIfExists('licenses');
    }
}
