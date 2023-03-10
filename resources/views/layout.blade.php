<!DOCTYPE html>
<!--
Template Name: NobleUI - HTML Bootstrap 5 Admin Dashboard Template
Author: NobleUI
Website: https://www.nobleui.com
Portfolio: https://themeforest.net/user/nobleui/portfolio
Contact: nobleui123@gmail.com
Purchase: https://1.envato.market/nobleui_admin
License: For each use you must have a valid license purchased only from above link in order to legally use the theme for your project.
-->
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="token" content="{{csrf_token()}}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="Responsive HTML Admin Dashboard Template based on Bootstrap 5">
    <meta name="author" content="NobleUI">
    <meta name="keywords"
        content="nobleui, bootstrap, bootstrap 5, bootstrap5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

    <title>{{ $title }} | MaiMaid Care</title>
    @yield('header')
    <base href="{{ url('/') }}">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
    <!-- End fonts -->

    <!-- core:css -->
    <link rel="stylesheet" href="{{ asset('template') }}/assets/vendors/core/core.css">
    <!-- endinject -->

    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->

    <!-- inject:css -->
    <link rel="stylesheet" href="{{ asset('template') }}/assets/fonts/feather-font/css/iconfont.css">
    <link rel="stylesheet" href="{{ asset('template') }}/assets/vendors/flag-icon-css/css/flag-icon.min.css">
    <!-- endinject -->

    <!-- Layout styles -->
    <link rel="stylesheet" href="{{ asset('template') }}/assets/css/demo3/style.css">
    <!-- End layout styles -->

    <link rel="shortcut icon" href="{{ asset('template') }}/assets/images/favicon.png" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/css/iziToast.min.css"
        integrity="sha512-O03ntXoVqaGUTAeAmvQ2YSzkCvclZEcPQu1eqloPaHfJ5RuNGiS4l+3duaidD801P50J28EHyonCV06CUlTSag=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.2/css/dataTables.bootstrap5.min.css" />

    <style>
        .chat-item {
            border-radius: 10px;
            padding-left: 10px;
            padding-right: 10px !important;
        }

        td,
        th {
            vertical-align: middle;
        }

        .stars .stars__item {
            position: relative;
            cursor: pointer;
        }

        /* Set all stars to empty */
        .stars .stars__item::after {
            content: "\f006";
            font-family: FontAwesome;
        }

        /* Hide radio button */
        .stars .stars__item input {
            position: absolute;
            opacity: 0;
            pointer-events: none;
        }

        /* If any of the inputs are checked fill in all the stars */
        .stars:has(.stars__item > input:checked) .stars__item:after {
            content: "\f005";
        }

        /* change all the stars after the checked star to empty stars */
        .stars .stars__item:has(input:checked)~.stars__item:after {
            content: "\f006";
        }
    </style>
    <!-- <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" /> -->
    <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
    <script>
        var base_url = document.getElementsByTagName('base')[0].getAttribute('href') + '/';
    </script>
    @yield('header')
</head>

<body>
    <div class="main-wrapper">

        <!-- partial:../../partials/_navbar.html -->
        <div class="horizontal-menu">
            <nav class="navbar top-navbar">
                <div class="container">
                    <div class="navbar-content">
                        <a href="{{ url('/chat') }}" class="navbar-brand">
                            MaiMaid<span>Care</span>
                        </a>
                        <ul class="navbar-nav">

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <img class="wd-30 ht-30 rounded-circle" src="{{Auth::user()->image_profile}}"
                                        alt="profile">
                                </a>
                                <div class="dropdown-menu p-0" aria-labelledby="profileDropdown">
                                    <div class="d-flex flex-column align-items-center border-bottom px-5 py-3">
                                        <div class="mb-3">
                                            <img class="wd-80 ht-80 rounded-circle"
                                                src="{{Auth::user()->image_profile}}" alt="">
                                        </div>
                                        <div class="text-center">
                                            <p class="tx-16 fw-bolder"><a
                                                    href="{{ url('/admin/'.Auth::user()->uuid) }}">{{Auth::user()->fullname}}</a>
                                            </p>
                                            <p class="tx-12 text-muted">{{Auth::user()->email}}</p>
                                        </div>
                                    </div>
                                    <ul class="list-unstyled p-1">
                                        <li class="dropdown-item py-2">
                                            <a href="{{url('topic-chat')}}" class="text-body ms-0">
                                                <span>Topic Chat</span>
                                            </a>
                                        </li>
                                    </ul>
                                    <ul class="list-unstyled p-1">
                                        <li class="dropdown-item py-2">
                                            <a href="{{url('template-chat')}}" class="text-body ms-0">
                                                <span>Template Chat</span>
                                            </a>
                                        </li>
                                    </ul>
                                    <ul class="list-unstyled p-1">
                                        <li class="dropdown-item py-2">
                                            <a href="{{route('signout')}}" class="text-body ms-0">
                                                <i class="me-2 icon-md" data-feather="log-out"></i>
                                                <span>Log Out</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                            data-toggle="horizontal-menu-toggle">
                            <i data-feather="menu"></i>
                        </button>
                    </div>
                </div>
            </nav>
            <nav class="bottom-navbar">
                <div class="container">
                    <ul class="nav page-navigation">
                        <li class="nav-item @if($module==" Chat") active @endif">
                            <a class="nav-link" href="{{ url('/chat') }}">
                                <i class="link-icon" data-feather="message-square"></i>
                                <span class="menu-title">Chat</span>
                            </a>
                        </li>
                        <li class="nav-item @if($module==" Dashboard") active @endif">
                            <a class="nav-link" href="{{ url('/dashboard') }}">
                                <i class="link-icon" data-feather="box"></i>
                                <span class="menu-title">Dashboard</span>
                            </a>
                        </li>
                        <li class="nav-item @if($module==" Admin") active @endif">
                            <a class="nav-link" href="{{ url('/admin') }}">
                                <i class="link-icon" data-feather="users"></i>
                                <span class="menu-title">Admin</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
        <!-- partial -->

        <div class="page-wrapper">
            <div class="page-content">

                @yield('content')

            </div>
        </div>

    </div>
    <!-- core:js -->
    <script src="{{ asset('template') }}/assets/vendors/core/core.js"></script>
    <!-- endinject -->

    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->

    <!-- inject:js -->
    <script src="{{ asset('template') }}/assets/vendors/feather-icons/feather.min.js"></script>
    <script src="{{ asset('template') }}/assets/js/template.js"></script>
    <!-- endinject -->

    <script type="text/javascript" src="https://code.jquery.com/jquery-2.2.0.min.js"
        integrity="sha256-ihAoc6M/JPfrIiIeayPE9xjin4UWjsx2mjW/rtmxLM4=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.13.2/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/js/iziToast.min.js"
        integrity="sha512-Zq9o+E00xhhR/7vJ49mxFNJ0KQw1E1TMWkPTxrWcnpfEFDEXgUiwJHIKit93EW/XxE31HSI5GEOW06G6BF1AtA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="token"]').attr('content')
                }
            });
        })
    </script>
    <script src="https://www.gstatic.com/firebasejs/8.3.2/firebase.js"></script>
    <script type="module">
        const firebaseConfig = {
            apiKey: "AIzaSyB7lHtn6L3qVEBngFI_L5RpBgdkf4LsvwQ",
            authDomain: "maimaid-app.firebaseapp.com",
            projectId: "maimaid-app",
            storageBucket: "maimaid-app.appspot.com",
            messagingSenderId: "839314473238",
            appId: "1:839314473238:web:e0747f2f5af518b4dc5037"
        };

        firebase.initializeApp(firebaseConfig);
        const messaging = firebase.messaging();

        function sendTokenToServer(fcm_token) {
            $.ajax({
                type: 'POST',
                url: base_url + 'user/save-token',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="token"]').attr('content')
                },
                data: {
                    fcm_token: fcm_token,
                },
                success: function(result) {
                    console.log(result);
                }
            });
        }

        async function retreiveToken(){
            // Add the public key generated from the console here.
            // const currentToken = await getToken(messaging, {vapidKey: "BOSvkqf2fdIUf1x70tLbbFtqtjxJdf7ipZEJehw3IkAG17iW26S1vvDvwQCiBnfMp-O5R4AA68wSWIQA9ARs5p0"})

            // messaging.getToken().then((currentToken) => {
                // console.log(currentToken);
                // if (currentToken) {
                //     sendTokenToServer(currentToken);
                // } else {
                //     alert('You should allow notification!');
                // }
            // }).catch((err) => {
            //     console.log(err.message);
            // });

            messaging
                .requestPermission()
                .then(function () {
                    return messaging.getToken()
                })
                .then(function (response) {
                    console.log(response);
                    sendTokenToServer(response);
                }).catch(function (error) {
                    alert(error);
                });
        }
        retreiveToken();
        // messaging.onTokenRefresh(()=>{
        //     retreiveToken();
        // });

        messaging.onMessage(function (payload) {
            const title = payload.notification.title;
            const options = {
                body: payload.notification.body,
                icon: payload.notification.icon,
            };
            new Notification(title, options);
        });
    </script>
    @if (Session::has('message-error'))
    <script>
        $(window).load(function () {
            iziToast.warning({
                title: 'Oops',
                message: `{{ Session::get('message-error') }}`,
                position: 'topRight'
            });
        });
    </script>
    @endif
    @if (Session::has('message-success'))
    <script>
        $(window).load(function () {
            iziToast.success({
                title: 'Good job',
                message: `{{ Session::get('message-success') }}`,
                position: 'topRight'
            });
        });
    </script>
    @endif

    @yield('footer')
</body>

</html>
