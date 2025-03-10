<?php

namespace App\Rules;
use Illuminate\Contracts\Validation\Rule;

use Closure;

class CheckBalance implements Rule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */

    // validation rule
    public function passes($attribute, $value) {
        $user = auth()->user();

        $balance = $user->balance->balance;

        return $value <= $balance;
    }

    // message fo 
    public function message()
    {
        return "Refund amount can't be moret than your current balance";
    }
}
