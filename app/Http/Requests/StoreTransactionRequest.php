<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTransactionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        // Set ke true agar semua pengguna bisa membuat request ini
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'date' => 'required|date',
            'category' => 'required|string|max:100',
            'description' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
        ];
    }
}