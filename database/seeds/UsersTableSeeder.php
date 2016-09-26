<?php

use Illuminate\Database\Seeder;
use App\Model\Users;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		Users::create([
			'username' => str_random(10),
			'password' => md5(md5('123456') . '000000'),
			'salt' => '000000',
			'email' => str_random(10) . '@gmail.com',
			'mobile' => str_random(11),
			'reg_at' => \Carbon\Carbon::now(),
			'status' => 0,
		]);
    }
}
