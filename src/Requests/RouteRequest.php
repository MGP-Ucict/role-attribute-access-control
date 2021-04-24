<?php

namespace LaravelHrabac\AccessControl\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RouteRequest extends FormRequest
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
			'route' => 'required',
			'method' => 'required',
        ];
    }


	public function messages()
	{
	    return [
			'name.required' => trans('lang::translation.name.required'),
			'route.required' => trans('lang::translation.route.required'),
			'method.required' => trans('lang::translation.method.required'),
	    ];
	}
}
