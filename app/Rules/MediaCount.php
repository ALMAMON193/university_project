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

            // Check if the extension is one of the valid image extensions
            if (in_array($extension, $this->validImageExtensions)) {
                $images++; // Increment image counter
            }
            // Check if the extension is one of the valid video extensions
            elseif (in_array($extension, $this->validVideoExtensions)) {
                $videos++; // Increment video counter
            }
        }

        // Ensure the number of images is between 6 and 12, and videos between 1 and 3
        if ($images < 6 || $images > 12 || $videos < 1 || $videos > 2) {
            $fail('You must upload between 6 and 12 images, and between 1 and 2 videos.');
        }

    }
}
