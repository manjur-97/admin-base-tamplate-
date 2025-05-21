<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MenuRequest extends FormRequest
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
                    'name'            => 'required|string|max:255',
                    'icon'            => 'nullable|string|max:255',
                    'route'           => 'nullable|string|max:255',
                    'description'     => 'nullable|string',
                    'sorting'         => 'nullable|integer',
                    'parent_id'       => 'nullable|integer|exists:menus,id',
                    'permission_name' => 'nullable|string|max:255',
                ];
                break;

            case 'PATCH':
            case 'PUT':
                return [
                    'name'            => 'required|string|max:255',
                    'icon'            => 'nullable|string|max:255',
                    'route'           => 'nullable|string|max:255',
                    'description'     => 'nullable|string',
                    'sorting'         => 'nullable|integer',
                    'parent_id'       => 'nullable|integer|exists:menus,id',
                    'permission_name' => 'nullable|string|max:255',
                ];
                break;
        }
    }

    public function messages()
    {
        return [
            'name.required' => 'The  Name is required.',

        ];
    }
}
