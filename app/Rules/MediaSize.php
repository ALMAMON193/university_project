<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class MediaSize implements ValidationRule
{
    private $maxImageSize;
    private $maxVideoSize;
    private $validImageExtensions = ['jpeg', 'png', 'jpg', 'gif', 'svg'];
    private $validVideoExtensions = ['avi', 'mpeg', 'mov', 'mp4'];

    public function __construct($maxImageSize = 2048, $maxVideoSize = 51240)
    {
        $this->maxImageSize = $maxImageSize; // 2MB
        $this->maxVideoSize = $maxVideoSize; // 10MB
    }
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        foreach ($value as $file) {
            $extension = strtolower($file->getClientOriginalExtension()); // Get the file extension
            $size = $file->getSize(); // Get the file size in bytes

            // Check if the file is an image and if its size is within the limit
            if (in_array($extension, $this->validImageExtensions) && $size > $this->maxImageSize * 1024) {
                $fail('Each image must not exceed 2MB.');
                return;
            }
            // Check if the file is a video and if its size is within the limit
            elseif (in_array($extension, $this->validVideoExtensions) && $size > $this->maxVideoSize * 1024) {
                $fail('Each video must not exceed 50MB.');
                return;
            }
        }
    }
}
