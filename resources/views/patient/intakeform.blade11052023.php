<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="colorlib.com">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign Up Form</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
    <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">
    <link rel="stylesheet" href="{{ asset('vendor/nouislider/nouislider.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css" />



</head>
<body>
    <div class="main">
        <div class="container">
            <form id="signup-form" action="{{ route('form.store') }}" class="signup-form" role="form" method="post"
                files=true enctype='multipart/form-data' accept-charset="utf-8">
                @csrf
                <div>
                    {{-- <h3>Create Patient</h3>
                    <fieldset>
                        <div class="fieldset-content">

                            <div class="form-group">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" id="email" placeholder="Enter email" />
                            </div>
                            <div class="form-group">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" name="user_data[password]" id="password"
                                    placeholder="password" />
                            </div>

                            <div class="form-group">
                                <label for="password" class="form-label">Confirm Password</label>
                                <input type="password" name="user_data[password]" id="password"
                                    placeholder="Confirm password" />
                            </div>

                        </div>
                    </fieldset> --}}
                    <h3>Patient Details</h3>
                    <fieldset>
                        <div class="fieldset-content">
                            <div class="form-row">
                                <label class="form-label">Name</label>
                                <div class="form-flex">
                                    <div class="form-group">
                                        <input type="text" name="user_data[first_name]" id="first_name"
                                            placeholder="First Name" />
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="user_data[last_name]" id="last_name"
                                            placeholder="Last Name" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-date">
                                <label for="birth_date" class="form-label">Birth Date</label>
                                <input type="date" name="user_data[dob]" id="birth_date"
                                    placeholder="Date of Birth" />
                            </div>
                            <div class="form-row">
                                <div class="form-flex">
                                    <div class="form-group">
                                        <label class="form-label" id="exampleFormControlSelect1">Gender</label>
                                        <select class="form-label" name="user_data[gender]"
                                            id="exampleFormControlSelect1">
                                            <option value="0">Not known</option>
                                            <option value="1">Male</option>
                                            <option value="2">Female</option>
                                            <option value="9">Not Applicable</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="phone" class="form-label">Phone</label>
                                        <input id="phone" type="text" name="user_data[phone]" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="ssn" class="form-label">Address</label>
                                <input type="text" name="user_data[address]" id="address" placeholder="Address" />
                            </div>
                            <div class="form-group">
                                <label for="ssn" class="form-label">Address 2</label>
                                <input type="text" name="user_data[address2]" id="ssn"
                                    placeholder="Additional Address" />
                            </div>
                            <div class="form-row">
                                <div class="form-flex">
                                    <div class="form-group">
                                        <label for="city" class="form-label">City</label>
                                        <input type="text" name="user_data[city]" id="city" />
                                    </div>
                                    <div class="form-group">
                                        <label for="state" class="form-label">State</label>
                                        <input type="text" name="user_data[state]" id="state" />
                                    </div>
                                    <div class="form-group">
                                        <label for="zip_code" class="form-label">Zip Code</label>
                                        <input type="text" name="user_data[zip_code]" id="zip_code" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-flex">
                                    <div class="form-group">
                                        <label for="city" class="form-label">Create new password</label>
                                        <input type="password" name="user_data[weight]" id="weight" />
                                    </div>
                                    <div class="form-group">
                                        <label for="state" class="form-label">Confirm Password</label>
                                        <input type="password" name="user_data[height]" id="height" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    <h3> General Questions</h3>
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
                                        <input type="text" name="user_data[weight]" id="weight" />
                                    </div>
                                    <div class="form-group">
                                        <label for="state" class="form-label">Height in CM</label>
                                        <input type="text" name="user_data[height]" id="height" />
                                    </div>
                                    <div class="form-group">
                                        <label for="pregnancy" class="form-label">Pregnancy</label>
                                        <select id="pregnancy" name="pregnancy">
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-flex">
                                    <div class="form-group">
                                        <label for="city" class="form-label">Known patient's allergies</label>
                                        <input type="text" name="user_data[allergeis]" id="allergeis" />
                                    </div>
                                    <div class="form-group">
                                        <label for="state" class="form-label">Current Medications</label>
                                        <input type="text" name="user_data[current_medication]"
                                            id="current_medication" />
                                    </div>
                                </div>
                            </div>
                            <div style="overflow:auto;margin-bottom:10px;" id="divBtn">
                                <button type="button" id="nextBtn" onclick="nextPrev(1)"
                                    style="width: 100%;">Continue</button>
                            </div>
                            <div style="text-align:center;margin-top:40px; display:none;">
                                <span class="step"></span>
                                @foreach ($data as $k => $val)
                                    <span class="step"></span>
                                @endforeach
                            </div>
                        </div>
                    </fieldset>
                    <h3> Medicine Questions</h3>
                    <fieldset>
                        <div class="fieldset-content">
                            <div class="tab">
                                <h2>{{$disease_name}}</h2>
                                <p class="desc">We're going to ask you some questions.This should take a few minute.
                                </p>
                            </div>
                            <!-- @foreach ($data as $k => $val)
                                <div class="tab">{{ $val->title }}
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
                                                name="intake_data[{{ $k }}][answer]"
                                                id="{{ $val->title }}" value=""
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
                                                id="{{ $val->title }}" style="width:3% !important" value="N">
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
                                                    name="multiple_option[{{ $k }}]" id=""
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
                                                name="intake_data[{{ $k }}][answer]"
                                                id="{{ $val->title }}" value=""
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
                                                    name="intake_data[{{ $k }}][answer]"
                                                    id="exampleRadios1" value="" style="width:3% !important">
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
                                                name="intake_data[{{ $k }}][answer]" id=""
                                                value="" style="margin-top: 5px; margin-bottom: 5px;" />
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
                                                name="intake_data[{{ $k }}][answer]" id=""
                                                value="" style="margin-top: 5px; margin-bottom: 5px;" />
                                        </div>
                                    @elseif($val->type == 'ordering')
                                        {{-- <input type="hidden" name="intake_data[{{$k}}][partner_questionnaire_question_id]" value="{{$val->partner_questionnaire_question_id}}"> --}}
                                        <div class="form-check p-2" style="display:flex;">
                                            <input class="form-check-input" type="radio" name=""
                                                id="exampleRadios1" value="" style="width:3% !important">
                                            <label class="form-check-label" for="exampleRadios1"
                                                style="padding: 18px">
                                                Yes
                                            </label>
                                        </div>
                                        <div class="form-check p-2" style="display:flex;">
                                            <input class="form-check-input" type="radio" name=""
                                                id="exampleRadios2" style="width:3% !important" value="">
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
                                            </div> 
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
                            @endforeach -->

                            <div style="overflow:auto;margin-bottom:10px;" id="divBtn">
                                <button type="button" id="nextBtn" onclick="nextPrev(1)"
                                    style="width: 100%;">Continue</button>
                            </div>
                            <div style="text-align:center;margin-top:40px; display:none;">
                                <span class="step"></span>
                                @foreach ($data as $k => $val)
                                    <span class="step"></span>
                                @endforeach
                            </div>
                        </div>
                    </fieldset>
                    <h3 style="pointer:none !important"> Medication Summary</h3>
                    <fieldset>
                        <div class="fieldset-content">
                            <div class="tab1">
                                <h2>Which medication do you prefer?</h2>
                                <p class="desc">Specific drugs with dosages.</p>
                                @foreach ($all_medicine as $k => $medicine)
                                    <div style="border: 1px solid; margin: 5px;">
                                        <div class="form-check p-2" style="display:flex; ">
                                            <input class="form-check-input" type="hidden"
                                                name="medication_data[dosespot_rxcui]" id=""
                                                value="{{ $medicine->dosespot_rxcui }}">
                                            <input class="form-check-input" type="hidden"
                                                name="medication_data[active]" id=""
                                                value="{{ $medicine->active }}">
                                            <input class="form-check-input" type="hidden"
                                                name="medication_data[ndc]" id=""
                                                value="{{ $medicine->ndc }}">
                                            <input class="form-check-input" type="hidden"
                                                name="medication_data[days_supply]" id=""
                                                value="{{ $medicine->days_supply }}">
                                            <input class="form-check-input" type="hidden"
                                                name="medication_data[refills]" id=""
                                                value="{{ $medicine->refills }}">
                                            <input class="form-check-input" type="hidden"
                                                name="medication_data[pharmacy_notes]" id=""
                                                value="{{ $medicine->pharmacy_notes }}">
                                            <input class="form-check-input" type="hidden"
                                                name="medication_data[directions]" id=""
                                                value="{{ $medicine->directions }}">
                                            <input class="form-check-input" type="hidden"
                                                name="medication_data[quantity]" id=""
                                                value="{{ $medicine->quantity }}">
                                            <input class="form-check-input" type="hidden"
                                                name="medication_data[dispense_unit]" id=""
                                                value="{{ $medicine->dispense_unit }}">
                                            <input class="form-check-input" type="hidden"
                                                name="medication_data[strength]" id=""
                                                value="{{ $medicine->strength }}">
                                            <input class="form-check-input" type="hidden"
                                                name="medication_data[dispense_unit_id]" id=""
                                                value="{{ $medicine->dispense_unit_id }}">
                                            <input class="form-check-input" type="hidden"
                                                name="medication_data[pharmacy_id]" id=""
                                                value="{{ $medicine->pharmacy_id }}">
                                            <input class="form-check-input" type="hidden"
                                                name="medication_data[pharmacy_name]" id=""
                                                value="{{ $medicine->pharmacy_name }}">
                                            <input class="form-check-input" type="hidden"
                                                name="medication_data[metadata]" id=""
                                                value="{{ $medicine->metadata }}">
                                            <input class="form-check-input" type="hidden"
                                                name="medication_data[thank_you_note]" id=""
                                                value="{{ $medicine->thank_you_note }}">
                                            <input class="form-check-input" type="hidden"
                                                name="medication_data[clinical_note]" id=""
                                                value="{{ $medicine->clinical_note }}">
                                            <input class="form-check-input" type="hidden"
                                                name="medication_data[allow_substitutions]" id=""
                                                value="{{ $medicine->allow_substitutions }}">
                                            <input class="form-check-input" type="hidden"
                                                name="medication_data[title]" id=""
                                                value="{{ $medicine->title }}">
                                            <input class="form-check-input" type="hidden"
                                                name="medication_data[partner_medication_id]" id=""
                                                value="{{ $medicine->partner_medication_id }}">
                                            <input class="form-check-input" type="hidden"
                                                name="medication_data[effective_date]" id=""
                                                value="{{ $medicine->effective_date }}">
                                            <input class="form-check-input" type="radio"
                                                name="medication_data[name]" id="exampleRadios1"
                                                value="{{ $medicine->name }}" style="width:3% !important">
                                            <label class="form-check-label" for="exampleRadios1"
                                                style="padding: 18px">{{ $medicine->name }} |
                                                {{ $medicine->strength }} </label>

                                            {{-- <div class="form-check p-2" style="display:flex;">
                                            <input class="form-check-input" type="radio"
                                                name="intake_data[{{ $k }}][answer]"
                                                id="exampleRadios1" value="" style="width:3% !important">
                                            <label class="form-check-label" for="exampleRadios1"
                                                style="padding: 18px">
                                                {{ $option->title }}
                                            </label>
                                        </div> --}}

                                        </div>
                                        <div style="margin-left: 58px;">
                                            <p>Refills : {{ $medicine->refills }} & Days_supply :
                                                {{ $medicine->days_supply }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <div class="tab1"><b>How often do you want to your meds shipped?</b>
                                <p>Never be caught without'em.</p>
                                <div class="form-check p-2" style="display:flex;">
                                    <input class="form-check-input" type="radio"
                                        name="medication_data[shipped_time]" id="exampleRadios1" value="1"
                                        style="width:3% !important">
                                    <label class="form-check-label" for="exampleRadios1" style="padding: 18px">
                                        Ship Every 1 Month
                                    </label>
                                </div>
                                <div class="form-check p-2" style="display:flex;">
                                    <input class="form-check-input" type="radio"
                                        name="medication_data[shipped_time]" id="exampleRadios2"
                                        style="width:3% !important" value="3">
                                    <label class="form-check-label" for="exampleRadios2" style="padding: 18px">
                                        Ship Every 3 Month
                                    </label>
                                </div>
                            </div>
                            <div style="overflow:auto; padding:2px;" id="divBtn1">
                                <button type="button" id="nextBtn" onclick="nextPrev1(1)"
                                    style="width: 100%;">Continue</button>
                            </div>
                            <div style="text-align:center;margin-top:40px; display:none;">
                                <span class="step1"></span>
                                <span class="step1"></span>
                                <button type="submit" value="submit" style="visibility: hidden;">Submit</button>
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
                                        <!-- <input type="file" name="file" id="file" style="padding:14px"/> -->
                                        <input type="file" name="file" id="inputFile" class="form-control">
                                        <span class="text-danger" id="file-input-error"></span>
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
    <script>
        var currentTab = 0;
        showTab(currentTab);

        function showTab(n) {
            var x = document.getElementsByClassName("tab");
            x[n].style.display = "block";

            // if (n == 0) {
            //     document.getElementById("prevBtn").style.display = "none";
            // } else {
            //     document.getElementById("prevBtn").style.display = "inline";
            // }

            if (n == (x.length - 1)) {
                // document.getElementById("nextBtn").innerHTML = "Next";
                $('#divBtn').css("display", "none");
                $('.actions').show();

            } else {
                // document.getElementById("nextBtn").innerHTML = "Next";
            }

            fixStepIndicator(n)
        }

        function nextPrev(n) {
            var x = document.getElementsByClassName("tab");
            // if (n == 1 && !validateForm()) return false;
            x[currentTab].style.display = "none";
            currentTab = currentTab + n;
            // alert(x.length);
            if (currentTab >= x.length) {
                document.getElementById("signup-form").submit();
                return true;
            }
            showTab(currentTab);
        }

        function validateForm() {
            var x, y, i, valid = true;
            x = document.getElementsByClassName("tab");
            y = x[currentTab].getElementsByTagName("input");
            for (i = 0; i < y.length; i++) {
                if (y[i].value == "") {
                    y[i].className += " invalid";
                    valid = false;
                }
            }
            if (valid) {
                document.getElementsByClassName("step")[currentTab].className += " finish";
            }
            return valid;
        }

        function fixStepIndicator(n) {
            var i, x = document.getElementsByClassName("step");
            for (i = 0; i < x.length; i++) {
                x[i].className = x[i].className.replace(" active", "");
            }
            x[n].className += " active";
        }

        var currentTab1 = 0;
        showTab1(currentTab1);

        function showTab1(n) {
            var x = document.getElementsByClassName("tab1");
            x[n].style.display = "block";

            // if (n == 0) {
            //     document.getElementById("prevBtn").style.display = "none";
            // } else {
            //     document.getElementById("prevBtn").style.display = "inline";
            // }

            if (n == (x.length - 1)) {
                // document.getElementById("nextBtn").innerHTML = "Next";
                $('#divBtn1').css("display", "none");
                $('.actions').show();

            } else {
                // document.getElementById("nextBtn").innerHTML = "Next";
            }

            fixStepIndicator1(n)
        }

        function nextPrev1(n) {
            var x = document.getElementsByClassName("tab1");
            // if (n == 1 && !validateForm1()) return false;
            x[currentTab1].style.display = "none";
            currentTab1 = currentTab1 + n;
            // alert(x.length);
            if (currentTab1 >= x.length) {
                // alert(currentTab);

                document.getElementById("signup-form").submit();
                return true;
            }
            showTab1(currentTab1);
        }

        function validateForm1() {
            var x, y, i, valid = true;
            x = document.getElementsByClassName("tab1");
            y = x[currentTab1].getElementsByTagName("input");
            for (i = 0; i < y.length; i++) {
                if (y[i].value == "") {
                    y[i].className += " invalid";
                    valid = false;
                }
            }
            if (valid) {
                document.getElementsByClassName("step1")[currentTab1].className += " finish";
            }
            return valid;
        }

        function fixStepIndicator1(n) {
            var i, x = document.getElementsByClassName("step1");
            for (i = 0; i < x.length; i++) {
                x[i].className = x[i].className.replace(" active", "");
            }
            x[n].className += " active";
        }
    </script>
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery-validation/dist/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery-validation/dist/additional-methods.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery-steps/jquery.steps.min.js') }}"></script>
    <script src="{{ asset('vendor/minimalist-picker/dobpicker.js') }}"></script>
    <script src="{{ asset('vendor/nouislider/nouislider.min.js') }}"></script>
    <script src="{{ asset('vendor/wnumb/wNumb.js') }}"></script>
    <script src="{{ asset('js/main.js') }}""></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</body>
</html>

{{-- @push('scripts')

{!! JsValidator::formRequest('App\Http\Requests\PatientDetailsRequest','#signup-form') !!}
@endpush --}}