<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PatientInfoStore extends FormRequest
{
   
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'firstname' => 'required',
            'lastname' => 'required',
            'password' => 'required|confirmed|min:8',
            'confirmpassword' => 'required|same:password|min:8',
            'dob' => 'required|date|date_format:Y-m-d|before:31-12-2003',
            'gender' => 'required',
            'phone' => 'required',
            'phntype' => 'required',
            'address1' => 'required',
            'state' => 'required',
            'city' => 'required',
            'zip' => 'required',
            'check' => 'required',
            'weight' => 'required',
            'height' => 'required',
            'bmi' => 'required',
            'pregnancy' => 'required',
            'c_med' => 'required',
            'allergeis' => 'required',
        
        ];
       
    }
    public function messages()
    {
        return [
            'firstname.required' => "First Name is required",
            'lastname.required' => "Last Name is required",
            'password.required' => "Password is required",
            'confirmpassword.required' => "confirmpassword is required",
            'dob.required' => "Date of Birth is required",
            'gender.required' => "Gender is required",
            'phone.required' => "Phone is required",
            'phntype.required' => "PhoneType is required",
            'address1.required' => "Address is required",
            'state.required' => "State is required",
            'city.required' => "City is required",
            'zip.required' => "Postal Code is required",
            'check.required' => "Please select the checkbox",
            'weight.required' => "City is required",
            'height.required' => "Postal Code is required",
            'bmi.required' => "Please select the checkbox",
            'pregancy.required' => "City is required",
            'c_med.required' => "Postal Code is required",
            'allergeis.required' => "Please select the checkbox",
            
        ];
        
    }
}
