@extends('layout')

@section('header')
@endsection
@section('content')
<div class="row">
    <div class="col-md-6 grid-margin stretch-card" style="margin:auto;">
        <div class="card">
            <div class="card-body">

                <h6 class="card-title">Topic Chat Create</h6>

                <form class="forms-sample" method="POST" action="{{route('post.topic-chat.create')}}">
                    {{csrf_field()}}
                    <div class="mb-3">
                        <label class="form-label">Title</label>
                        <input name="title" type="text" required="" class="form-control">
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
@endsection
