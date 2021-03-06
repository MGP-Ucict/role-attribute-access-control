<?php

namespace LaravelHrabac\AccessControl\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
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
			'name' => 'required',
			'routes' => 'required',
			'own' => 'nullable',
			'is_active' => 'nullable',
        ];
    }


	public function messages()
	{
	    return [
			'name.required' => trans('lang::translation.name.required'),
			'routes.required' => trans('lang::translation.routes.required'),
	    ];
	}
}
