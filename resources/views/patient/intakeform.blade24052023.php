<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="colorlib.com">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign Up Form</title>

    <!-- Font Icon -->
    
    <link rel="stylesheet" href="{{ asset('fonts/material-icon/css/material-design-iconic-font.min.css')}}">
    <link rel="stylesheet" href="{{ asset('vendor/nouislider/nouislider.min.css')}}">

    <!-- Main css -->
    <link rel="stylesheet" href="{{ asset('css/style.css')}}">
</head>

<body>

    <div class="main">

        <div class="container">
            <form id="signup-form" action="{{ route('form.store') }}" role="form" method="post" files=true
                enctype='multipart/form-data' accept-charset="utf-8">
                <input type="hidden" name="user_data[email]" value="{{$email}}"/>
                @csrf
              
                <div>
                    <h3>Personal info</h3>
                    <fieldset>
                        <div class="fieldset-content">
                            <div class="form-row">
                                <label class="form-label">Name</label>
                                <div class="form-flex">
                                    <div class="form-group">
                                        <input type="text" name="user_data[first_name]" id="first_name"
                                            placeholder="First Name" / value="{{ old('user_data.first_name') }}">
                                        @if ($errors->has('user_data.first_name'))
                                            <span style="color:red">{{ $errors->first('user_data.first_name') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="user_data[last_name]" id="last_name"
                                            placeholder="Last Name" / value="{{ old('user_data.last_name') }}">
                                            @if ($errors->has('user_data.last_name'))
                                            <span style="color:red;">{{ $errors->first('user_data.last_name') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        
                            <div class="form-date">
                                <label for="birth_date" class="form-label">Birth Date</label>
                                <input type="date" name="user_data[dob]" id="birth_date"
                                    placeholder="Date of Birth" / value="{{ old('user_data.dob') }}">
                                    @if ($errors->has('user_data.dob'))
                                    <span style="color:red;">{{ $errors->first('user_data.dob') }}</span>
                                @endif
                            </div>

                            <div class="form-row">
                                <div class="form-flex">
                                    <div class="form-group">
                                        <label class="form-label">Gender</label>
                                        <select class="form-select" name="user_data[gender]" >
                                            <option value="">Not known</option>
                                            <option value="1">Male</option>
                                            <option value="2">Female</option>
                                            <option value="9">Not Applicable</option>
                                        </select>
                                        @if ($errors->has('user_data.gender'))
                                        <span style="color:red;">{{ $errors->first('user_data.gender') }}</span>
                                    @endif
                                    </div>
                                  
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-flex">
                                    <div class="form-group">
                                        <label for="phone" class="form-label">Phone</label>
                                        <input type="text" name="user_data[phone]" / value="{{ old('user_data.phone') }}">
                                        @if ($errors->has('user_data.phone'))
                                        <span style="color:red;">{{ $errors->first('user_data.phone') }}</span>
                                    @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="phonetype" class="form-label">Phone Type</label>
                                        <select class="form-select" name="user_data[phone_type]">
                                            <option value="">Please Select</option>
                                            <option value="2">2</option>
                                            <option value="4">4</option>
                                        </select>
                                        @if ($errors->has('user_data.phone_type'))
                                        <span style="color:red;">{{ $errors->first('user_data.phone_type') }}</span>
                                    @endif

                                    </div>
                                  
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="ssn" class="form-label">Address</label>
                                <input type="text" name="user_data[address]" id="address" placeholder="Address" / value="{{ old('user_data.address') }}">
                                @if ($errors->has('user_data.address'))
                                <span style="color:red;">{{ $errors->first('user_data.address') }}</span>
                            @endif
                            </div>
                            <div class="form-group">
                                <label for="ssn" class="form-label">Address 2</label>
                                <input type="text" name="user_data[address2]" id="ssn"
                                    placeholder="Additional Address" / value="{{ old('user_data.address2') }}">
                                    @if ($errors->has('user_data.address2'))
                                    <span style="color:red;">{{ $errors->first('user_data.address2') }}</span>
                                @endif
                            </div>
                            <div class="form-row">
                                <div class="form-flex">
                                    <div class="form-group">
                                        <label for="city" class="form-label">City</label>
                                        <input type="text" name="user_data[city]" id="city" / value="{{ old('user_data.city') }}">
                                        @if ($errors->has('user_data.city'))
                                        <span style="color:red;">{{ $errors->first('user_data.city') }}</span>
                                    @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="state" class="form-label">State</label>
                                        <input type="text" name="user_data[state]" id="state" / value="{{ old('user_data.state') }}">
                                        @if ($errors->has('user_data.state'))
                                        <span style="color:red;">{{ $errors->first('user_data.state') }}</span>
                                    @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="zip_code" class="form-label">Zip Code</label>
                                        <input type="text" name="user_data[zip_code]" id="zip_code" / value="{{ old('user_data.zip_code') }}">
                                        @if ($errors->has('user_data.zip_code'))
                                        <span style="color:red;">{{ $errors->first('user_data.zip_code') }}</span>
                                    @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-flex">
                                    <div class="form-group">
                                        <label for="city" class="form-label">Create new password</label>
                                        <input type="password" name="user_data[password]" >
                                        @if ($errors->has('user_data.password'))
                                        <span style="color:red;">{{ $errors->first('user_data.password') }}</span>
                                    @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="state" class="form-label">Confirm Password</label>
                                        <input type="password" name="user_data[confirm_password]">
                                        @if ($errors->has('user_data.confirm_password'))
                                        <span style="color:red;">{{ $errors->first('user_data.confirm_password') }}</span>
                                    @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                    </fieldset>
                    {{-- <h3> General Questions</h3>
                    <fieldset>
                        <div class="fieldset-content">
                            <div class="tab">
                                <p class="desc">We're going to ask you some questions.This should take a few minute.
                                </p>
                            </div>
                            <div class="form-row">
                                <div class="form-flex">
                                    <div class="form-group">
                                        <label for="city" class="form-label">Weight in KG</label>
                                        <input type="text" name="user_data[weight]" id="weight" / value="{{ old('user_data.weight') }}">
                                        @if ($errors->has('user_data.weight'))
                                        <span style="color:red;">{{ $errors->first('user_data.weight') }}</span>
                                    @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="state" class="form-label">Height in CM</label>
                                        <input type="text" name="user_data[height]" id="height" / value="{{ old('user_data.height') }}">
                                        @if ($errors->has('user_data.height'))
                                        <span style="color:red;">{{ $errors->first('user_data.height') }}</span>
                                    @endif
                                    </div>

                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-flex">
                                    <div class="form-group">
                                        <label for="pregnancy">Pregnancy</label>
                                        <select id="pregnancy" name="user_data[pregnancy]" class="form-select">
                                            <option value="">Please Select</option>
                                            <option value="1">True</option>
                                            <option value="0">False</option>
                                        </select>
                                        @if ($errors->has('user_data.pregnancy'))
                                        <span style="color:red;">{{ $errors->first('user_data.pregnancy') }}</span>
                                    @endif
                                    </div>
                                 
                                    <div class="form-group">
                                        <label for="city" class="form-label">Known patient's allergies</label>
                                        <input type="text" name="user_data[allergeis]" id="allergeis" />
                                        @if ($errors->has('user_data.allergeis'))
                                        <span style="color:red;">{{ $errors->first('user_data.allergeis') }}</span>
                                    @endif
                                    </div>

                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-flex">

                                    <div class="form-group">
                                        <label for="state" class="form-label">Current Medications</label>
                                        <input type="text" name="user_data[current_medication]"
                                            id="current_medication" />
                                            @if ($errors->has('user_data.current_medication'))
                                        <span style="color:red;">{{ $errors->first('user_data.current_medication') }}</span>
                                    @endif
                                    </div>
                                </div>
                            </div>

                        </div>
                    </fieldset> --}}
                    @foreach ($data as $k => $val)
                        <h3> Medicine Questions</h3>
                        <fieldset>
                            <div class="fieldset-content">
                                <div style="padding-bottom: 10px">{{ $val->title }}
                                    @if ($val->type == 'string')
                                        <input type="hidden"
                                            name="intake_data[{{ $k }}][partner_questionnaire_question_id]"
                                            value="{{ $val->partner_questionnaire_question_id }}">
                                        <input type="hidden" name="intake_data[{{ $k }}][type]"
                                            value="{{ $val->type }}">
                                        <input type="hidden" name="intake_data[{{ $k }}][title]"
                                            value="{{ $val->title }}">
                                        <input type="hidden" name="intake_data[{{ $k }}][description]"
                                            value="{{ $val->description }}">
                                        <input type="hidden" name="intake_data[{{ $k }}][label]"
                                            value="{{ $val->label }}">
                                        <input type="hidden" name="intake_data[{{ $k }}][placeholder]"
                                            value="{{ $val->placeholder }}">
                                        <input type="hidden" name="intake_data[{{ $k }}][is_important]"
                                            value="{{ $val->is_important }}">
                                        <input type="hidden" name="intake_data[{{ $k }}][is_critical]"
                                            value="{{ $val->is_critical }}">
                                        <input type="hidden" name="intake_data[{{ $k }}][is_optional]"
                                            value="{{ $val->is_optional }}">
                                        <input type="hidden" name="intake_data[{{ $k }}][is_visible]"
                                            value="{{ $val->is_visible }}">
                                        <input type="hidden" name="intake_data[{{ $k }}][order]"
                                            value="{{ $val->order }}">
                                        <input type="hidden" name="intake_data[{{ $k }}][default_value]"
                                            value="{{ $val->default_value }}">

                                        <div class="form-check p-2" style="display:flex;padding:1px;">
                                            <input class="form-check-input" type="text"
                                                name="intake_data[{{ $k }}][answer]" value=""
                                                style="margin-top: 5px; margin-bottom: 5px;">
                                        </div>
                                    @elseif($val->type == 'boolean')
                                        <input type="hidden"
                                            name="intake_data[{{ $k }}][partner_questionnaire_question_id]"
                                            value="{{ $val->partner_questionnaire_question_id }}">
                                        <input type="hidden" name="intake_data[{{ $k }}][type]"
                                            value="{{ $val->type }}">
                                        <input type="hidden" name="intake_data[{{ $k }}][title]"
                                            value="{{ $val->title }}">
                                        <input type="hidden" name="intake_data[{{ $k }}][description]"
                                            value="{{ $val->description }}">
                                        <input type="hidden" name="intake_data[{{ $k }}][label]"
                                            value="{{ $val->label }}">
                                        <input type="hidden" name="intake_data[{{ $k }}][placeholder]"
                                            value="{{ $val->placeholder }}">
                                        <input type="hidden" name="intake_data[{{ $k }}][is_important]"
                                            value="{{ $val->is_important }}">
                                        <input type="hidden" name="intake_data[{{ $k }}][is_critical]"
                                            value="{{ $val->is_critical }}">
                                        <input type="hidden" name="intake_data[{{ $k }}][is_optional]"
                                            value="{{ $val->is_optional }}">
                                        <input type="hidden" name="intake_data[{{ $k }}][is_visible]"
                                            value="{{ $val->is_visible }}">
                                        <input type="hidden" name="intake_data[{{ $k }}][order]"
                                            value="{{ $val->order }}">
                                        <input type="hidden" name="intake_data[{{ $k }}][default_value]"
                                            value="{{ $val->default_value }}">
                                        <div class="form-check p-2" style="display:flex;">
                                            <input class="form-check-input" type="radio"
                                                name="intake_data[{{ $k }}][answer]"
                                                id="{{ $val->title }}" value="Y" style="width:3% !important">
                                            <label class="form-check-label" for="" style="padding: 18px">
                                                Yes
                                            </label>
                                        </div>
                                        <div class="form-check p-2" style="display:flex;">
                                            <input class="form-check-input" type="radio"
                                                name="intake_data[{{ $k }}][answer]"
                                                style="width:3% !important" value="N">
                                            <label class="form-check-label" for="exampleRadios2"
                                                style="padding: 18px">
                                                No
                                            </label>
                                        </div>
                                    @elseif($val->type == 'multiple_option')
                                        <input type="hidden"
                                            name="multiple_option[partner_questionnaire_question_id]"
                                            value="{{ $val->partner_questionnaire_question_id }}">
                                        <input type="hidden" name="multiple_option[quest_type]"
                                            value="type_multiple_option">
                                        @foreach ($val->options as $k => $option)
                                            <div class="form-check p-2" style="display:flex;">
                                                <input class="form-check-input" type="checkbox"
                                                    name="multiple_option[{{ $k }}]"
                                                    value=" {{ $option->title }}" style="width:3% !important">
                                                <label class="form-check-label" for="" style="padding: 18px">
                                                    {{ $option->title }}
                                                </label>
                                            </div>
                                        @endforeach
                                    @elseif($val->type == 'text')
                                        <input type="hidden"
                                            name="intake_data[{{ $k }}][partner_questionnaire_question_id]"
                                            value="{{ $val->partner_questionnaire_question_id }}">
                                        <input type="hidden" name="intake_data[{{ $k }}][type]"
                                            value="{{ $val->type }}">
                                        <input type="hidden" name="intake_data[{{ $k }}][title]"
                                            value="{{ $val->title }}">
                                        <input type="hidden" name="intake_data[{{ $k }}][description]"
                                            value="{{ $val->description }}">
                                        <input type="hidden" name="intake_data[{{ $k }}][label]"
                                            value="{{ $val->label }}">
                                        <input type="hidden" name="intake_data[{{ $k }}][placeholder]"
                                            value="{{ $val->placeholder }}">
                                        <input type="hidden" name="intake_data[{{ $k }}][is_important]"
                                            value="{{ $val->is_important }}">
                                        <input type="hidden" name="intake_data[{{ $k }}][is_critical]"
                                            value="{{ $val->is_critical }}">
                                        <input type="hidden" name="intake_data[{{ $k }}][is_optional]"
                                            value="{{ $val->is_optional }}">
                                        <input type="hidden" name="intake_data[{{ $k }}][is_visible]"
                                            value="{{ $val->is_visible }}">
                                        <input type="hidden" name="intake_data[{{ $k }}][order]"
                                            value="{{ $val->order }}">
                                        <input type="hidden" name="intake_data[{{ $k }}][default_value]"
                                            value="{{ $val->default_value }}">
                                        <div class="form-check p-2" style="display:flex;padding:1px;">
                                            <input class="form-check-input" type="text"
                                                name="intake_data[{{ $k }}][answer]" value=""
                                                style="margin-top: 5px; margin-bottom: 5px;">
                                        </div>
                                    @elseif($val->type == 'single_option')
                                        <input type="hidden"
                                            name="intake_data[{{ $k }}][partner_questionnaire_question_id]"
                                            value="{{ $val->partner_questionnaire_question_id }}">
                                        <input type="hidden" name="intake_data[{{ $k }}][type]"
                                            value="{{ $val->type }}">
                                        <input type="hidden" name="intake_data[{{ $k }}][title]"
                                            value="{{ $val->title }}">
                                        <input type="hidden" name="intake_data[{{ $k }}][description]"
                                            value="{{ $val->description }}">
                                        <input type="hidden" name="intake_data[{{ $k }}][label]"
                                            value="{{ $val->label }}">
                                        <input type="hidden" name="intake_data[{{ $k }}][placeholder]"
                                            value="{{ $val->placeholder }}">
                                        <input type="hidden" name="intake_data[{{ $k }}][is_important]"
                                            value="{{ $val->is_important }}">
                                        <input type="hidden" name="intake_data[{{ $k }}][is_critical]"
                                            value="{{ $val->is_critical }}">
                                        <input type="hidden" name="intake_data[{{ $k }}][is_optional]"
                                            value="{{ $val->is_optional }}">
                                        <input type="hidden" name="intake_data[{{ $k }}][is_visible]"
                                            value="{{ $val->is_visible }}">
                                        <input type="hidden" name="intake_data[{{ $k }}][order]"
                                            value="{{ $val->order }}">
                                        <input type="hidden" name="intake_data[{{ $k }}][default_value]"
                                            value="{{ $val->default_value }}">
                                        @foreach ($val->options as $key => $option)
                                            <div class="form-check p-2" style="display:flex;">
                                                <input class="form-check-input" type="radio"
                                                    name="intake_data[{{ $k }}][answer]" value=""
                                                    style="width:3% !important">
                                                <label class="form-check-label" for="exampleRadios1"
                                                    style="padding: 18px">
                                                    {{ $option->title }}
                                                </label>
                                            </div>
                                        @endforeach
                                    @elseif($val->type == 'integer')
                                        <input type="hidden"
                                            name="intake_data[{{ $k }}][partner_questionnaire_question_id]"
                                            value="{{ $val->partner_questionnaire_question_id }}">
                                        <input type="hidden" name="intake_data[{{ $k }}][type]"
                                            value="{{ $val->type }}">
                                        <input type="hidden" name="intake_data[{{ $k }}][title]"
                                            value="{{ $val->title }}">
                                        <input type="hidden" name="intake_data[{{ $k }}][description]"
                                            value="{{ $val->description }}">
                                        <input type="hidden" name="intake_data[{{ $k }}][label]"
                                            value="{{ $val->label }}">
                                        <input type="hidden" name="intake_data[{{ $k }}][placeholder]"
                                            value="{{ $val->placeholder }}">
                                        <input type="hidden" name="intake_data[{{ $k }}][is_important]"
                                            value="{{ $val->is_important }}">
                                        <input type="hidden" name="intake_data[{{ $k }}][is_critical]"
                                            value="{{ $val->is_critical }}">
                                        <input type="hidden" name="intake_data[{{ $k }}][is_optional]"
                                            value="{{ $val->is_optional }}">
                                        <input type="hidden" name="intake_data[{{ $k }}][is_visible]"
                                            value="{{ $val->is_visible }}">
                                        <input type="hidden" name="intake_data[{{ $k }}][order]"
                                            value="{{ $val->order }}">
                                        <input type="hidden" name="intake_data[{{ $k }}][default_value]"
                                            value="{{ $val->default_value }}">
                                        <div class="form-check p-2" style="display:flex;">
                                            <input class="form-check-input" type="number"
                                                name="intake_data[{{ $k }}][answer]" value=""
                                                style="margin-top: 5px; margin-bottom: 5px;" />
                                        </div>
                                    @elseif($val->type == 'date')
                                        <input type="hidden"
                                            name="intake_data[{{ $k }}][partner_questionnaire_question_id]"
                                            value="{{ $val->partner_questionnaire_question_id }}">
                                        <input type="hidden" name="intake_data[{{ $k }}][type]"
                                            value="{{ $val->type }}">
                                        <input type="hidden" name="intake_data[{{ $k }}][title]"
                                            value="{{ $val->title }}">
                                        <input type="hidden" name="intake_data[{{ $k }}][description]"
                                            value="{{ $val->description }}">
                                        <input type="hidden" name="intake_data[{{ $k }}][label]"
                                            value="{{ $val->label }}">
                                        <input type="hidden" name="intake_data[{{ $k }}][placeholder]"
                                            value="{{ $val->placeholder }}">
                                        <input type="hidden" name="intake_data[{{ $k }}][is_important]"
                                            value="{{ $val->is_important }}">
                                        <input type="hidden" name="intake_data[{{ $k }}][is_critical]"
                                            value="{{ $val->is_critical }}">
                                        <input type="hidden" name="intake_data[{{ $k }}][is_optional]"
                                            value="{{ $val->is_optional }}">
                                        <input type="hidden" name="intake_data[{{ $k }}][is_visible]"
                                            value="{{ $val->is_visible }}">
                                        <input type="hidden" name="intake_data[{{ $k }}][order]"
                                            value="{{ $val->order }}">
                                        <input type="hidden" name="intake_data[{{ $k }}][default_value]"
                                            value="{{ $val->default_value }}">
                                        <div class="form-check p-2" style="display:flex;">
                                            <input class="form-check-input" type="date"
                                                name="intake_data[{{ $k }}][answer]" value=""
                                                style="margin-top: 5px; margin-bottom: 5px;" />
                                        </div>
                                    @elseif($val->type == 'ordering')
                                        <div class="form-check p-2" style="display:flex;">
                                            <input class="form-check-input" type="radio" name=""
                                                value="" style="width:3% !important">
                                            <label class="form-check-label" for="exampleRadios1"
                                                style="padding: 18px">
                                                Yes
                                            </label>
                                        </div>
                                        <div class="form-check p-2" style="display:flex;">
                                            <input class="form-check-input" type="radio" name=""
                                                style="width:3% !important" value="">
                                            <label class="form-check-label" for="exampleRadios2"
                                                style="padding: 18px">
                                                No
                                            </label>
                                        </div>
                                    @elseif($val->type == 'range')
                                        <input type="hidden"
                                            name="intake_data[{{ $k }}][partner_questionnaire_question_id]"
                                            value="{{ $val->partner_questionnaire_question_id }}">
                                        <input type="hidden" name="intake_data[{{ $k }}][type]"
                                            value="{{ $val->type }}">
                                        <input type="hidden" name="intake_data[{{ $k }}][title]"
                                            value="{{ $val->title }}">
                                        <input type="hidden" name="intake_data[{{ $k }}][description]"
                                            value="{{ $val->description }}">
                                        <input type="hidden" name="intake_data[{{ $k }}][label]"
                                            value="{{ $val->label }}">
                                        <input type="hidden" name="intake_data[{{ $k }}][placeholder]"
                                            value="{{ $val->placeholder }}">
                                        <input type="hidden" name="intake_data[{{ $k }}][is_important]"
                                            value="{{ $val->is_important }}">
                                        <input type="hidden" name="intake_data[{{ $k }}][is_critical]"
                                            value="{{ $val->is_critical }}">
                                        <input type="hidden" name="intake_data[{{ $k }}][is_optional]"
                                            value="{{ $val->is_optional }}">
                                        <input type="hidden" name="intake_data[{{ $k }}][is_visible]"
                                            value="{{ $val->is_visible }}">
                                        <input type="hidden" name="intake_data[{{ $k }}][order]"
                                            value="{{ $val->order }}">
                                        <input type="hidden" name="intake_data[{{ $k }}][default_value]"
                                            value="{{ $val->default_value }}">
                                        <!-- <div class="form-check p-2" style="display:flex;">
                                                <input type="range" id="{{ $val->title }}" name="intake_data[{{ $k }}]['type_range']" min="0" class="" max="11" style="margin: 0.4rem; !important">
                                            </div> -->
                                        <div class="donate-us">
                                            <div class="price_slider ui-slider ui-slider-horizontal">
                                                <div id="slider-margin"></div>
                                                <p class="your-money">
                                                    <input type="hidden" value="{{ $val->title }}"
                                                        name="intake_data[{{ $k }}][answer]"
                                                        id="myrange">
                                                    {{ $val->title }}
                                                    <span class="money" id="value-lower"></span>
                                                    <span class="money" id="value-upper"></span>
                                                </p>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </fieldset>
                    @endforeach
                    <h3 style="pointer:none !important"> Medication Summary</h3>
                    <fieldset>
                        <div class="fieldset-content">
                            <div>
                                <h2> Medication Summary</h2>

                                @foreach ($all_medicine as $k => $medicine)
                                    <div>
                                        <div class="form-check p-2" style="display:flex; ">
                                            <input class="form-check-input" type="hidden"
                                                name="medication_data[dosespot_rxcui]"
                                                value="{{ $medicine->dosespot_rxcui }}">
                                            <input class="form-check-input" type="hidden"
                                                name="medication_data[active]" value="{{ $medicine->active }}">
                                            <input class="form-check-input" type="hidden"
                                                name="medication_data[ndc]" value="{{ $medicine->ndc }}">
                                            <input class="form-check-input" type="hidden"
                                                name="medication_data[days_supply]"
                                                value="{{ $medicine->days_supply }}">
                                            <input class="form-check-input" type="hidden"
                                                name="medication_data[refills]" value="{{ $medicine->refills }}">
                                            <input class="form-check-input" type="hidden"
                                                name="medication_data[pharmacy_notes]"
                                                value="{{ $medicine->pharmacy_notes }}">
                                            <input class="form-check-input" type="hidden"
                                                name="medication_data[directions]"
                                                value="{{ $medicine->directions }}">
                                            <input class="form-check-input" type="hidden"
                                                name="medication_data[quantity]" value="{{ $medicine->quantity }}">
                                            <input class="form-check-input" type="hidden"
                                                name="medication_data[dispense_unit]"
                                                value="{{ $medicine->dispense_unit }}">
                                            <input class="form-check-input" type="hidden"
                                                name="medication_data[strength]" value="{{ $medicine->strength }}">
                                            <input class="form-check-input" type="hidden"
                                                name="medication_data[dispense_unit_id]"
                                                value="{{ $medicine->dispense_unit_id }}">
                                            <input class="form-check-input" type="hidden"
                                                name="medication_data[pharmacy_id]"
                                                value="{{ $medicine->pharmacy_id }}">
                                            <input class="form-check-input" type="hidden"
                                                name="medication_data[pharmacy_name]"
                                                value="{{ $medicine->pharmacy_name }}">
                                            <input class="form-check-input" type="hidden"
                                                name="medication_data[metadata]" value="{{ $medicine->metadata }}">
                                            <input class="form-check-input" type="hidden"
                                                name="medication_data[thank_you_note]"
                                                value="{{ $medicine->thank_you_note }}">
                                            <input class="form-check-input" type="hidden"
                                                name="medication_data[clinical_note]"
                                                value="{{ $medicine->clinical_note }}">
                                            <input class="form-check-input" type="hidden"
                                                name="medication_data[allow_substitutions]"
                                                value="{{ $medicine->allow_substitutions }}">
                                            <input class="form-check-input" type="hidden"
                                                name="medication_data[title]" value="{{ $medicine->title }}">
                                            <input class="form-check-input" type="hidden"
                                                name="medication_data[partner_medication_id]"
                                                value="{{ $medicine->partner_medication_id }}">
                                            <input class="form-check-input" type="hidden"
                                                name="medication_data[effective_date]"
                                                value="{{ $medicine->effective_date }}">
                                            <p>{{ $medicine->name }}</p>
                                            <p>Refills : {{ $medicine->refills }} & Days_supply :
                                                {{ $medicine->days_supply }}</p>
                                            <label class="form-check-label" for="exampleRadios1"
                                                style="padding: 18px">{{ $medicine->name }} |
                                                {{ $medicine->strength }} </label>

                                        </div>

                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </fieldset>
                    <h3 style="pointer:none !important"> Subscription</h3>
                    <fieldset>.
                        <div class="fieldset-content">

                            <div><b>How often do you want to your meds shipped?</b>
                                <p>Never be caught without'em.</p>
                                <div class="form-check p-2" style="display:flex;">
                                    <input class="form-check-input" type="radio"
                                        name="medication_data[shipped_time]" value="1"
                                        style="width:3% !important">
                                    <label class="form-check-label" for="exampleRadios1" style="padding: 18px">
                                        Ship Every 1 Month
                                    </label>
                                </div>
                                <div class="form-check p-2" style="display:flex;">
                                    <input class="form-check-input" type="radio"
                                        name="medication_data[shipped_time]" style="width:3% !important"
                                        value="3">
                                    <label class="form-check-label" for="exampleRadios2" style="padding: 18px">
                                        Ship Every 3 Month
                                    </label>
                                </div>
                                @if ($errors->has('medication_data.shipped_time'))
                                <span style="color:red;">{{ $errors->first('medication_data.shipped_time') }}</span>
                            @endif
                            </div>
                        </div>
                    </fieldset>
                    <h3>Govt. ID Verifictaion</h3>
                    <fieldset>
                        <h2>Government Issued ID</h2>
                        <p class="desc">We take privacy and security seriosuly Upload your ID so we know its you!</p>
                        <div class="fieldset-content">
                            <div class="form-row">
                                <div class="form-flex">
                                    <div class="form-group">
                                        <label for="phone" class="form-label">Government Issued ID</label>
                                        <input type="file" name="file" class="form-select" id="fileselect"
                                            style="padding:14px">
                                            @if ($errors->has('file'))
                                            <span style="color:red;">{{ $errors->first('file') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="phone" class="form-label">Government ID Name</label>
                                        <input type="text" name="filename" class="form-select">
                                        @if ($errors->has('filename'))
                                        <span style="color:red;">{{ $errors->first('filename') }}</span>
                                    @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    <h3>Payments</h3>
                    <fieldset>
                        <h2>Set Financial Goals</h2>
                        <p class="desc">Set up your money limit to reach the future plan</p>
                        <div class="fieldset-content">
                            <div class="form-date">
                                <div class="form-date-group">
                                    Payment Section
                                </div>
                            </div>
                        </div>
                    </fieldset>
                </div>
            </form>
        </div>
    </div>

</body>
<script src="{{ asset('vendor/jquery-validation/dist/additional-methods.min.js') }}"></script>
<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('vendor/jquery-steps/jquery.steps.min.js') }}"></script>
<script src="{{ asset('vendor/minimalist-picker/dobpicker.js') }}"></script>
<script src="{{ asset('vendor/jquery-validation/dist/jquery.validate.min.js') }}"></script>
<script src="{{ asset('vendor/nouislider/nouislider.min.js') }}"></script>
<script src="{{ asset('vendor/wnumb/wNumb.js') }}"></script>
<script src="{{ asset('js/main.js') }}"></script>


</html>
