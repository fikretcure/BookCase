<?php

namespace App\Http\Requests;

use App\Rules\FileHasInDocs;
use App\Rules\FileTypeImage;
use Illuminate\Foundation\Http\FormRequest;

class AuthorCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string'
            ],
            'surname' => [
                'required',
                'string'
            ],
            'avatar' => [
                'nullable',
                "string",
                new FileHasInDocs(),
                new FileTypeImage()
            ],
        ];
    }
}
