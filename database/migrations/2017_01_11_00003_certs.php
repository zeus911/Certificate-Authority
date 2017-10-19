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
            $table->string('cn')->unique();
            $table->string('certificate_type');
            $table->string('digest_alg');
            $table->string('serial')->unique();
            $table->binary('csrprint');
            $table->binary('certprint');
            $table->binary('keyprint');
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
