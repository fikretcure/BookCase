<?php

namespace App\Http\Requests;

use App\Rules\FileHasInDocs;
use App\Rules\FileTypeImage;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BookUpdateRequest extends FormRequest
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
                'prohibits',
                'string',
                Rule::unique("books")->ignore($this->id)
            ],
            'subject' => [
                'prohibits',
                'string'
            ],
            'avatars' => [
                'prohibits',
                "array"
            ],
            'avatars.*.url' => [
                'required',
                'string',
                "distinct",
                new FileHasInDocs(),
                new FileTypeImage()
            ],
            'page_count' => [
                'prohibits',
                "integer"
            ],
            'author_id' => [
                'prohibits',
                "integer",
                Rule::exists('authors', "id")
            ],
        ];
    }
}
