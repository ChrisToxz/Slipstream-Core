<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class SupportedMimeTypes implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $supportedMimeTypes = \Config::get('slipstream.supported_mimetypes');

        $mimeType = $value->getClientMimeType();

        if(!in_array($mimeType, $supportedMimeTypes)){
            $fail("The :attribute must be a valid MIME type. {$mimeType} is not supported yet.");
        }
    }
}
