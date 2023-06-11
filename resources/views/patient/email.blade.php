@extends('layouts.patientheader')
<section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">
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

                        <form class="row g-3" id="contactform"  method="POST" action="{{ route('intake.store') }}">
                        @csrf
                        <input type="hidden" name="mId" value="{{$mId}}"/>
                        <div class="col-12">
                            <label for="yourUsername" class="form-label">{{ __('Email Address') }}</label>
                            <div class="input-group has-validation">
                              <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
            
                              @error('email')
                                  <span class="invalid-feedback" role="alert">
                                    
                                      <strong>{{ $errors->first('email') }}</strong>
                                  </span>
                              @enderror
                            </div>
                          </div>
                            <div class="col-12">
                                <button class="btn btn-primary w-100" type="submit">Next</button>
                            </div>
                            <div class="col-12">
                                <p class="small mb-0">Already have an account? <a href="{{route('login')}}">Log in</a></p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



<!-- Scripts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
<script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.min.js')}}"></script>
{!! JsValidator::formRequest('App\Http\Requests\EmailStoreRequest','#contactform') !!}

