<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Validates input for creating a new `Kupac` record.
 *
 * Requires `ime`, `prezime`, `telefon`, and optionally validates `email` format.
 */
class KupacStoreRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            'ime' => ['required', 'string', 'max:100'],
            'prezime' => ['required', 'string', 'max:100'],
            'telefon' => ['required', 'string', 'max:30'],
            'email' => ['nullable', 'email'],
        ];
    }
}
