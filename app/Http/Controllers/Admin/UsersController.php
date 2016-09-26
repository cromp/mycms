<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\URL;
use App\Model\Users;

class UsersController extends Controller
{
	public function index()
	{

		return view('admin.user.index');

	}

	public function table(Request $request)
	{

		$users = Users::where(function ($query) use ($request) {
			if ($request->has('condition_username')) {
				$query->where('username', 'like', '%' . $request->condition_username . '%');
			}
			if ($request->has('condition_truename')) {
				$query->where('truename', $request->condition_truename);
			}
			if ($request->has('condition_nickname')) {
				$query->where('nickname', $request->condition_nickname);
			}
			if ($request->has('condition_email')) {
				$query->where('email', 'like', '%' . $request->condition_email . '%');
			}
			if ($request->has('condition_mobile')) {
				$query->where('mobile', 'like', '%' . $request->condition_mobile . '%');
			}
			if ($request->has('condition_status')) {
				$query->where('status', $request->condition_status);
			}
		})->paginate(5);
		return view('admin.user.index.table', ['users' => $users]);

	}

	public function create()
	{

		return view('admin.user.create');

	}

	public function insert(Requests\UsersPostRequest $request)
	{

		return '新增成功';

	}
}
