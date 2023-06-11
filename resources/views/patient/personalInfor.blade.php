@extends('layouts.patientheader')

<section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-6 mx-auto d-flex flex-column align-items-center justify-content-center">
                @include('layouts.patientlogo')
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Patient Details</h5>

                        <!-- General Form Elements -->
                        <form  action="{{ route('personalInfo.store') }}" role="form" method="post" files=true
                            enctype='multipart/form-data' accept-charset="utf-8" name="personalInfo" id="personalInfo">
                            <input type="hidden" name="email" value="{{$email}}"/>
                            <input type="hidden" name="mId" value="{{$mId}}"/>
                            <input type="hidden" name="bid" value="{{$bid}}"/>
                            @csrf
                            <div class="row g-3">
                                <label for="inputName" class="form-label">Your Name</label>
                                <div class="col-md-6"><input type="text" placeholder="First Name"class="form-control" id="firstname" name="firstname"></div>
                                <div class="col-md-6"><input type="text" placeholder="Last Name" class="form-control" id="lastname" name="lastname"></div>
                            
                                <div class="col-md-6">
                                    <label for="inputEmail" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="password" name="password">
                                </div>
                                <div class="col-md-6">
                                    <label for="inputPassword" class="form-label">Confirm Password</label>
                                    <input type="password" class="form-control" id="confirmpassword" name="confirmpassword">
                                </div>
                                <div class="col-md-6">
                                    <label for="inputDOB" class="form-label">Birth Date</label>
                                    <input type="date" class="form-control" id="inputDOB" name="dob">
                                </div>
                                <div class="col-md-6">
                                    <label for="inputGender" class="form-label">Gender</label>
                                    <select class="form-select" name="gender"  id="gender">
                                        <option value="">Please Select</option>
                                        <option value="0">Not known</option>
                                        <option value="1">Male</option>
                                        <option value="2">Female</option>
                                        <option value="9">Not Applicable</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="inputPhnType" class="form-label">Phone Type</label>
                                    <select class="form-select" id="phntype" name="phntype">
                                        <option value="">Please Select</option>
                                        <option value="2">2</option>
                                        <option value="4">4</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="inputPhone" class="form-label">Phone</label>
                                    <input type="number" class="form-control" name="phone" id="phone">
                                </div>
                                <div class="col-12">
                                    <label for="inputAddress" class="form-label">Address</label>
                                    <input type="text" class="form-control" id="address1" name ="address1"  placeholder="1234 Main St">
                                </div>
                                <div class="col-12">
                                    <label for="inputAddress2" class="form-label">Address 2</label>
                                    <input type="text" class="form-control" id="address2" name ="address2" placeholder="Apartment, studio, or floor">
                                </div>
                                <div class="col-md-2">
                                    <label for="inputZip" class="form-label" >Zip</label>
                                    <input type="text" class="form-control" id="zip" name ="zip">
                                </div>
                                <div class="col-md-6">
                                    <label for="inputCity" class="form-label">City</label>
                                    <input type="text" class="form-control" id="city" name ="city" readonly >
                                </div>
                                <div class="col-md-4">
                                    <label for="inputState" class="form-label">State</label>
                                    <input type="text" class="form-control" id="state" name ="state" readonly >
                                </div>
                                <div class="col-md-4">
                                    <label for="inputZip" class="form-label" >Weight (in lbs)</label>
                                    <input type="text" class="form-control" id="weight" name ="weight" onkeyup="calculateBMI()" onclick="calculateBMI()">
                                </div>
                                <div class="col-md-4">
                                    <label for="inputCity" class="form-label">Height (in cm)</label>
                                    <input type="text" class="form-control" id="height" name ="height" onkeyup="calculateBMI()" onclick="calculateBMI()">
                                </div>
                                <div class="col-md-4">
                                    <label for="inputState" class="form-label">BMI</label>
                                    <input type="text" class="form-control" id="bmi" name ="bmi" readonly >
                                </div>
                                <div class="col-md-6">
                                    <label for="inputZip" class="form-label" >Pregnancy</label>
                                    <select class="form-select" id="pregnancy" name="pregnancy">
                                        <option value="">Please Select</option>
                                        <option value="y">Yes</option>
                                        <option value="n">No</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="inputCity" class="form-label">Allergeis</label>
                                    <input type="text" class="form-control" id="allergeis" name ="allergeis">
                                </div>
                                <div class="col-md-12">
                                    <label for="inputState" class="form-label">Current Medication</label>
                                    <input type="text" class="form-control" id="c_med" name ="c_med" >
                                </div>
                                <div class="col-12">
                                    <div class="form-check">
                                    <input class="form-check-input" type="checkbox"  id="check" name ="check">
                                    <label class="form-check-label" for="gridCheck">
                                        Check me out
                                    </label>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    <button type="reset" class="btn btn-secondary">Reset</button>
                                </div>
                            </div>
                        </form>
                        <!-- End General Form Elements -->

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Scripts -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
<script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.min.js')}}"></script>
<script>
    $(document).ready(function() {
        $(document).on("keyup", "#zip", function() {
            var pincode = $(this).val();

            if (pincode.length < 5 || pincode.length > 5) {

            }else if (pincode.length == 5 && $.isNumeric(pincode)) {
            console.log(pincode);
                $.ajax({
                    url: '/pincode/' + pincode,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        console.log(data);
                        $('#city').val(data['city']);
                        $('#state').val(data['state']);
                    },
                    error: function(xhr, status, error) {
                        var err = eval("(" + xhr.responseText + ")");
                        alert("Please enter correct Postal Code");
                    }
                });
            }
        });
    });
  </script>
  <script>
    function calculateBMI() {
      var weight_in_lbs = parseFloat(document.getElementById('weight').value);
      var height_in_cm = parseFloat(document.getElementById('height').value);
      var bmi=0;
      if (isNaN(weight_in_lbs) || isNaN(height_in_cm)) {
        document.getElementById('bmi').value = bmi.toFixed(2);
        return;
      }
      var height = height_in_cm / 100;
      var weight = weight_in_lbs / 2.2046;
      bmi = weight / (height * height);
      document.getElementById('bmi').value = bmi.toFixed(2);
    }
  </script>
{!! JsValidator::formRequest('App\Http\Requests\PatientInfoStore','#personalInfo') !!}
