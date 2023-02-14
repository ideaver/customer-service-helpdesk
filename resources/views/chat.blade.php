@extends('layout')

@section('header')
<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
@endsection
@section('content')
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
                                <img src="https://via.placeholder.com/43x43" class="img-sm rounded-circle" alt="profile">
                                </figure>
                                <div>
                                <h6><a href="{{ url('/admin/ari-lesmana') }}">Ari Lesmana</a></h6>
                                <p class="text-muted tx-13">Admin</p>
                                </div>
                            </div>
                            
                            </div>
                            <form class="search-form">
                            <div class="input-group">
                                <input type="text" class="form-control" id="searchForm" placeholder="Search Category, Name, Phone or Admin">
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
                            <div class="tab-pane fade show active" id="chats" role="tabpanel" aria-labelledby="chats-tab">
                                <div>
                                <ul class="list-unstyled chat-list px-1">
                                    <li class="chat-item pe-1 bg-light">
                                    <a href="javascript:;" class="d-flex align-items-center">
                                        <figure class="mb-0 me-2">
                                        <img src="https://via.placeholder.com/37x37" class="img-xs rounded-circle" alt="user">
                                        </figure>
                                        <div class="d-flex justify-content-between flex-grow-1 border-bottom">
                                        <div>
                                            <p class="text-muted tx-13"><strong>#00003</strong></p>
                                            <p class="text-body fw-bolder">People C (Customer) - 082246054701</p>
                                            <p class="text-muted tx-13">Cara Pesan</p>
                                            <p class="text-muted tx-13">Saya ingin tahu cara pesan.</p>
                                            
                                        </div>
                                        <div class="d-flex flex-column align-items-end">
                                            <p class="text-muted tx-13 mb-1" style="font-size:10px;line-height:12px;">01/02/23 <br>4:32 WIB</p>
                                            <div class="badge rounded-pill bg-danger ms-auto">3</div>
                                        </div>
                                        </div>
                                    </a>
                                    </li>
                                    <li class="chat-item pe-1" style="background:#f5f5f5;">
                                    <a href="javascript:;" class="d-flex align-items-center">
                                        <figure class="mb-0 me-2">
                                        <img src="https://via.placeholder.com/37x37" class="img-xs rounded-circle" alt="user">
                                        </figure>
                                        <div class="d-flex justify-content-between flex-grow-1 border-bottom">
                                        <div>
                                            <p class="text-muted tx-13"><strong>#00002</strong> - <i data-feather="check" class="text-muted icon-md mb-2px"></i> Admin Ari Lesmana</p>
                                            <p class="text-body fw-bolder">People B (Partner) - 082246054709</p>
                                            <p class="text-muted tx-13"><span class="badge bg-secondary">Progress</span> Cara Pesan</p>
                                            <p class="text-muted tx-13">Saya ingin tahu cara pesan.</p>
                                        </div>
                                        <div class="d-flex flex-column align-items-end">
                                            <p class="text-muted mb-1" style="font-size:10px;line-height:12px;">01/02/23 <br>4:32 WIB</p>
                                            <div class="badge rounded-pill bg-danger ms-auto">5</div>
                                        </div>
                                        </div>
                                    </a>
                                    </li>
                                    <li class="chat-item pe-1">
                                    <a href="javascript:;" class="d-flex align-items-center">
                                        <figure class="mb-0 me-2">
                                        <img src="https://via.placeholder.com/37x37" class="img-xs rounded-circle" alt="user">
                                        </figure>
                                        <div class="d-flex justify-content-between flex-grow-1 border-bottom">
                                        <div>
                                            <p class="text-muted tx-13"><strong>#00001</strong> - <i data-feather="check" class="text-muted icon-md mb-2px"></i> Admin Ridho</p>
                                            <p class="text-body fw-bolder">People A (Partner) - 082246054703</p>
                                            <p class="text-muted tx-13"><span class="badge bg-success">Done</span> Cara Pesan</p>
                                            <p class="text-muted tx-13">Saya ingin tahu cara pesan.</p>
                                            <div class="d-flex align-items-center">
                                            <i data-feather="image" class="text-muted icon-md mb-2px"></i>
                                            <p class="text-muted ms-1">Photo</p>
                                            
                                            </div>
                                            <div class="stars">
                                                <label class="stars__item">
                                                  <input type="radio" name="star-rating" value="1" />
                                                </label>
                                                <label class="stars__item">
                                                  <input type="radio" name="star-rating" value="2" />
                                                </label>
                                                <label class="stars__item">
                                                  <input type="radio" name="star-rating" value="3" />
                                                </label>
                                                <label class="stars__item">
                                                  <input type="radio" name="star-rating" value="4" />
                                                </label>
                                                <label class="stars__item">
                                                  <input type="radio" name="star-rating" value="5" />
                                                </label>
                                              </div>
                                        </div>
                                        <div class="d-flex flex-column align-items-end">
                                            <p class="text-muted tx-13 mb-1" style="font-size:10px;line-height:12px;">01/02/23 <br>4:32 WIB</p>
                                            
                                        </div>
                                        </div>
                                    </a>
                                    </li>                                            
                                </ul>
                                </div>
                            </div>
                            </div>
                        </div>
                        </div>
                    </div>
                    <div class="col-lg-8 chat-content">
                        <div class="chat-header border-bottom pb-2">
                        <div class="d-flex justify-content-between">
                            <div class="d-flex align-items-center">
                                <i data-feather="corner-up-left" id="backToChatList" class="icon-lg me-2 ms-n2 text-muted d-lg-none"></i>
                                <figure class="mb-0 me-2">
                                    <img src="https://via.placeholder.com/43x43" class="img-sm rounded-circle" alt="image">
                                </figure>
                                <div>
                                    <p class="text-muted tx-13"><strong>#00002</strong> - <i data-feather="check" class="text-muted icon-md mb-2px"></i> Admin Ari Lesmana</p>  
                                    <p class="text-body fw-bolder"><a href="{{ url('/user/people-b') }}" style="text-decoration:underline">People B (Partner) - 082246054709 </a></p>
                                    <p class="text-muted tx-13"><span class="badge bg-secondary">Progress</span> Cara Pesan - 01/02/23 </p>
                                </div>
                            </div>
                            <div class="d-flex align-items-center">
                                <a href="#" class="btn btn-success">Done</a>
                            </div>
                        </div>
                        </div>
                        <div class="chat-body">
                        <ul class="messages">
                            <li class="message-item friend">
                            <img src="https://via.placeholder.com/36x36" class="img-xs rounded-circle" alt="avatar">
                            <div class="content">
                                <div class="message">
                                <div class="bubble">
                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                                </div>
                                <span>8:12 </span>
                                </div>
                            </div>
                            </li>
                            <li class="message-item me">
                            <img src="https://via.placeholder.com/36x36" class="img-xs rounded-circle" alt="avatar">
                            <div class="content">
                                <div class="message">
                                <div class="bubble">
                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry printing and typesetting industry.</p>
                                </div>
                                </div>
                                <div class="message">
                                <div class="bubble">
                                    <p>Lorem Ipsum.</p>
                                </div>
                                <span>8:13 </span>
                                </div>
                            </div>
                            </li>
                            <li class="message-item friend">
                            <img src="https://via.placeholder.com/36x36" class="img-xs rounded-circle" alt="avatar">
                            <div class="content">
                                <div class="message">
                                <div class="bubble">
                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                                </div>
                                <span>8:15 </span>
                                </div>
                            </div>
                            </li>
                            <li class="message-item me">
                            <img src="https://via.placeholder.com/36x36" class="img-xs rounded-circle" alt="avatar">
                            <div class="content">
                                <div class="message">
                                <div class="bubble">
                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry printing and typesetting industry.</p>
                                </div>
                                <span>8:15 </span>
                                </div>
                            </div>
                            </li>
                            <li class="message-item friend">
                            <img src="https://via.placeholder.com/36x36" class="img-xs rounded-circle" alt="avatar">
                            <div class="content">
                                <div class="message">
                                <div class="bubble">
                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                                </div>
                                <span>8:17 </span>
                                </div>
                            </div>
                            </li>
                            <li class="message-item me">
                            <img src="https://via.placeholder.com/36x36" class="img-xs rounded-circle" alt="avatar">
                            <div class="content">
                                <div class="message">
                                <div class="bubble">
                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry printing and typesetting industry.</p>
                                </div>
                                </div>
                                <div class="message">
                                <div class="bubble">
                                    <p>Lorem Ipsum.</p>
                                </div>
                                <span>8:18 </span>
                                </div>
                            </div>
                            </li>
                            <li class="message-item friend">
                            <img src="https://via.placeholder.com/36x36" class="img-xs rounded-circle" alt="avatar">
                            <div class="content">
                                <div class="message">
                                <div class="bubble">
                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                                </div>
                                <span>8:22 </span>
                                </div>
                            </div>
                            </li>
                            <li class="message-item me">
                            <img src="https://via.placeholder.com/36x36" class="img-xs rounded-circle" alt="avatar">
                            <div class="content">
                                <div class="message">
                                <div class="bubble">
                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry printing and typesetting industry.</p>
                                </div>
                                <span>8:30 </span>
                                </div>
                            </div>
                            </li>
                        </ul>
                        </div>
                        <div class="chat-footer d-flex">
                            <div class="d-none d-md-block">
                            <button type="button" class="btn border btn-icon rounded-circle me-2" data-bs-toggle="tooltip" data-bs-title="Attatch files">
                            <i data-feather="paperclip" class="text-muted"></i>
                            </button>
                        </div>
                        <form class="search-form flex-grow-1 me-2">
                            <div class="input-group">
                            <input type="text" class="form-control rounded-pill" id="chatForm" placeholder="Type a message">
                            </div>
                        </form>
                        <div>
                            <button type="button" class="btn btn-primary btn-icon rounded-circle">
                            <i data-feather="send"></i>
                            </button>
                        </div>
                    </div>
                </div>
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
@endsection