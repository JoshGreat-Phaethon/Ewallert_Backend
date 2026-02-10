<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TopUpRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'amount' => 'required|numeric|min:1',
            'image'  => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ];
    }
}
