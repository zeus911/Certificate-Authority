<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Certs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
          Schema::create('certs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('commonname');
            $table->string('certtype');
            $table->string('certhash');
            $table->binary('publickey');
            $table->binary('privatekey');
            $table->binary('p12');
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
        schema::drop('certs');
    }
}
