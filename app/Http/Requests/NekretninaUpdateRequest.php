<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Validates input for updating an existing `Nekretnina` record.
 *
 * Keeps `oznaka` unique (excluding current model), checks numeric ranges
 * for `povrsina_m2` and `cena`, and requires string `status`.
 */
class NekretninaUpdateRequest extends FormRequest
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
            'oznaka' => ['required', 'string', 'max:50', 'unique:nekretninas,oznaka,' . $this->nekretnina->id],
            'povrsina_m2' => ['required', 'numeric', 'between:-999999.99,999999.99'],
            'cena' => ['required', 'numeric', 'between:-9999999999.99,9999999999.99'],
            'status' => ['required', 'string'],
        ];
    }
}
