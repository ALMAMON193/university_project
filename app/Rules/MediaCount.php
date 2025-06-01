<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class MediaCount implements ValidationRule
{
    private $validImageExtensions = ['jpeg', 'png', 'jpg', 'gif', 'svg', 'webp'];
    private $validVideoExtensions = ['avi', 'mpeg', 'mov', 'mp4'];
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $images = 0;
        $videos = 0;

        foreach ($value as $file) {
            // Get the file extension
            $extension = strtolower($file->getClientOriginalExtension());
        }

     }
}
