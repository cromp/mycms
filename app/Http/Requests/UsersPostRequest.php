<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Contracts\Validation\Validator;

class UsersPostRequest extends Request
{
	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'username' => 'required|unique:users|email|min:10',
			'password' => 'required'
		];
	}

	public function messages()
	{
		return [
			'username.required' => '用户名不能为空',
			'username.unique' => '用户名已存在',
			'username.email' => '用户名必须是邮箱地址',
			'username.min'=>'至少:min个字符',
			'password.required' => '密码不能为空',
		];
	}

}
