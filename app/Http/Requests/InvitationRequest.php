<?php

namespace App\Http\Requests;

use App\Http\Dto\InvitationDto;
use Illuminate\Foundation\Http\FormRequest;

use function PHPSTORM_META\type;

class InvitationRequest extends FormRequest
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
            'colocation' => ['required', 'string'],
            'email' => ['required', 'string','email'],
        ];
    }
    public function dto():InvitationDto{
        $this->validated();
        return new InvitationDto(
            json_decode($this->input('colocation')),
            $this->input('email')
            );
    }
}
