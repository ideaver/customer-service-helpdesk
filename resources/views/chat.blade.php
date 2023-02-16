@extends('layout')

@section('header')
<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
@endsection
@section('content')
@php
$auth = Auth::user();
@endphp
<input type="hidden" name="created_by" value="{{$auth->user_id}}">
<div class="row chat-wrapper">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="row position-relative">
                    <div class="col-lg-4 chat-aside border-end-lg">
                        <div class="aside-content">
                            <div class="aside-header">
                                <div class="d-flex justify-content-between align-items-center pb-2 mb-2">
                                    <div class="d-flex align-items-center">
                                        <figure class="me-2 mb-0">
                                            <img src="{{$auth->image_profile}}" class="img-sm rounded-circle"
                                                alt="profile">
                                        </figure>
                                        <div>
                                            <h6><a href="{{ url('/admin/'.$auth->uuid) }}">{{$auth->fullname}}</a></h6>
                                            <p class="text-muted tx-13">{{$auth->role->title}}</p>
                                        </div>
                                    </div>

                                </div>
                                <form class="search-form">
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="searchForm"
                                            placeholder="Search Category, Name, Phone or Admin">
                                        <span class="input-group-text">
                                            <i data-feather="search" class="cursor-pointer"></i>
                                        </span>
                                    </div>
                                </form>
                            </div>
                            <div class="aside-body">
                                <ul class="nav nav-tabs nav-fill mt-3" role="tablist">


                                </ul>
                                <div class="tab-content mt-3">
                                    <div class="tab-pane fade show active" id="chats" role="tabpanel"
                                        aria-labelledby="chats-tab">
                                        <div>
                                            <ul class="list-unstyled chat-list px-1">
                                                @foreach ($threads as $thread)
                                                <li
                                                    class="chat-item pe-1 {{$target_thread_id == $thread->thread_id? 'bg-light' : ''}}">
                                                    <a href="{{url('chat/'.$thread->thread_id)}}"
                                                        class="d-flex align-items-center">
                                                        <figure class="mb-0 me-2">
                                                            <img src="{{$thread->user1->image_profile}}"
                                                                class="img-xs rounded-circle" alt="user">
                                                        </figure>
                                                        <div
                                                            class="d-flex justify-content-between flex-grow-1 border-bottom">
                                                            <div>
                                                                <p class="text-muted tx-13">
                                                                    <strong>#{{$thread->thread_no}}</strong></p>
                                                                <p class="text-body fw-bolder">
                                                                    {{$thread->user1->fullname}}
                                                                    ({{$thread->user1->role->title}}) -
                                                                    {{$thread->user1->phone}}</p>
                                                                <p class="text-muted tx-13">
                                                                    @if($thread->status == 1)
                                                                    <span class="badge bg-secondary">Progress</span>
                                                                    @elseif($thread->status == 2)
                                                                    <span class="badge bg-success">Done</span>
                                                                    @endif
                                                                    {{$thread->category->title}}
                                                                </p>
                                                                <!-- <p class="text-muted tx-13">Saya ingin tahu cara pesan. -->
                                                                </p>

                                                            </div>
                                                            <div class="d-flex flex-column align-items-end">
                                                                <p class="text-muted tx-13 mb-1"
                                                                    style="font-size:10px;line-height:12px;">
                                                                    {{$thread->updated_at->format('d/M/y')}}
                                                                    <br>{{$thread->updated_at->format('H:i')}} WIB</p>
                                                                <div class="badge rounded-pill bg-danger ms-auto">
                                                                    {{$thread->non_read_chat_count}}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </li>
                                                @endforeach
                                                <!-- <li class="chat-item pe-1" style="background:#f5f5f5;">
                                                    <a href="javascript:;" class="d-flex align-items-center">
                                                        <figure class="mb-0 me-2">
                                                            <img src="https://via.placeholder.com/37x37"
                                                                class="img-xs rounded-circle" alt="user">
                                                        </figure>
                                                        <div
                                                            class="d-flex justify-content-between flex-grow-1 border-bottom">
                                                            <div>
                                                                <p class="text-muted tx-13"><strong>#00002</strong> - <i
                                                                        data-feather="check"
                                                                        class="text-muted icon-md mb-2px"></i> Admin Ari
                                                                    Lesmana</p>
                                                                <p class="text-body fw-bolder">People B (Partner) -
                                                                    082246054709</p>
                                                                <p class="text-muted tx-13"><span
                                                                        class="badge bg-secondary">Progress</span> Cara
                                                                    Pesan</p>
                                                                <p class="text-muted tx-13">Saya ingin tahu cara pesan.
                                                                </p>
                                                            </div>
                                                            <div class="d-flex flex-column align-items-end">
                                                                <p class="text-muted mb-1"
                                                                    style="font-size:10px;line-height:12px;">01/02/23
                                                                    <br>4:32 WIB</p>
                                                                <div class="badge rounded-pill bg-danger ms-auto">5
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </li>
                                                <li class="chat-item pe-1">
                                                    <a href="javascript:;" class="d-flex align-items-center">
                                                        <figure class="mb-0 me-2">
                                                            <img src="https://via.placeholder.com/37x37"
                                                                class="img-xs rounded-circle" alt="user">
                                                        </figure>
                                                        <div
                                                            class="d-flex justify-content-between flex-grow-1 border-bottom">
                                                            <div>
                                                                <p class="text-muted tx-13"><strong>#00001</strong> - <i
                                                                        data-feather="check"
                                                                        class="text-muted icon-md mb-2px"></i> Admin
                                                                    Ridho</p>
                                                                <p class="text-body fw-bolder">People A (Partner) -
                                                                    082246054703</p>
                                                                <p class="text-muted tx-13"><span
                                                                        class="badge bg-success">Done</span> Cara Pesan
                                                                </p>
                                                                <p class="text-muted tx-13">Saya ingin tahu cara pesan.
                                                                </p>
                                                                <div class="d-flex align-items-center">
                                                                    <i data-feather="image"
                                                                        class="text-muted icon-md mb-2px"></i>
                                                                    <p class="text-muted ms-1">Photo</p>

                                                                </div>
                                                                <div class="stars">
                                                                    <label class="stars__item">
                                                                        <input type="radio" name="star-rating"
                                                                            value="1" />
                                                                    </label>
                                                                    <label class="stars__item">
                                                                        <input type="radio" name="star-rating"
                                                                            value="2" />
                                                                    </label>
                                                                    <label class="stars__item">
                                                                        <input type="radio" name="star-rating"
                                                                            value="3" />
                                                                    </label>
                                                                    <label class="stars__item">
                                                                        <input type="radio" name="star-rating"
                                                                            value="4" />
                                                                    </label>
                                                                    <label class="stars__item">
                                                                        <input type="radio" name="star-rating"
                                                                            value="5" />
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="d-flex flex-column align-items-end">
                                                                <p class="text-muted tx-13 mb-1"
                                                                    style="font-size:10px;line-height:12px;">01/02/23
                                                                    <br>4:32 WIB</p>

                                                            </div>
                                                        </div>
                                                    </a>
                                                </li> -->
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if($target_thread)
                    <input type="hidden" name="thread_id" value="{{$target_thread->thread_id}}">
                    <div class="col-lg-8 chat-content">
                        <div class="chat-header border-bottom pb-2">
                            <div class="d-flex justify-content-between">
                                <div class="d-flex align-items-center">
                                    <i data-feather="corner-up-left" id="backToChatList"
                                        class="icon-lg me-2 ms-n2 text-muted d-lg-none"></i>
                                    <figure class="mb-0 me-2">
                                        <img src="https://via.placeholder.com/43x43" class="img-sm rounded-circle"
                                            alt="image">
                                    </figure>
                                    <div>
                                        <p class="text-muted tx-13"><strong>#{{$target_thread->thread_no}}
                                            @if($target_thread->user2)
                                            </strong> - <i data-feather="check" class="text-muted icon-md mb-2px"></i>{{$target_thread->user2->fullname}}</p>
                                            @endif
                                        <p class="text-body fw-bolder"><a href="{{ url('/user/people-b') }}"
                                                style="text-decoration:underline">{{$target_thread->user1->fullname}}
                                                ({{$target_thread->user1->role->title}}) -
                                                {{$target_thread->user1->phone}}</a>
                                        </p>
                                        <p class="text-muted tx-13">@if($target_thread->status == 1)
                                            <span class="badge bg-secondary">Progress</span>
                                            @elseif($target_thread->status == 2)
                                            <span class="badge bg-success">Done</span>
                                            @endif
                                            {{$target_thread->category->title}} - {{$target_thread->updated_at->format('d/M/y')}} </p>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center">
                                    <a href="#" class="btn btn-success">Done</a>
                                </div>
                            </div>
                        </div>
                        <div class="chat-body">
                            <ul class="messages" id="chat-messages">
                                @foreach ($chats as $chat)
                                <li class="message-item {{$chat->created_by == $target_thread->user_id_1? 'friend' : 'me'}}">
                                    <img src="{{$chat->created_by_user->image_profile}}" class="img-xs rounded-circle"
                                        alt="avatar">
                                    <div class="content">
                                        <div class="message">
                                            <div class="bubble">
                                                <p>{{$chat->message}}</p>
                                            </div>
                                            <span>{{$chat->created_at->format('H:i')}}</span>
                                        </div>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="chat-footer d-flex">
                            <div class="d-none d-md-block">
                                <button type="button" class="btn border btn-icon rounded-circle me-2"
                                    data-bs-toggle="tooltip" data-bs-title="Attatch files">
                                    <i data-feather="paperclip" class="text-muted"></i>
                                </button>
                            </div>
                            <!-- <form class="search-form flex-grow-1 me-2"> -->
                                <div class="input-group">
                                    <input name="chat_form" type="text" class="form-control rounded-pill" id="chatForm"
                                        placeholder="Type a message">
                                </div>
                            <!-- </form> -->
                            <div>
                                <button onclick="submitChat()" type="button" class="btn btn-primary btn-icon rounded-circle">
                                    <i data-feather="send"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('footer')
<!-- Custom js for this page -->
<script src="{{ asset('template') }}/assets/js/chat.js"></script>
<!-- End custom js for this page -->

<script>
    $(window).load(function(){
        scrollChat();
    });
    function submitChat(){
        var chatForm = $('input[name=chat_form]').val();
        $.ajax({
            type: 'POST',
            url: base_url + 'api/chat/submit',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="token"]').attr('content')
            },
            data: {
                thread_id: $('input[name=thread_id]').val(),
                created_by: $('input[name=created_by]').val(),
                image_file: null,
                message:chatForm
            },
            success: function(result) {
                console.log(result);
                if(result.status_code == 200){
                    var html = `<li class="message-item me">
                                    <img src="${result.data.chat.created_by_user.image_profile}" class="img-xs rounded-circle"
                                        alt="avatar">
                                    <div class="content">
                                        <div class="message">
                                            <div class="bubble">
                                                <p>${result.data.chat.message}</p>
                                            </div>
                                            <span>${result.data.chat.updated_at_message}</span>
                                        </div>
                                    </div>
                                </li>`;
                    $('#chat-messages').append(html);

                    scrollChat();
                    $('input[name=chat_form]').val('');
                }
            }
        });
    }

    $('input[name=chat_form]').keypress(function (e) {
        if (e.which == 13) {
            submitChat();
            return false;
        }
    });

    function scrollChat(){
        var scrollObj = document.getElementById("chat-messages");
        scrollObj.scrollTop = scrollObj.scrollHeight;
    }
</script>
@endsection
