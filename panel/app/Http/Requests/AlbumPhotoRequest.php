<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AlbumPhotoRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'photo' => ['required', 'numeric', 'exists:photos,id'],
        ];
    }
}
