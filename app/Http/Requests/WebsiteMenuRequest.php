<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WebsiteMenuRequest extends FormRequest
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
                'name' => 'nullable|string|max:255',
                'slug' => 'nullable|string|max:255',
                'order' => 'nullable|integer',
                ];
                break;

            case 'PATCH':
            case 'PUT':
                return [
                'name' => 'nullable|string|max:255',
                'slug' => 'nullable|string|max:255',
                'order' => 'nullable|integer',
                ];
                break;
        }
    }

    public function messages()
    {
        return [
                'name.nullable' => 'The Name is optional.',
                'name.max' => 'The Name cannot exceed :max characters.',
                'slug.nullable' => 'The Slug is optional.',
                'slug.max' => 'The Slug cannot exceed :max characters.',
                'order.nullable' => 'The Order is optional.',
                'order.numeric' => 'The Order must be a numeric value.',
                'order.digits_between' => 'The Order must be between 1 and :digits digits.',
        ];
    }
}