<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProdajaUpdateRequest extends FormRequest
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
            'kupac_id' => ['required', 'integer', 'exists:Kupac,id'],
            'agent_id' => ['required', 'integer', 'exists:Agent,id'],
            'nekretnina_id' => ['required', 'integer', 'exists:Nekretnina,id'],
            'datum_kreiranja' => ['required', 'date'],
            'status' => ['required', 'string'],
        ];
    }
}
