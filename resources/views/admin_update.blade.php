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

                <form class="forms-sample" method="POST" action="{{route('post.admin.update')}}">
                    {{csrf_field()}}
                    <div class="mb-3">
                        <label class="form-label">Fullname</label>
                        <input name="fullname" type="text" required="" class="form-control" value="{{$item->fullname}}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input name="email" type="email" required="" class="form-control" value="{{$item->email}}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Role</label>
                        <select name="role_id" class="form-select" id="exampleFormControlSelect1" required="">
                            <option selected disabled>--Select--</option>
                            @foreach ($roles as $role)
                            <option value="{{$role->role_id}}" {{$item->role_id == $role->role_id? 'selected' : ''}}>{{$role->title}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input name="password" type="password" required="" class="form-control">
                    </div>
                    <div class="mb-3" required="">
                        <label class="form-label">Status</label>
                        <select name="is_active" class="form-select" id="exampleFormControlSelect1">
                            <option selected disabled>--Select--</option>
                            <option value="1" {{$item->is_active == 1? 'selected' : ''}}>Active</option>
                            <option value="2" {{$item->is_active == 2? 'selected' : ''}}>Not Active</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Created Date</label>
                        <input type="email" class="form-control" disabled value="{{$item->created_at}}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Update Date</label>
                        <input type="email" class="form-control" disabled value="{{$item->updated_at}}">
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
