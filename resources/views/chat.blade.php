@extends('layout')

@section('header')
<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
<style>
		.popup {
			position: fixed;
			top: 0;
			left: 0;
			width: 100%;
			height: 100%;
			background-color: rgba(0, 0, 0, 0.8);
			display: none;
			justify-content: center;
			align-items: center;
			z-index: 9999;
		}

		.popup img {
			max-width: 90%;
			max-height: 90%;
		}

		.close {
			position: absolute;
			top: 20px;
			right: 20px;
			font-size: 30px;
			color: #fff;
			cursor: pointer;
		}

</style>
@endsection
@section('content')
@php
$auth = Auth::user();
@endphp
<input type="hidden" name="created_by" value="{{$auth->uuid}}">
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
                                <div class="input-group">
                                    <input type="text" class="form-control" id="searchForm"
                                        placeholder="Search Topic, Name, Phone or Admin" onkeydown="searchChat(this)">
                                    <span class="input-group-text">
                                        <i data-feather="search" class="cursor-pointer"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="aside-body">
                                <ul class="nav nav-fill mt-3" role="tablist">
                                    <li class="nav-item " style="border: 1px solid #eee;">
                                        <a class="nav-link" href="http://127.0.0.1:8000/chat">
                                            <span class="menu-title">Main</span>
                                        </a>
                                    </li>
                                    <li class="nav-item " style="border: 1px solid #eee;">
                                        <a class="nav-link" href="http://127.0.0.1:8000/dashboard">
                                            <span class="menu-title">Archived</span>
                                        </a>
                                    </li>
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
                                                            <img src="{{$thread->user1->image_profile ?? ''}}"
                                                                class="img-xs rounded-circle" alt="user">
                                                        </figure>
                                                        <div
                                                            class="d-flex justify-content-between flex-grow-1 border-bottom">
                                                            <div>
                                                                <p class="text-muted tx-13">
                                                                    <strong>#{{$thread->thread_no}}</strong></p>
                                                                <p class="text-body fw-bolder">
                                                                    {{$thread->user1->fullname ?? ''}}
                                                                    ({{$thread->user1? $thread->user1->role->title : ''}}) -
                                                                    {{$thread->user1->phone ?? ''}}</p>
                                                                <p class="text-muted tx-13">
                                                                    @if($thread->status == 1)
                                                                    <span class="badge bg-secondary">Progress</span>
                                                                    @elseif($thread->status == 2)
                                                                    <span class="badge bg-success">Done</span>
                                                                    @endif
                                                                    {{$thread->topic->title ?? ''}}
                                                                </p>
                                                                @if($thread->non_read_chat->count() > 0)
                                                                @if(!empty($thread->non_read_chat->first()->image_url))
                                                                <div class="d-flex align-items-center">
                                                                    <i data-feather="image" class="text-muted icon-md mb-2px"></i> <p class="text-muted ms-1">Photo</p>
                                                                </div>
                                                                @endif
                                                                <p class="text-muted tx-13">{{$thread->non_read_chat->first()->message}}</p>
                     `                                           @endif

                                                                @if(!empty($thread->rating))
                                                                <div class="stars">
                                                                    @for($i=1; $i<=5; $i++)
                                                                    <label class="stars__item">
                                                                        <input type="radio" name="star-rating-{{$thread->thread_id}}"
                                                                            {{$i<=$thread->rating? 'checked' : ''}}
                                                                            value="{{$i}}" />
                                                                    </label>
                                                                    @endfor
                                                                </div>
                                                                @endif
                                                            </div>
                                                            <div class="d-flex flex-column align-items-end">
                                                                <p class="text-muted tx-13 mb-1"
                                                                    style="font-size:10px;line-height:12px;">
                                                                    {{$thread->updated_at->format('d/M/y')}}
                                                                    <br>{{$thread->updated_at->format('H:i')}} WIB</p>
                                                                @if($thread->non_read_chat->count() > 0)
                                                                <div class="badge rounded-pill bg-danger ms-auto">
                                                                    {{$thread->non_read_chat->count()}}
                                                                </div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </a>
                                                </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if($target_thread)
                    <div class="col-lg-8 chat-content">
                        <form action="{{url('chat/upload/'.$target_thread->thread_id)}}" method="POST" style="min-height: 450px;" id="chat-dropzone">
                            {{csrf_field()}}
                            <input type="hidden" name="thread_id" value="{{$target_thread->thread_id}}">
                            <div class="chat-header border-bottom pb-2">
                                <div class="d-flex justify-content-between">
                                    <div class="d-flex align-items-center">
                                        <i data-feather="corner-up-left" id="backToChatList"
                                            class="icon-lg me-2 ms-n2 text-muted d-lg-none"></i>
                                        <figure class="mb-0 me-2">
                                            <img src="{{$target_thread->user1->image_profile ?? ''}}" class="img-sm rounded-circle"
                                                alt="image">
                                        </figure>
                                        <div>
                                            <p class="text-muted tx-13"><strong>#{{$target_thread->thread_no}}
                                                @if($target_thread->user2)
                                                </strong> - <i data-feather="check" class="text-muted icon-md mb-2px"></i>{{$target_thread->user2->fullname}}</p>
                                                @endif
                                            <p class="text-body fw-bolder"><a href="{{ url('/user/people-b') }}"
                                                    style="text-decoration:underline">{{$target_thread->user1->fullname ?? ''}}
                                                    ({{$target_thread->user1? $target_thread->user1->role->title : ''}}) -
                                                    {{$target_thread->user1->phone ?? ''}}</a>
                                            </p>
                                            <p class="text-muted tx-13">@if($target_thread->status == 1)
                                                <span class="badge bg-secondary">Progress</span>
                                                @elseif($target_thread->status == 2)
                                                <span class="badge bg-success">Done</span>
                                                @endif
                                                {{$target_thread->topic->title ?? ''}} - {{$target_thread->updated_at->format('d/M/y')}} </p>
                                        </div>
                                    </div>
                                    @if($target_thread)
                                        @if($target_thread && $target_thread->status != 2)
                                        <div class="d-flex align-items-center">
                                            <a onclick="doneChat()" class="btn btn-success">Done</a>
                                        </div>
                                        @endif
                                    @else
                                    <div class="d-flex align-items-center">
                                        <a onclick="doneChat()" class="btn btn-success">Done</a>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="chat-body" id="chat-container">
                                <ul class="messages" id="chat-messages">
                                    @foreach ($chats as $chat)
                                    <li class="message-item {{$chat->created_by == $target_thread->user_id_1? 'friend' : 'me'}}">
                                        <img src="{{$chat->created_by_user->image_profile}}" class="img-xs rounded-circle"
                                            alt="avatar">
                                        <div class="content">
                                            <div class="message">
                                                <div class="bubble">
                                                    @if(!empty($chat->image_url))
                                                    <img src="{{url($chat->image_url)}}" onclick="openPopup(this.src)" style="width: 180px;">
                                                    @endif
                                                    <p>{{$chat->message}}</p>
                                                </div>
                                                <span>{{$chat->created_at->format('H:i')}}</span>
                                            </div>
                                        </div>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                            @if($target_thread->status != 2)
                            <div class="chat-footer d-flex">
                                <div class="d-none d-md-block">
                                    <button id="upload-label" type="button" class="dz-clickable btn border btn-icon rounded-circle me-2"
                                        data-bs-toggle="tooltip" data-bs-title="Attatch files">
                                        <i data-feather="paperclip" class="text-muted"></i>
                                    </button>
                                </div>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-secondary" onclick="openTemplate()">Template</button>
                                    <button type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split" onclick="openTemplate()" data-toggle="dropdown" aria-expanded="false" data-reference="parent">
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <div id="dropdown-template" class="dropdown-menu">
                                        @foreach($chat_templates as $chat_template)
                                        <a class="dropdown-item" onclick="usingTemplate(this)" data-content="{{$chat_template->content}}">{{$chat_template->title}}</a>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="input-group">
                                    <input name="chat_form" type="text" class="form-control rounded-pill" id="chatForm"
                                        placeholder="Type a message">
                                </div>
                                <div>
                                    <button onclick="submitChat()" type="button" class="btn btn-primary btn-icon rounded-circle">
                                        <i data-feather="send"></i>
                                    </button>
                                </div>
                            </div>
                            @endif
                        </form>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<div class="popup" id="popup">
		<span class="close" onclick="closePopup()">&times;</span>
		<img id="popup-img" src="">
	</div>
@endsection
@section('footer')
<!-- Custom js for this page -->
<script src="{{ asset('template') }}/assets/js/chat.js"></script>
<!-- End custom js for this page -->
<script>

</script>
<script>
    function openPopup(src) {
        var popup = document.getElementById("popup");
        var img = document.getElementById("popup-img");
        img.src = src;
        popup.style.display = "flex";
    }

    function closePopup() {
        var popup = document.getElementById("popup");
        popup.style.display = "none";
    }

    function openTemplate(){
        $('#dropdown-template').addClass('show');
    }

    function usingTemplate(el){
        var item = $(el);
        $('#dropdown-template').removeClass('show');

        $('input[name=chat_form]').val(item.attr('data-content'));
        submitChat();
    }

    $(document).ready(function(){
        readChat();
        scrollChat();
        let myDropzone = new Dropzone("#chat-dropzone");
    });
    // Dropzone.autoDiscover = false;
    Dropzone.options.chatDropzone = { // camelized version of the `id`
        // paramName: "image_file", // The name that will be used to transfer the file
        maxFilesize: 5, // MB
        maxFiles:1,
        // previewTemplate: previewTemplate,
        // previewsContainer: "#previews",
        createImageThumbnails: false,
        disablePreviews: true,
        clickable: '.dz-clickable',
        accept: function (file, done) {
            // console.log(file)
            // console.log(done)

            const form = document.getElementById("chat-dropzone");
            var formData = new FormData();
            formData.append('thread_id', $('input[name=thread_id]').val());
            formData.append('created_by', $('input[name=created_by]').val());
            formData.append('image_file', file);
            formData.append('message','');
            $.ajax({
                url: form.action,
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="token"]').attr('content')
                },
                enctype: 'multipart/form-data',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function(result) {
                    console.log(result);
                    if(result.status_code == 200){
                        var html = `<li class="message-item me">
                                        <img src="${result.data.chat.created_by_user.image_profile}" class="img-xs rounded-circle"
                                            alt="avatar">
                                        <div class="content">
                                            <div class="message">
                                                <div class="bubble">
                                                    <img src="${result.data.chat.image_url}" onclick="openPopup(this.src)" style="width: 180px;">
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
    };

    function readChat(){
        $.ajax({
            type: 'POST',
            url: base_url + 'api/chat/read',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="token"]').attr('content')
            },
            data: {
                thread_id: $('input[name=thread_id]').val(),
                created_by: $('input[name=created_by]').val(),
            },
            success: function(result) {
                console.log(result);
            }
        });
    }

    function doneChat(){
        $.ajax({
            type: 'POST',
            url: base_url + 'api/chat/done',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="token"]').attr('content')
            },
            data: {
                thread_id: $('input[name=thread_id]').val(),
                created_by: $('input[name=created_by]').val(),
            },
            success: function(result) {
                console.log(result);
                location.reload();
            }
        });
    }

    function submitChat(){
        var chatForm = $('input[name=chat_form]').val();

        if(chatForm == "")
            return false;
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
        var chatDiv = $('#chat-container');
        var height = chatDiv[0].scrollHeight;
        chatDiv.scrollTop(height);
    }

    function searchChat(element) {
        if(event.key === 'Enter') {
            var url = new URL(window.location.href);
            var search_params = url.searchParams;
            search_params.set('q', element.value);
            url.search = search_params.toString();

            var new_url = url.toString();

            window.location = new_url;
        }
    }
</script>
@endsection
