<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmailStoreRequest extends FormRequest
{
    
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'email' => 'required|email|unique:users',
        
        ];
       
    }
    public function messages()
    {
        return [
            'email.required' => 'Email is required!',
            
        ];
        
    }
}
