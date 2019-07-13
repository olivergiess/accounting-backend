<?php

namespace App\Auth\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RefreshRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'refreshToken' => 'required',
        ];
    }

    public function messages()
	{
		return [
			'refreshToken.required' => 'The :attribute cookie is required.',
		];
	}

	/**
	 * Override FormRequest->all() too return cookies
	 * instead of input and files, this allows us to validate
	 * it's input. We specifically override all instead of
	 * validationData() as this provides the functionality
	 * for Request->__get().
	 *
	 * @param null $keys
	 * @return array
	 */
    public function all($keys = null)
	{
		return $this->cookies->all();
	}
}
