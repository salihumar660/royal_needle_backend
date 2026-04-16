<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
            'naap_book_id' => 'nullable|integer|exists:naap_book,id',
            'status' => 'string|max:255',
            'order_date' => 'nullable|date',
            'original_amount' => 'numeric|nullable|min:0',
            'paid_amount' => 'numeric|nullable|min:0',
            'discount_amount' => 'numeric|nullable|min:0',
            'payment_method' => 'string|nullable|max:255',
            'attachments' => 'nullable|array',
            'attachments.*' => 'file|mimes:jpg,jpeg,png|max:2048',
        ];
    }
}
