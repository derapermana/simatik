<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('institution_id');
            $table->integer('user_id');
            $table->integer('ipaddres_id');
            $table->integer('subdomain_id');
            $table->string('name');
            $table->text('desc');
            $table->text('notes');
            $table->enum('type', array('internal', 'eksternal'));
            $table->text('technologies')->nullable();
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
        Schema::dropIfExists('applications');
    }
}
