<?php

namespace App\Http\Requests\API\V1\Transactions;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTransactionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return string[]
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'amount' => 'required|numeric',
            'note' => 'nullable|string',
            'user_id' => 'required|exists:users,id',
        ];
    }
}
