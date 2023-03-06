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

                <form class="forms-sample" method="POST" action="{{route('post.template-chat.update')}}">
                    {{csrf_field()}}
                    <input name="id" type="hidden" required="" value="{{$item->chat_template_id}}">
                    <div class="mb-3">
                        <label class="form-label">Title</label>
                        <input name="title" type="text" required="" class="form-control" value="{{$item->title}}">
                        <label class="form-label">Content</label>
                        <textarea name="content" required="" class="form-control" rows="5">{{$item->content}}</textarea>
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
