<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BookCreateRequest extends FormRequest
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
            'subject' => [
                'required',
                'string'
            ],
            'avatar' => [
                'required',
                "string"
            ],
            'page_count' => [
                'required',
                "integer"
            ],
            'author_id' => [
                'required',
                "integer",
                Rule::exists('authors', "id")
            ],

        ];
    }
}
