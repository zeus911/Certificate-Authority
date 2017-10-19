<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Csr extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
          Schema::create('csrs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('cn')->unique();
            $table->string('certificate_type');
            $table->string('digest_alg');
            $table->binary('csr');
            $table->binary('cert');
            $table->binary('key');
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
        schema::drop('csrs');
    }
}
