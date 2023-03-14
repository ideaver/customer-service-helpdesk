@extends('layout')

@section('header')

<!-- Plugin css for this page -->
<link rel="stylesheet" href="{{ asset('template') }}/assets/vendors/flatpickr/flatpickr.min.css">
<!-- End plugin css for this page -->

@endsection
@section('content')
<div class="page-content">

    <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
        <div>
            <h4 class="mb-3 mb-md-0">{{ $title }}</h4>
        </div>
        <div class="d-flex align-items-center flex-wrap text-nowrap">
            <div class="input-group flatpickr wd-200 me-2 mb-2 mb-md-0" id="dashboardDate">
                <span class="input-group-text input-group-addon bg-transparent border-primary" data-toggle><i
                        data-feather="calendar" class="text-primary"></i></span>
                <input type="text" onchange="changeFilter(this)" class="form-control bg-transparent border-primary" placeholder="Select date"
                    data-input="" value="{{$date_filter->format('d-M-Y')}}">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-xl-12 stretch-card">
            <div class="row flex-grow-1">
                <div class="col-md-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-baseline">
                                <h6 class="card-title mb-0">TODAYS CHATS</h6>
                            </div>
                            <div class="row">
                                <div class="col-6 col-md-12 col-xl-5">
                                    <h3 class="mb-2">{{$today_chats->count()}}</h3>
                                    <div class="d-flex align-items-baseline">
                                        @if($percentage_moving > 0)
                                        <p class="text-success">
                                            <span>{{$percentage_moving * 100}}% more than yesterday</span>
                                            <i data-feather="arrow-up" class="icon-sm mb-1"></i>
                                        </p>
                                        @elseif($percentage_moving == 0)
                                        @else
                                        <p class="text-danger">
                                            <span>{{$percentage_moving * 100}}% less than yesterday</span>
                                            <i data-feather="arrow-down" class="icon-sm mb-1"></i>
                                        </p>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-6 col-md-12 col-xl-7">
                                    <div id="todayChatChart" class="mt-md-3 mt-xl-0"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-baseline">
                                <h6 class="card-title mb-0">TOPICS from</h6>
                            </div>
                            <div class="row">
                                <div class="col-6 col-md-12 col-xl-5">
                                    <h3 class="mb-2">7 days ago</h3>
                                </div>
                                <div class="col-6 col-md-12 col-xl-7">
                                    <div id="ordersChart" class="mt-md-3 mt-xl-0"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- row -->

    <!-- <div class="row">
        <div class="col-12 col-xl-12 grid-margin stretch-card">
            <div class="card overflow-hidden">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-baseline mb-4 mb-md-3">
                        <h6 class="card-title mb-0">Revenue</h6>
                        <div class="dropdown">
                            <a type="button" id="dropdownMenuButton3" data-bs-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                                <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton3">
                                <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i
                                        data-feather="eye" class="icon-sm me-2"></i> <span class="">View</span></a>
                                <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i
                                        data-feather="edit-2" class="icon-sm me-2"></i> <span class="">Edit</span></a>
                                <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i
                                        data-feather="trash" class="icon-sm me-2"></i> <span class="">Delete</span></a>
                                <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i
                                        data-feather="printer" class="icon-sm me-2"></i> <span class="">Print</span></a>
                                <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i
                                        data-feather="download" class="icon-sm me-2"></i> <span
                                        class="">Download</span></a>
                            </div>
                        </div>
                    </div>
                    <div class="row align-items-start">
                        <div class="col-md-7">
                            <p class="text-muted tx-13 mb-3 mb-md-0">Revenue is the income that a business has from its
                                normal business activities, usually from the sale of goods and services to customers.
                            </p>
                        </div>
                        <div class="col-md-5 d-flex justify-content-md-end">
                            <div class="btn-group mb-3 mb-md-0" role="group" aria-label="Basic example">
                                <button type="button" class="btn btn-outline-primary">Today</button>
                                <button type="button" class="btn btn-outline-primary d-none d-md-block">Week</button>
                                <button type="button" class="btn btn-primary">Month</button>
                                <button type="button" class="btn btn-outline-primary">Year</button>
                            </div>
                        </div>
                    </div>
                    <div id="revenueChart"></div>
                </div>
            </div>
        </div>
    </div> -->

    <div class="row">
        <div class="col-lg-5 col-xl-4 grid-margin grid-margin-xl-0 stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-baseline mb-2">
                        <h6 class="card-title mb-0">NEW Message</h6>
                    </div>
                    <div class="d-flex flex-column">
                        @foreach($new_chats as $new_chat)
                        <a href="javascript:;" class="d-flex align-items-center border-bottom pb-3">
                            <div class="me-3">
                                <img src="{{$new_chat->created_by_user->image_profile}}" class="rounded-circle wd-35" alt="user">
                            </div>
                            <div class="w-100">
                                <div class="d-flex justify-content-between">
                                    <h6 class="text-body mb-2">{{$new_chat->created_by_user->fullname}}</h6>
                                    <p class="text-muted tx-12">{{$new_chat->created_at->format('d M Y H:i')}}</p>
                                </div>
                                <p class="text-muted tx-13">{{$new_chat->message}}</p>
                            </div>
                        </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-7 col-xl-8 stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-baseline mb-2">
                        <h6 class="card-title mb-0">CHAT STATUS</h6>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th class="pt-0">#</th>
                                    <th class="pt-0">From</th>
                                    <th class="pt-0">First Message</th>
                                    <th class="pt-0">Status</th>
                                    <th class="pt-0">Assign</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($threads as $thread)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$thread->user1->fullname ?? ''}}</td>
                                    <td>{{$thread->created_at->format('d M Y H:i')}}</td>
                                    @if($thread->status == 0)
                                    <td><span class="badge bg-danger">Open</span></td>
                                    @elseif($thread->status == 1)
                                    <td><span class="badge bg-warning">Progress</span></td>
                                    @elseif($thread->status == 2)
                                    <td><span class="badge bg-success">Close</span></td>
                                    @endif
                                    <td>{{$thread->user2? $thread->user2->fullname : ''}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- row -->

</div>
@endsection
@section('footer')

    <script>
        function changeFilter(element){
            // var item = $(el);
            var url = new URL(window.location.href);
            var search_params = url.searchParams;
            search_params.set('date', element.value);
            url.search = search_params.toString();

            var new_url = url.toString();

            window.location = new_url;

            window.location = new_url;
        }
    </script>
	<!-- Plugin js for this page -->
    <script src="{{ asset('template') }}/assets/vendors/flatpickr/flatpickr.min.js"></script>
    <script src="{{ asset('template') }}/assets/vendors/apexcharts/apexcharts.min.js"></script>
	<!-- End plugin js for this page -->

  	<!-- Custom js for this page -->
    <script src="{{ asset('template') }}/assets/js/dashboard-light.js"></script>
    <!-- End custom js for this page -->

    <script>
        $(function(){
            var colors = {
              primary        : "#6571ff",
              secondary      : "#7987a1",
              success        : "#05a34a",
              info           : "#66d1d1",
              warning        : "#fbbc06",
              danger         : "#ff3366",
              light          : "#e9ecef",
              dark           : "#060c17",
              muted          : "#7987a1",
              gridBorder     : "rgba(77, 138, 240, .15)",
              bodyColor      : "#000",
              cardBg         : "#fff"
          }
          if($('#todayChatChart').length) {
              var options1 = {
              chart: {
                  type: "line",
                  height: 60,
                  sparkline: {
                  enabled: !0
                  }
              },
              series: [{
                  name: '',
                  data: [3844, 3855, 3841, 3867, 3822, 3843, 3821, 3841, 3856, 3827, 3843]
              }],
              xaxis: {
                  type: 'datetime',
                  categories: ["Jan 01 2022", "Jan 02 2022", "Jan 03 2022", "Jan 04 2022", "Jan 05 2022", "Jan 06 2022", "Jan 07 2022", "Jan 08 2022", "Jan 09 2022", "Jan 10 2022", "Jan 11 2022",],
              },
              stroke: {
                  width: 2,
                  curve: "smooth"
              },
              markers: {
                  size: 0
              },
              colors: [colors.primary],
              };
              new ApexCharts(document.querySelector("#todayChatChart"),options1).render();
          }
        })
    </script>
@endsection
