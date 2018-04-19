<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('servers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('institution_id');
            $table->integer('user_id');
            $table->integer('person_id');
            $table->string('bmn_code');
            $table->string('type');
            $table->string('manufacture');
            $table->string('model');
            $table->date('purchase_date');
            $table->date('termination_date');
            $table->string('barcode')->unique();
            $table->string('serial_number')->unique();
            $table->float('processor');
            $table->float('memory');
            $table->float('disk');
            $table->double('price');
            $table->string('location');
            $table->softDeletes();
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
        Schema::dropIfExists('servers');
    }
}
