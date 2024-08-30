<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|max:255|min:5|string',
            'body' => 'required|string',
            'image' => 'nullable|mimes:jpg,jpeg,png,webp|max:2048'
        ];
    }
}
