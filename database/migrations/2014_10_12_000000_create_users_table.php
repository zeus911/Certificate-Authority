<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
<<<<<<< HEAD
            $table->string('username', 60)->unique();
            $table->string('email')->unique();
            $table->string('password');
=======
            $table->string('username', 10);
	        $table->string('email')->unique();
            $table->string('password');
            //$table->string('latch_account_id');
>>>>>>> cae4656c6a9ff00c25dfaaa2d9a011c70c3abcac
            $table->rememberToken();
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
        Schema::drop('users');
    }
}
