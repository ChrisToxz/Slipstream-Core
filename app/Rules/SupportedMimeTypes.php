<?php

namespace App\Rules;

use Closure;
use Config;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Validation\ValidationException;

class SupportedMimeTypes implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $supportedMimeTypes = Config::get('slipstream.supported_mimetypes');

        try {
            $mimeType = $value->getClientMimeType();
        } catch (\Error $e) {
            throw new ValidationException(['file' => 'asdasd']);
        }

        if (!in_array($mimeType, $supportedMimeTypes)) {
            $fail("The :attribute must be a valid MIME type. {$mimeType} is not supported yet.");
        }
    }
}
