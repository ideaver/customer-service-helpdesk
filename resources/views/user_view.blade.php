@extends('layout')

@section('header')

<!-- Plugin css for this page -->
<link rel="stylesheet" href="{{ asset('template') }}/assets/vendors/flatpickr/flatpickr.min.css">
<!-- End plugin css for this page -->

@endsection
@section('content')
<div class="row">
    <div class="col-md-6 grid-margin stretch-card" style="margin:auto;">
        <div class="card">
            <div class="card-body">

                <h6 class="card-title">{{ $title }}</h6>

                <form class="forms-sample">
                    <div class="mb-3">
                        <label class="form-label">Fullname</label>
                        <input type="text" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Phone</label>
                        <input type="email" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Type</label>
                        <select class="form-select">
                            <option selected>--Select--</option>
                            <option>Customer</option>
                            <option>Partner</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select class="form-select">
                            <option selected>--Select--</option>
                            <option>Active</option>
                            <option>Not Active</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Created Date</label>
                        <input type="email" class="form-control" disabled>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Update Date</label>
                        <input type="email" class="form-control" disabled>
                    </div>
                    
                    <button type="submit" class="btn btn-primary me-2">Submit</button>
                </form>

            </div>
        </div>
        </div>
    </div>
</div>
@endsection
@section('footer')

	<!-- Plugin js for this page -->
  <script src="{{ asset('template') }}/assets/vendors/flatpickr/flatpickr.min.js"></script>
  <script src="{{ asset('template') }}/assets/vendors/apexcharts/apexcharts.min.js"></script>
	<!-- End plugin js for this page -->

  	<!-- Custom js for this page -->
    <script src="{{ asset('template') }}/assets/js/dashboard-light.js"></script>
    <!-- End custom js for this page -->
  
@endsection