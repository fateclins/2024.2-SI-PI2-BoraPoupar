<?php

namespace App\Http\Requests\API\V1\Transactions;

use Illuminate\Foundation\Http\FormRequest;

class CreateTransactionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'category_id' => 'nullable|exists:categories,id',
            'amount' => 'required|numeric',
            'note' => 'nullable|string',
            'user_id' => 'required|exists:users,id',
            'type' => 'required|in:expense,income',
            'name' => 'required|string',
        ];
    }
}
