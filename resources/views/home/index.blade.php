@include('home.header');
@include('home.slidebar');
<main id="main" class="main">
  <h2 class="secondary-title mt-3">Prescription</h2>
  <section class="section dashboard">
    <div class="row">
      <!-- Left side columns -->
      <div class="col-lg-7">
        <div class="row">
          <div class="col-12">
            <div class="card mb-3">
              <div class="row g-0">
                <div class="col-12">
                  <div class="card ">
                  </div>
                  <div class="card-body">
                      <h5 class="card-title">Your Prescriptions</h5>
                      <table class="table table-borderless datatable">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Medicine</th>
                            <th scope="col">Subscription</th>
                            <th scope="col">Price</th>
                            <th scope="col">Status</th>
                            <th scope="col">View</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($patientCases as $caseKey=> $cases)
                          <tr>
                            <th scope="row">{{$caseKey+1}}</th>
                            <td>{{$cases->med_name}}</td>
                            <td>{{$cases->subscription}}</td>
                            <td>${{$cases->price}}</td>
                            <td><span class="badge bg-success">{{$cases->name}}</span></td>
                            <td><a href="{{ route('patient_prescription',['pId'=>$cases->userId,'cId'=>$cases->dbcaseId]) }}" class="btn  btn-warning ">View</a></td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div
              </div>
            </div>
        </div>
      </div>
      <div class="col-lg-7">
        <div class="row">
          <div class="col-12">
                <div class="card ">
                  <div class="filter">
                  </div>
                </div>
              </div>
          </div>
        </div>
      </div>
      <!-- Right side columns -->
      <div class="col-lg-5">

        <!-- Recent Activity -->
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Most Recent Order Status</h5>
            <div>Medicine Details</div>
            <div class="activity">
              <div class="activity-item d-flex">
                <div class="activite-label">1</div>
                <i class='bi bi-circle-fill activity-badge text-success align-self-start'></i>
                <div class="activity-content">Intake Form {{$recentOrderCreatedAt}}</div>
              </div><!-- End activity item-->

              <div class="activity-item d-flex">
                <div class="activite-label">2</div>
                <i class='bi bi-circle-fill activity-badge text-success align-self-start'></i>
                <div class="activity-content">Treatment Request {{$recentOrderCreatedAt}}</div>
              </div>

              <div class="activity-item d-flex">
                  <div class="activite-label">3</div>
                <i class='bi bi-circle-fill activity-badge text-success align-self-start'></i>
                <div class="activity-content">Processing {{$caseStatus}}</div>
              </div><!-- End activity item-->

              <div class="activity-item d-flex">
                <div class="activite-label">4</div>
                <i class='bi bi-circle-fill activity-badge text-info align-self-start'></i>
                <div class="activity-content">Prescription {{$prescriptionStatus}}</div>
              </div><!-- End activity item-->

              <div class="activity-item d-flex">
                <div class="activite-label">5</div>
                <i class='bi bi-circle-fill activity-badge text-warning align-self-start'></i>
                <div class="activity-content">Order Placed {{$orderStatus}}</div>
              </div><!-- End activity item-->

              <div class="activity-item d-flex">
                <div class="activite-label">6</div>
                <i class='bi bi-circle-fill activity-badge text-muted align-self-start'></i>
                <div class="activity-content">Order Processing </div>
              </div><!-- End activity item-->
            </div>
          </div>
        </div><!-- End Recent Activity -->
      </div><!-- End Right side columns -->
    </div>
  </section>
</main><!-- End #main -->


<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<!-- Vendor JS Files -->
<script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/vendor/chart.js/chart.umd.js"></script>
<script src="assets/vendor/echarts/echarts.min.js"></script>
<script src="assets/vendor/quill/quill.min.js"></script>
<script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
<script src="assets/vendor/tinymce/tinymce.min.js"></script>
<script src="assets/vendor/php-email-form/validate.js"></script>

<!-- Template Main JS File -->
<script src="assets/js/main.js"></script>
</body>


