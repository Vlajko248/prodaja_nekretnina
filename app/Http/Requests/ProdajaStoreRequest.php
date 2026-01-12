<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Validates input for creating a new `Prodaja` record.
 *
 * Ensures foreign keys exist (`kupac_id`, `agent_id`, `nekretnina_id`),
 * requires `datum_kreiranja` as a valid date, and enforces a string `status`.
 */
class ProdajaStoreRequest extends FormRequest
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
            'kupac_id' => ['required', 'integer', 'exists:kupacs,id'],
            'agent_id' => ['required', 'integer', 'exists:agents,id'],
            'nekretnina_id' => ['required', 'integer', 'exists:nekretninas,id'],
            'datum_kreiranja' => ['required', 'date'],
            'status' => ['required', 'string'],
        ];
    }
}
