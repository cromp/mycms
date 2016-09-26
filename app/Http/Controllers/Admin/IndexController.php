<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;

class IndexController extends Controller
{

	public function index()
	{
		return view('admin.index.frame');
	}

	public function home()
	{
		return view('admin.index.home');
	}

}
