<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;

class WebsitePageRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        if ($this->has('components') && is_string($this->components)) {
            $this->merge(['components' => json_decode($this->components, true)]);
        }
        
        switch ($this->method()) {
            case 'POST':
                return [
                'menu_id' => 'nullable|integer',
                'name' => 'required|string|max:255',
                'website_id' => 'required|max:255',
                'slug' => [
                    'required',
                    'string',
                    'max:255',
                    function ($attribute, $value, $fail) {
                        if ($value && $this->input('website_id')) {
                            $exists = DB::table('website_pages')
                                ->where('slug', $value)
                                ->where('website_id', $this->input('website_id'))
                                ->exists();
                            
                            if ($exists) {
                                $fail('This slug is already in use for this website. Please choose a different one.');
                            }
                        }
                    }
                ],
                'components' => 'required|array',
                'components.*.name' => 'required|string',
                'components.*.position' => 'required|integer|min:1'
                ];
                break;

            case 'PATCH':
            case 'PUT':
                return [
                'menu_id' => 'required|integer',
                'name' => 'nullable|string|max:255',
                'components' => 'required|array',
                'components.*.name' => 'required|string',
                'components.*.position' => 'required|integer|min:1'
                ];
                break;
        }
    }

    public function messages()
    {
        
        return [
                'menu_id.required' => 'The Menu id is Required.',
                'menu_id.numeric' => 'The Menu id must be a numeric value.',
                'menu_id.digits_between' => 'The Menu id must be between 1 and :digits digits.',
                'name.nullable' => 'The Name is optional.',
                'name.max' => 'The Name cannot exceed :max characters.',
                'slug.required' => 'The Slug is Required.',
                'slug.max' => 'The Slug cannot exceed :max characters.',
                'slug.unique' => 'This slug is already in use. Please choose a different one.',
                'components.required' => 'At least one component is required.',
                'components.array' => 'Components must be an array.',
                'components.*.name.required' => 'Component name is required.',
                'components.*.position.required' => 'Component position is required.',
                'components.*.position.min' => 'Component position must be at least 1.'
        ];
    }
}
