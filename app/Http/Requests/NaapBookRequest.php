<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NaapBookRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'phone' => 'nullable|string|min:11|max:11',
            'chest' => 'nullable|string|max:255',
            'neck' => 'nullable|string|max:255',
            'waist' => 'nullable|string|max:255',
            'hips' => 'nullable|string|max:255',
            'shoulder' => 'nullable|string|max:255',
            'sleeveLength' => 'nullable|string|max:255',
            'wrist' => 'nullable|string|max:255',
            'thigh' => 'nullable|string|max:255',
            'shirt_length' => 'nullable|string|max:255',
            'trouser_length' => 'nullable|string|max:255',
            'arm_hole' => 'nullable|string|max:255',
            'back_width' => 'nullable|string|max:255',
            'coat_length' => 'nullable|string|max:255',
            'shirt_length' => 'nullable|string|max:255',
            'collar_type' => 'nullable|string|max:255',
            'shalwar_pancha' => 'nullable|string|max:255',
            'quantity' => 'nullable|string|max:255',
            'measurement_date' => 'nullable|date',
            'delivery_date' => 'nullable|date',
            'province_id' => 'nullable|integer|exists:provinces,id',
            'district_id' => 'nullable|integer|exists:district,id',
            'tehsil_id' => 'nullable|integer|exists:tehsil,id',
            'notes' => 'nullable|string|max:255',
        ];
    }
}
