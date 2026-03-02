<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateDepenseRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'titre' => ['required', 'string', 'max:255'],
            'montant' => ['required', 'numeric', 'min:0.01'],
            'date' => ['nullable', 'date', 'before_or_equal:today'],
            'category_id' => ['required', 'integer', 'exists:categories,id'],
            'payer' => ['required', 'integer', 'exists:users,id'],
        ];
    }

    public function dto()
    {
        $validated = $this->validated();

        $dtoArray = [
            'titre' => $validated['titre'],
            'montant' => (float) $validated['montant'],
            'date' => $validated['date'] ?? now()->toDateString(),
            'category_id' => (int) $validated['category_id'],
            'payer_id' => (int) $validated['payer'],
        ];

        return json_decode(json_encode($dtoArray));
    }
}
