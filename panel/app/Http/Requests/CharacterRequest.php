<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CharacterRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['sometimes', 'required', 'string'],
            'face' => ['sometimes', 'required', 'exists:faces,id'],
        ];
    }
}
