@extends('layout')

@section('header')
@endsection
@section('content')
<div class="row">
    <div class="col-md-6 grid-margin stretch-card" style="margin:auto;">
        <div class="card">
            <div class="card-body">

                <h6 class="card-title">Admin Create</h6>

                <form class="forms-sample" method="POST" action="{{route('post.admin.create')}}">
                    {{csrf_field()}}
                    <div class="mb-3">
                        <label class="form-label">Fullname</label>
                        <input name="fullname" type="text" required="" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input name="email" type="email" required="" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Role</label>
                        <select name="role_id" class="form-select" id="exampleFormControlSelect1" required="">
                            <option selected disabled>--Select--</option>
                            @foreach ($roles as $role)
                            <option value="{{$role->role_id}}">{{$role->title}}</option>
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
                            <option value="1">Active</option>
                            <option value="2">Not Active</option>
                        </select>
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
