<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="stylesheet" href="{{ asset('css/intakeform.css') }}" />
        <script src="{{ asset('js/intakeform.js') }}" defer></script>
        <title>Registraion Form</title>
    </head>
    <body>
    @extends('layouts.patientheader')
        <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8 col-md-6 mx-auto d-flex flex-column align-items-center justify-content-center">
                        @include('layouts.patientlogo')
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="pt-4 pb-2">
                                    <h5 class="card-title text-center pb-0 fs-4">Get Started</h5>
                                    <p class="text-center small">
                                        Let’s get to know you. Share a bit about your health, 
                                        medical history and lifestyle to help our medical team evaluate 
                                        if this treatment is right for you.
                                    </p>
                                </div>
                            <form id="regForm"  action="{{ route('form.store') }}" role="form" method="post" files=true
                                enctype='multipart/form-data' accept-charset="utf-8">
                                <input type="hidden" name="mId" value="{{$mId}}"/>
                                <input type="hidden" name="userId" value="{{$userId}}"/>
                                @csrf
                                <div class="all-steps" id="all-steps"> <span class="step"></span> <span class="step"></span> <span class="step"></span> <span class="step"></span> </div>
                                <!-- TAB 1 -->
                                <div class="tab">
                                    <h2>Medicine Details</h2>
                                    <div class="row g-0">
                                        <div class="col-md-4">
                                        <img src="{{ asset('assets/img/1.png') }}" class="img-fluid rounded-start" alt="...">
                                        </div>
                                        <div class="col-md-8">
                                        <div>
                                            @if (!empty($medicationDetails))
                                                <table>
                                                    <thead>
                                                        <tr>
                                                            <th>Medication Details</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        
                                                            @foreach ($medicationDetails as $med)
                                                                <tr>
                                                                    <td>{{$med['name']}}</td>
                                                                    <td>Strength: {{$med['strength']}}</td>
                                                                    <td>Refill Count: {{$med['refills']}}</td>
                                                                </tr>
                                                            @endforeach
                                                        
                                                    </tbody>
                                                </table>
                                            @endif
                                            @if (!empty($serviceDetails))
                                                <table>
                                                    <thead>
                                                        <tr>
                                                            <th>Services</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        
                                                        @foreach ($serviceDetails as $service)
                                                                <tr>
                                                                    <td>Title: {{$service['title']}}</td>
                                                                    <td>Description: {{$service['description']}}</td>
                                                                </tr>
                                                            @endforeach
                                                        
                                                    </tbody>
                                                </table>
                                            @endif
                                            @if (!empty($suppliesDetails))
                                                <table>
                                                    <thead>
                                                        <tr>
                                                            <th>Supplies</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        
                                                        @foreach ($suppliesDetails as $supply)
                                                                <tr>
                                                                    <td>Title: {{$supply['title']}}</td>
                                                                    <td>Name: {{$supply['name']}}</td>
                                                                    <td>Refill Count{{$supply['refills']}}</td>
                                                                </tr>
                                                            @endforeach
                                                        
                                                    </tbody>
                                                </table>
                                            @endif
                                            @if(!empty($compounds))
                                                <table>
                                                    <thead>
                                                        <tr>
                                                            <th>Compounds</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        
                                                        @foreach ($compounds as $compound)
                                                                <tr>
                                                                    <td>{{$compound['partner_compound_id']}}</td>
                                                                    <td>{{$compound['pharmacy_id']}}</td>
                                                                    <!-- Add more columns as needed -->
                                                                </tr>
                                                            @endforeach
                                                        
                                                    </tbody>
                                                </table>
                                            @endif
                                        </div>

                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="gridCheck">
                                            <label class="form-check-label" for="gridCheck">
                                                Check me out
                                            </label>
                                            </div>
                                    </div>
                                </div>
                                <!-- TAB 2 -->
                                <div class="tab">
                                    @foreach($ques as $key => $que)
                                        <div class="col-md-12">
                                            <label for="inputEmail" class="form-label">{{$key+1}}. {{ $que->title }}</label>
                                            <input type="hidden" name="intake_data[{{ $key }}][partner_questionnaire_question_id]" value="{{ $que->partner_questionnaire_question_id }}">
                                            <input type="hidden" name="intake_data[{{ $key }}][type]" value="{{ $que->type }}">
                                            <input type="hidden" name="intake_data[{{ $key }}][title]" value="{{ $que->title }}">
                                            <input type="hidden" name="intake_data[{{ $key }}][description]" value="{{ $que->description }}">
                                            <input type="hidden" name="intake_data[{{ $key }}][label]" value="{{ $que->label }}">
                                            <input type="hidden" name="intake_data[{{ $key }}][placeholder]" value="{{ $que->placeholder }}">
                                            <input type="hidden" name="intake_data[{{ $key }}][is_important]" value="{{ $que->is_important }}">
                                            <input type="hidden" name="intake_data[{{ $key }}][is_critical]" value="{{ $que->is_critical }}">
                                            <input type="hidden" name="intake_data[{{ $key }}][is_optional]" value="{{ $que->is_optional }}">
                                            <input type="hidden" name="intake_data[{{ $key }}][is_visible]" value="{{ $que->is_visible }}">
                                            <input type="hidden" name="intake_data[{{ $key }}][order]" value="{{ $que->order }}">
                                            <input type="hidden" name="intake_data[{{ $key }}][default_value]" value="{{ $que->default_value }}">
                                            <input type="hidden" name="intake_data[{{ $key }}][options]" value="{{ json_encode($que->options)  }}">

                                            @if ($que->type == 'string' && $que->is_visible )
                                                <input type="text" class="form-control" id="intake_data[{{ $key }}][answer]" name="intake_data[{{ $key }}][answer]">
                                            @elseif ($que->type == 'boolean' && $que->is_visible)
                                                <select class="form-select" id="intake_data[{{ $key }}][answer]" name="intake_data[{{ $key }}][answer]">
                                                    <option value="">Please Select</option>
                                                    <option value="yes">Yes</option>
                                                    <option value="no">No</option>
                                                </select>
                                            @elseif ($que->type == 'multiple_option' && $que->is_visible)
                                                <select class="form-select" id="intake_data[{{ $key }}][answer]" name="intake_data[{{ $key }}][answer]">
                                                    <option value="">Please Select</option>
                                                    @foreach($que->options as $k => $option)
                                                        <option value="{{ $option->title }}">{{ $option->title }}</option>
                                                    @endforeach
                                                </select>
                                            @elseif ($que->type == 'text' && $que->is_visible)
                                                <textarea rows="4" cols="50" class="form-control" id="intake_data[{{ $key }}][answer]" name="intake_data[{{ $key }}][answer]"></textarea>
                                            @elseif ($que->type == 'single_option' && $que->is_visible)
                                                <select class="form-select" id="intake_data[{{ $key }}][answer]" name="intake_data[{{ $key }}][answer]">
                                                    <option value="">Please Select</option>
                                                    @foreach($que->options as $k => $option)
                                                        <option value="{{ $option->title }}" >{{ $option->title }}</option>
                                                    @endforeach
                                                </select>
                                            @elseif ($que->type == 'integer' && $que->is_visible)
                                                <input type="number" min="0" max="100" step="1" id="intake_data[{{ $key }}][answer]" name="intake_data[{{ $key }}][answer]">
                                            @elseif ($que->type == 'date' && $que->is_visible)
                                                <input type="date" class="form-control" id="intake_data[{{ $key }}][answer]" name="intake_data[{{ $key }}][answer]">
                                            @elseif ($que->type == 'ordering' && $que->is_visible)
                                                <div id="sortable" class="sortable-option" style="border: 1px solid black; padding: 10px">
                                                    @foreach($que->options as $k => $option)
                                                    <input type="hidden" name="intake_data[{{ $key }}][answer][{{ $k }}][order]" value="{{ $option->order }}">
                                                    <div class="sortable-option">{{$k+1}}. {{ $option->title }}</div>
                                                    @endforeach
                                                </div>  
                                            @elseif ($que->type == 'range' && $que->is_visible)
                                                <input type="range" min="0" max="100" step="1" class="form-control range-bg" id="intake_data[{{ $key }}][answer]" name="intake_data[{{ $key }}][answer]" value="0">
                                            @endif
                                        </div>
                                    @endforeach
                                    <!-- <div class="col-md-12">
                                        <label for="inputEmail" class="form-label">1. Single Line Question</label>
                                        <input type="text" class="form-control" id="inputPassword">
                                    </div>
                                    <div class="col-md-12">
                                        <label for="inputEmail" class="form-label">2. Single option yes/no question</label>
                                        <select class="form-select">
                                        <option value="">Please Select</option>
                                        <option value="option1">Option 1</option>
                                        <option value="option2">Option 2</option>
                                        </select>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="inputEmail" class="form-label">3. Multi-select question</label>
                                        <select class="form-select">
                                        <option value="">Please Select</option>
                                        <option value="option1">Option 1</option>
                                        <option value="option2">Option 2</option>
                                        </select>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="inputEmail" class="form-label">4. Multiline question</label>
                                        <br>
                                        <textarea rows="4" cols="50" class="form-control"></textarea>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="inputEmail" class="form-label">5. Single option question</label>
                                        <select class="form-select">
                                        <option value="">Please Select</option>
                                        <option value="option1">Option 1</option>
                                        <option value="option2">Option 2</option>
                                        </select>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="inputEmail" class="form-label">6. Numeric question</label>
                                        <input type="number" min="0" max="100" step="1">
                                    </div>
                                    <div class="col-md-12">
                                        <label for="inputEmail" class="form-label">7. Date question</label>
                                        <input type="date" class="form-control" id="inputPassword">
                                    </div>
                                    <div class="col-md-12">
                                        <label for="inputEmail" class="form-label">8. Range question</label>
                                        <input type="range" min="0" max="100" step="1" class="form-control range-bg" id="inputPassword" >
                                    </div>
                                    <div class="col-md-12">
                                        <label for="inputEmail" class="form-label">9. Sort question</label>
                                        <div id="sortable" class="sortable-option">
                                        <div class="sortable-option">Option 1</div>
                                        <div class="sortable-option">Option 2</div>
                                        <div class="sortable-option">Option 3</div>
                                        <div class="sortable-option">Option 4</div>
                                        </div>
                                    </div> -->
                                    <br>
                                </div>
                                <!-- TAB 3 -->
                                <div class="tab">
                                    <label for="radioOptions"><h3>Select Subscription for</h3> </label>
                                    @if (!empty($medicationDetails))
                                        @foreach ($medicationDetails as $med)
                                                <div><h5>{{$med['name']}}</h5></div>
                                                <div><b>Strength:</b> {{$med['strength']}}</div>
                                                <div><b>Refill Count:</b> {{$med['refills']}}</div>
                                        <div id="radioOptions" style="display: flex;flex-direction: row;">
                                            <input type="radio" id="option1" name="options" class="options" value="1" style="margin-right: 2px;transform: scale(0.5);">
                                            <label for="option1"  style="white-space: nowrap;">One Time</label>

                                            <input type="radio" id="option2" name="options" class="options" value="2" style="margin-right: 2px;transform: scale(0.5);"> 
                                            <label for="option2" style="white-space: nowrap;" >Every Month</label>

                                            <input type="radio" id="option3" name="options" class="options" value="3" style="margin-right: 2px;transform: scale(0.5);">
                                            <label for="option2"  style="white-space: nowrap;">Quarterly</label>

                                            <input type="radio" id="option4" name="options" class="options" value="4" style="margin-right: 2px;transform: scale(0.5);">
                                            <label for="option2"  style="white-space: nowrap;">Half yearly</label>

                                            <input type="radio" id="option5" name="options" class="options" value="5" style="margin-right: 2px;transform: scale(0.5);">
                                            <label for="option2" style="white-space: nowrap;">Yearly</label>
                                        </div>
                                        @endforeach
                                    @endif
                                    <div id="radioErrorMessage" style="display: none; color: red;">Please select an option.</div>
                                    <br>
                                    <div>
                                        <label for="govtId"><h3>Upload Government ID</h3></label>
                                        <input type="file" id="govtId" name="govtId" class="form-control" accept=".pdf,.jpg,.jpeg,.png">
                                    </div> 
                                    <br>                               
                                </div>
                                <div class="tab">
                                <label for="radioOptions">Final Payment </label>
                                </div>
                                <!-- <div class="thanks-message text-center" id="text-message"> <img src="https://i.imgur.com/O18mJ1K.png" width="100" class="mb-4">
                                    <h3>Thanks for your information!</h3> <span>Your information has been saved! we will contact you shortly!</span>
                                </div> -->
                                <div style="overflow:auto;" id="nextprevious">
                                    <div style="float:right;">
                                     <button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button> 
                                     <button type="button" id="nextBtn" onclick="nextPrev(1)">Next</button> </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.14.0/Sortable.min.js"></script>
        
        <script>
        const sortable = new Sortable(document.getElementById('sortable'), {
            animation: 150
        });
        
       

            </script>

    </body></html>