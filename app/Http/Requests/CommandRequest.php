<?php

    namespace App\Http\Requests;

    use Illuminate\Foundation\Http\FormRequest;

    class CommandRequest extends FormRequest
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
                    return ['model' => 'required',
        'controller' => 'required',
        'database_table' => 'required',
                            ];
                    break;
                
                case 'PATCH':
                case 'PUT':
                    return ['model' => 'required',
'controller' => 'required',
'database_table' => 'required',
                    ];
                    break;
            }
        }
    
        public function messages()
        {
            return ['model.required' => 'The  Model is required.',
'controller.required' => 'The  Controller is required.',
'database_table.required' => 'The  Database table is required.',
            ];
        }
    }

    