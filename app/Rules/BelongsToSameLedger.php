<?php

namespace App\Rules;

use App\Models\Ledger;
use Illuminate\Contracts\Validation\Rule;

class BelongsToSameLedger implements Rule
{
	protected $attribute;
	protected $value;

	public function __construct($attribute, $value)
	{
		$this->attribute = $attribute;
		$this->value     = $value;
	}

    public function passes($attribute, $value)
    {
		$firstAccount  = Ledger::findOrFail($value);
		$secondAccount = Ledger::findOrFail($this->value);

    	return $firstAccount->ledger_id == $secondAccount->ledger_id;
    }

    public function message()
    {
        return ucfirst(':attribute must belong to the same Ledger as ' . $this->attribute . '.');
    }
}
