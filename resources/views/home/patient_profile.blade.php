
  @include('home.header');
  <!-- ======= Sidebar ======= -->
  @include('home.slidebar');
  <!-- <style>
      span{
        color:red;
      }
    </style> -->
  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Profile</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Users</li>
          <li class="breadcrumb-item active">Profile</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section profile">
      <div class="row">

        <div class="col-xl-12">

          <div class="card">
            <div class="card-body pt-3">
              <!-- Bordered Tabs -->
              <ul class="nav nav-tabs nav-tabs-bordered">
                <li class="nav-item">
                  <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profile</button>
                </li>
                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Change Password</button>
                </li>

              </ul>
              <div class="tab-content pt-2">

                <div class="tab-pane fade show active profile-edit pt-3" id="profile-edit">

                  <!-- Profile Edit Form -->
                  <form method="POST" action="{{ route('patient_profile.update', ['patient_profile' =>$patient_data->id]) }}" id="profile">
                    @csrf
                    @method('PUT')
                    <div class="row mb-3">
                      <label for="firstname" class="col-md-4 col-lg-3 col-form-label">First Name</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="first_name" type="text" class="form-control" id="FirstName" value="{{$patient_data->name}}">
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label for="lastname" class="col-md-4 col-lg-3 col-form-label">Last Name</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="last_name" type="text" class="form-control" id="LastName" value="{{$patient_data->last_name}}">
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label for="company" class="col-md-4 col-lg-3 col-form-label">Email</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="email" type="text" class="form-control" id="email" value="{{$patient_data->email}}" disabled>
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label for="about" class="col-md-4 col-lg-3 col-form-label">Gender</label>
                      <div class="col-md-8 col-lg-9">
                        <select class="form-control" name="gender" id="gender">
                        <option value="">Please Select</option>
                        <option value="0" @if($patient_data->gender == 0) selected @endif>Not known</option>
                        <option value="1" @if($patient_data->gender == 1) selected @endif>Male</option>
                        <option value="2" @if($patient_data->gender == 2) selected @endif>Female</option>
                        <option value="9" @if($patient_data->gender == 9) selected @endif>Not Applicable</option>
                    </select>

                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Job" class="col-md-4 col-lg-3 col-form-label">Birth Date</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="dob" id="dob" type="date" class="form-control"  value="{{date('Y-m-d', strtotime($patient_data->date_of_birth)) }}">
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label for="company" class="col-md-4 col-lg-3 col-form-label">Phone Number</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="phone" id="phone" type="text" class="form-control"  value="{{$patient_data->phone_number}}">
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label for="company" class="col-md-4 col-lg-3 col-form-label">Phone Type</label>
                      <div class="col-md-8 col-lg-9">
                        <select class="form-select" id="phntype" name="phntype">
                              <option value="">Please Select</option>
                              <option value="2" @if($patient_data->phone_type == 2) selected @endif>2</option>
                              <option value="4" @if($patient_data->phone_type == 4) selected @endif>4</option>
                          </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                      <label for="company" class="col-md-4 col-lg-3 col-form-label">Weight (in lbs)</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="weight" id="weight" type="number" class="form-control"  value="{{$patient_data->weight}}" onkeyup="calculateBMI()" onclick="calculateBMI()">
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label for="company" class="col-md-4 col-lg-3 col-form-label">Height (in cm)</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="height" id="height" type="number" class="form-control"  value="{{$patient_data->height}}" onkeyup="calculateBMI()" onclick="calculateBMI()">
                      </div>
                    </div>
                    <div class="row mb-3">
                          <label for="inputState" class="col-md-4 col-lg-3 col-form-label" >BMI</label>
                          <div class="col-md-8 col-lg-9">
                            <input type="text" class="form-control" id="bmi" name ="bmi" id="bmi" value="{{$patient_data->bmi}}" readonly >
                          </div>
                    </div>
                    <div class="row mb-3">
                      <label for="Phone" class="col-md-4 col-lg-3 col-form-label">Address 1</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="address1" id="address1" type="text" class="form-control"  value="{{$patient_data->address1}}">
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label for="Phone" class="col-md-4 col-lg-3 col-form-label">Address 2</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="address2" id="address2" type="text" class="form-control"  value="{{$patient_data->address2}}">
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label for="Phone" class="col-md-4 col-lg-3 col-form-label">Zip</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="zip" id="zip" type="text" class="form-control"  value="{{$patient_data->zip_code}}">
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label for="Phone" class="col-md-4 col-lg-3 col-form-label">City</label>
                      <div class="col-md-8 col-lg-9">
                      <input name="city_id" id="city_id" type="hidden" class="form-control"  value="{{$patient_data->cityId}}">
                      
                        <input name="city" id="city" type="text" class="form-control"  value="{{$patient_data->city_name}}">
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label for="Phone" class="col-md-4 col-lg-3 col-form-label">State</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="state" id="state" type="text" class="form-control"  value="{{$patient_data->state_name}}">
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label for="pregnancy" class="col-md-4 col-lg-3 col-form-label">Allergies</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="allergeis" id="allergeis" type="text" class="form-control"  value="{{$patient_data->allergies}}">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="pregnancy" class="col-md-4 col-lg-3 col-form-label">Pregnancy</label>
                      <div class="col-md-8 col-lg-9">
                       <select class="form-select" id="pregnancy" name="pregnancy">
                              <option value="">Please Select</option>
                              <option value="y" @if($patient_data->pregnancy == "y") selected @endif>Yes</option>
                              <option value="n" @if($patient_data->pregnancy == "n") selected @endif>No</option>
                          </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                      <label for="" class="col-md-4 col-lg-3 col-form-label">Current Medications</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="c_med" id="c_med" type="text" class="form-control"  value="{{$patient_data->current_medications}}">
                      </div>
                    </div>


                    <div class="text-center">
                      <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                  </form><!-- End Profile Edit Form -->

                </div>

                <div class="tab-pane fade pt-3" id="profile-change-password">
                  <!-- Change Password Form -->
                  <form method="POST" action="{{ route('patient_profile.updatePassword', ['id' =>$patient_data->id]) }}">
                    @csrf
                    @method('POST')

                    <div class="row mb-3">
                      <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Current Password</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="password" type="password" class="form-control" id="currentPassword">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New Password</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="newpassword" type="password" class="form-control" id="newPassword">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Re-enter New Password</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="renewpassword" type="password" class="form-control" id="renewPassword">
                      </div>
                    </div>

                    <div class="text-center">
                      <button type="submit" class="btn btn-primary">Change Password</button>
                    </div>
                  </form><!-- End Change Password Form -->

                </div>

              </div><!-- End Bordered Tabs -->

            </div>
          </div>

        </div>
      </div>
    </section>

  </main><!-- End #main -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="{{ asset('assets/vendor/apexcharts/apexcharts.min.js')}}"></script>
  <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{ asset('assets/vendor/chart.js/chart.umd.js')}}"></script>
  <script src="{{ asset('assets/vendor/echarts/echarts.min.js')}}"></script>
  <script src="{{ asset('assets/vendor/quill/quill.min.js')}}"></script>
  <script src="{{ asset('assets/vendor/simple-datatables/simple-datatables.js')}}"></script>
  <script src="{{ asset('assets/vendor/tinymce/tinymce.min.js')}}"></script>
  <script src="{{ asset('assets/vendor/php-email-form/validate.js')}}"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>
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
                        $('#city_id').val(data['city_id']);
                        $('#city').val(data['city']);
                        $('#state').val(data['state']);
                    },error: function(xhr, status, error) {
                        var err = eval("(" + xhr.responseText + ")");
                        alert("Please enter correct Postal Code");
                        $('#zip').val('');
                        $('#city').val('');
                        $('#state').val('');
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
{!! JsValidator::formRequest('App\Http\Requests\PatientDetailsUpdate','#profile') !!}
</body>

</html>
