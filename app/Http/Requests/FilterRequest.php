<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\NullOrNotNull;

class FilterRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'per_page' => 'nullable|integer|min:1',
            'page' => 'nullable|integer|min:1',
            'category' => 'nullable|array',
            'tags' => 'nullable|array',
            'tags.*' => 'integer',

        ];
    }
    
    public function messages()
    {
    return [
        'per_page.integer' => 'Number of meals per page must be an integer.',
        'per_page.min'  => 'Number of meals per page must be a positive number.',
        'page.integer' => 'Page number to show must be an integer.',
        'page.min' => 'Page number to show must be a positive number.',
        'category' => 'Categories in filter request must be in array.',
        'tags' => 'Tags in filter request must be in array',
        'tags.*' => 'Tag element in filter request must be an integer.',
    ];
    }
}
