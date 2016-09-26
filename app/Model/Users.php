<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
	protected $table = 'users';

	protected $dates = ['last_login_at','reg_at'];
}
