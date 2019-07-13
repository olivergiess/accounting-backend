<?php

namespace App\Http\Rules;

use Illuminate\Contracts\Validation\Rule;

class Can implements Rule
{
	protected $resource;
	protected $action;

    /**
     * Create a new rule instance.
     *
	 * @param  mixed  $resource
     * @param  string  $action
     * @return void
     */
    public function __construct($resource, string $action)
    {
		$this->resource = $resource;
		$this->action = $action;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
		$user = auth()->user();

		return $user->can($this->action, [$this->resource, $value]);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'validation.can';
    }
}
