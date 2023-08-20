<?php

namespace App\Http\Requests;

use App\Enums\VideoType;
use Illuminate\Foundation\Http\FormRequest;

class SlipStoreRequest extends FormRequest
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
        return [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:200',
            'type' => 'required|enum_key:'.VideoType::class
        ];
    }
}
