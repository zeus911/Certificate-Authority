<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStatusTableToCerts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('certs', function (Blueprint $table) {
                //$table->string('status')->after('p12'); // Valid/Expired/Revoked OR not revoked.....that´s the question.
                $table->string('status'); // Valid/Expired/Revoked OR not revoked.....that´s the question.
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('certs', function (Blueprint $table) {
            //
        });
    }
}
