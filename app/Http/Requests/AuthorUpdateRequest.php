<?php

namespace App\Http\Requests;

use App\Rules\FileHasInDocs;
use App\Rules\FileTypeImage;
use Illuminate\Foundation\Http\FormRequest;

class AuthorUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => [
                'prohibits',
                'string'
            ],
            'surname' => [
                'prohibits',
                'string'
            ],
            'avatar' => [
                'prohibits',
                "string",
                new FileHasInDocs(),
                new FileTypeImage()
            ],
        ];
    }
}
