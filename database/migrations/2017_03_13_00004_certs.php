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
            $table->string('key_length');
            $table->string('serial')->unique();
            $table->binary('csrprint');
            $table->binary('certprint');
            $table->binary('keyprint');
            $table->binary('p12');
            //$table->string('hasp12');  // Has PFX been generated?.
            $table->string('status'); // Revoked OR not revoked.....that´s the question.
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