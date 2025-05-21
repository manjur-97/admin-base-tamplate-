<?php

    namespace App\Http\Requests;

    use Illuminate\Foundation\Http\FormRequest;

    class RolePermissionRequest extends FormRequest
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
                    return ['role_id' => 'required',
        'uri' => 'required',
        'name' => 'required',
        'controller_function' => 'required',
        'method' => 'required',
        'controller_name' => 'required',
                            ];
                    break;
                
                case 'PATCH':
                case 'PUT':
                    return ['role_id' => 'required',
'uri' => 'required',
'name' => 'required',
'controller_function' => 'required',
'method' => 'required',
'controller_name' => 'required',
                    ];
                    break;
            }
        }
    
        public function messages()
        {
            return ['role_id.required' => 'The  Role id is required.',
'uri.required' => 'The  Uri is required.',
'name.required' => 'The  Name is required.',
'controller_function.required' => 'The  Controller function is required.',
'method.required' => 'The  Method is required.',
'controller_name.required' => 'The  Controller name is required.',
            ];
        }
    }

    