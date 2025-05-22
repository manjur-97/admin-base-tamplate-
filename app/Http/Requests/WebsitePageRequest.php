<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WebsitePageRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        switch ($this->method()) {
            case 'POST':
                return [
                'menu_id' => 'nullable|integer',
                'name' => 'nullable|string|max:255',
                'slug' => 'nullable|string|max:255',
                ];
                break;

            case 'PATCH':
            case 'PUT':
                return [
                'menu_id' => 'nullable|integer',
                'name' => 'nullable|string|max:255',
                'slug' => 'nullable|string|max:255',
                ];
                break;
        }
    }

    public function messages()
    {
        return [
                'menu_id.nullable' => 'The Menu id is optional.',
                'menu_id.numeric' => 'The Menu id must be a numeric value.',
                'menu_id.digits_between' => 'The Menu id must be between 1 and :digits digits.',
                'name.nullable' => 'The Name is optional.',
                'name.max' => 'The Name cannot exceed :max characters.',
                'slug.nullable' => 'The Slug is optional.',
                'slug.max' => 'The Slug cannot exceed :max characters.',
        ];
    }
}