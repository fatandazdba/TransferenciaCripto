<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->bigIncrements('id');
            $table->string('name',255);
            $table->string('email', 255)->unique()->collation('utf8_unicode_ci');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password',255);
            $table->rememberToken();
            $table->string('address', 255)->nullable();
            $table->timestamps();
            $table->engine = 'InnoDB'; // !! Aquii
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
