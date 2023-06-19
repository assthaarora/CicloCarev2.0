<html><head>
<style>
  .image-container {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 200px; /* Set the desired height for the container */
  }
  .image-container img {
    max-height: 100%;
    max-width: 100%;
    object-fit: contain;
  }
</style>
</head><body>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

@include('home.header');
@include('home.slidebar');
<main id="main" class="main">
<h2 class="secondary-title mt-3">Prescription</h2>
<section class="section dashboard">
      <div class="row align-items-top">
        <div class="col-lg-7"> 
          <!-- Default Card -->
          <div class="card">
            <div class="image-container"><img src="{{ asset('assets/img/1.png') }}" class="card-img-top" alt="..." ></div>
            <div class="card-body">
              <h3 class="card-title">{{$medicineDetails->med_name}}</h3>
              <p class="card-text">{{$medicineDetails->med_Desc}}</p>
              <!-- <p class="card-text">${{$medicineDetails->price}}</p> -->
              <h4 class="card-title">Prescription Summary</h4>
              <p class="card-text"><b>Refill Remaining:</b> @if(isset($prescriptionDetails)){{$prescriptionDetails->refills}} @else 0 @endif</p>
              <p class="card-text">Download Prescription  <a href="/path/to/file.pdf" download> <i class="fas fa-download"></i> Prescription</a></p>
              <p></p>
            </div>
          </div><!-- End Default Card -->
        </div>

        <div class="col-lg-5">
          <!-- Card with an image on top -->
          <div class="card">
          <div class="image-container" style="height: 100px"><img src="{{ asset('assets/img/delivery-truck.png') }}" class="card-img-top" alt="..."></div>
            <div class="card-body">
              <h5 class="card-title">Order Details</h5>
              <p class="card-text">Shipped to, Shipped At, Payment Details</p>
              
                <!-- <p class="card-text" style="text-align: center;">
                    <a href="#" class="btn btn-primary">Button</a>
                </p> -->
            </div>
          </div><!-- End Card with an image on top -->
        </div>

      </div>
    </section>
</main>
<script src="{{ asset('assets/vendor/apexcharts/apexcharts.min.js') }}"></script>
<script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/vendor/chart.js/chart.umd.js') }}"></script>
<script src="{{ asset('assets/vendor/echarts/echarts.min.js') }}"></script>
<script src="{{ asset('assets/vendor/quill/quill.min.js') }}"></script>
<script src="{{ asset('assets/vendor/simple-datatables/simple-datatables.js') }}"></script>
<script src="{{ asset('assets/vendor/tinymce/tinymce.min.js') }}"></script>
<script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>
<!-- Template Main JS File -->
<script src="{{ asset('js/main.js')}}"></script>
</body>
</html>