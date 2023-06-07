@extends('layouts.patientheader')

<section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center ">
    <div class="row" >
    <div class="col-lg-6 mx-auto">
        <div class="card">
        <div class="card-body">
            <h5 class="card-title">Patient Details</h5>

            <!-- General Form Elements -->
            <form  action="{{ route('personalInfo.store') }}" role="form" method="post" files=true
                enctype='multipart/form-data' accept-charset="utf-8">
                <input type="hidden" name="user_data[email]" value=""/>
                @csrf
                <div class="row g-3">
                    <label for="inputName" class="form-label">Your Name</label>
                    <div class="col-md-6"><input type="text" placeholder="First Name"class="form-control" id="inputName"></div>
                    <div class="col-md-6"><input type="text" placeholder="Last Name" class="form-control" id="inputName"></div>
                
                    <div class="col-md-6">
                        <label for="inputEmail" class="form-label">Password</label>
                        <input type="password" class="form-control" id="inputPassword">
                    </div>
                    <div class="col-md-6">
                        <label for="inputPassword" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" id="inputConfirmPassword">
                    </div>
                    <div class="col-md-6">
                        <label for="inputDOB" class="form-label">Birth Date</label>
                        <input type="date" class="form-control" id="inputDOB">
                    </div>
                    <div class="col-md-6">
                        <label for="inputGender" class="form-label">Gender</label>
                        <select class="form-select" name="user_data[gender]" >
                            <option value="0">Not known</option>
                            <option value="1">Male</option>
                            <option value="2">Female</option>
                            <option value="9">Not Applicable</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="inputPhone" class="form-label">Phone</label>
                        <select class="form-select" name="user_data[phone_type]">
                            <option value="0">Please Select</option>
                            <option value="2">2</option>
                            <option value="4">4</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="inputPhnType" class="form-label">Phone Type</label>
                        <input type="password" class="form-control" id="inputConfirmPassword">
                    </div>
                    <div class="col-12">
                        <label for="inputAddress" class="form-label">Address</label>
                        <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St">
                    </div>
                    <div class="col-12">
                        <label for="inputAddress2" class="form-label">Address 2</label>
                        <input type="text" class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor">
                    </div>
                    <div class="col-md-6">
                        <label for="inputCity" class="form-label">City</label>
                        <input type="text" class="form-control" id="inputCity">
                    </div>
                    <div class="col-md-4">
                        <label for="inputState" class="form-label">State</label>
                        <select id="inputState" class="form-select">
                        <option selected="">Choose...</option>
                        <option>...</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label for="inputZip" class="form-label">Zip</label>
                        <input type="text" class="form-control" id="inputZip">
                    </div>
                    <div class="col-12">
                        <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="gridCheck">
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
</section>
