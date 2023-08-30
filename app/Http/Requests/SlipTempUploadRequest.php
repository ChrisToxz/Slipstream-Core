<?php

namespace App\Http\Requests;

use App\Rules\SupportedMimeTypes;
use Illuminate\Foundation\Http\FormRequest;

class SlipTempUploadRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        $max = app(GeneralSettings::class)->file_size_limit;
        return [
            'file' => ['file', "max:{$max}", new SupportedMimeTypes()]
        ];
    }
}
