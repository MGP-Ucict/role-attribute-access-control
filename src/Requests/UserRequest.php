<?php

namespace LaravelHrabac\AccessControl\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        $rules =  [
			'username' => 'sometimes',
			'name' => 'required',
			'password' => 'confirmed',
			'roles' => 'required',
			'is_active' => 'nullable',
        ];

		if ($this->method() == 'POST') {
			$rules += [ 'email' => 'required|max:255|email|unique:users'];
		}
		else{
			$rules += [ 'email' => 'required|max:255|email'];
		}
		return $rules;
    }


	public function messages()
	{
	    return [
			'email.required' => trans('lang::translation.email.required'),
			'email.unique'  => trans('lang::translation.email.unique'),
			'email.email'     => trans('lang::translation.email.email'),
			'email.max'     => trans('lang::translation.email.max'),
			'name.required' => trans('lang::translation.name.required'),
			'password.confirmed' => trans('lang::translation.password.confirmed'),
			'roles.required' => trans('lang::translation.roles.required'),
			'password.confirmed' => trans('lang::translation.password.confirmed'),
		];
	}
}
