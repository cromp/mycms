<?php

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
			$table->char('username', 20)->unique()->default('');
			$table->char('password', 32)->default('');
			$table->char('salt', 6)->default('');
			$table->string('truename')->default('');
			$table->string('nickname')->default('');
			$table->string('email')->default('');
			$table->char('mobile', 11)->default('');
			$table->integer('last_login_at')->unsigned()->default(0);
			$table->char('last_login_ip', 15)->default('0.0.0.0');
			$table->integer('reg_at')->unsigned()->default(0);
			$table->char('reg_ip', 15)->default('0.0.0.0');
			$table->integer('login_count')->unsigned()->default(0);
			$table->tinyInteger('status')->unsigned()->default(1);
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
