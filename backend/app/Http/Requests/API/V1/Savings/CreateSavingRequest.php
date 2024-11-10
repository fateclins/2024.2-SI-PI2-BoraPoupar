<?php

namespace App\Http\Requests\API\V1\Savings;

use Illuminate\Foundation\Http\FormRequest;

class CreateSavingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'amount' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'name' => 'required|string',
            'goal' => 'nullable|numeric|min:0',
        ];
    }
}
