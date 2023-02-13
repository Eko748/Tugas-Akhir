<div class="container">
    <div class="row">
        <div class="col call-chat-sidebar">
            <div class="card">
              <div class="card-body chat-body">
                <div class="chat-box">
                  <!-- Chat left side Start-->
                  <div class="chat-left-aside">
                    <div class="media"><img class="rounded-circle user-image" src="../assets/images/user/12.png" alt="">
                      <div class="media-body">
                        <div class="about">
                          <div class="name f-w-600">Mark Jecno</div>
                          <div class="status">Status...</div>
                        </div>
                      </div>
                    </div>
                    <div class="people-list" id="people-list">
                      <div class="search">
                        <form class="theme-form">
                          <div class="form-group">
                            <input class="form-control" type="text" placeholder="search"><i class="fa fa-search"></i>
                          </div>
                        </form>
                      </div>
                      <ul class="list custom-scrollbar">
                        <li class="clearfix">
                          <div class="media"><img class="rounded-circle user-image" src="../assets/images/user/1.jpg" alt="">
                            <div class="status-circle away"></div>
                            <div class="media-body">
                              <div class="about">
                                <div class="name">Vincent Porter</div>
                                <div class="status">Hello Name</div>
                              </div>
                            </div>
                          </div>
                        </li>
                        <li class="clearfix">
                          <div class="media"><img class="rounded-circle user-image" src="../assets/images/user/2.png" alt="">
                            <div class="status-circle online"></div>
                            <div class="media-body">
                              <div class="about">
                                <div class="name">Aiden Chavez</div>
                                <div class="status">Out is my favorite.</div>
                              </div>
                            </div>
                          </div>
                        </li>
                        <li class="clearfix">
                          <div class="media"><img class="rounded-circle user-image" src="../assets/images/user/8.jpg" alt="">
                            <div class="status-circle online"></div>
                            <div class="media-body">
                              <div class="about">
                                <div class="name">Prasanth Anand</div>
                                <div class="status">Change for anyone.</div>
                              </div>
                            </div>
                          </div>
                        </li>
                        <li class="clearfix">
                          <div class="media"><img class="rounded-circle user-image" src="../assets/images/user/4.jpg" alt="">
                            <div class="status-circle offline"></div>
                            <div class="media-body">
                              <div class="about">
                                <div class="name">Venkata Satyamu</div>
                                <div class="status">First bun like a sun.</div>
                              </div>
                            </div>
                          </div>
                        </li>
                        <li class="clearfix">
                          <div class="media"><img class="rounded-circle user-image" src="../assets/images/user/5.jpg" alt="">
                            <div class="status-circle online"></div>
                            <div class="media-body">
                              <div class="about">
                                <div class="name">Ginger Johnston</div>
                                <div class="status">it's my life. Mind it.</div>
                              </div>
                            </div>
                          </div>
                        </li>
                        <li class="clearfix">
                          <div class="media"><img class="rounded-circle user-image" src="../assets/images/user/8.jpg" alt="">
                            <div class="status-circle offline"></div>
                            <div class="media-body">
                              <div class="about">
                                <div class="name">Kori Thomas</div>
                                <div class="status">Change for anyone.</div>
                              </div>
                            </div>
                          </div>
                        </li>
                        <li class="clearfix">
                          <div class="media"><img class="rounded-circle user-image" src="../assets/images/user/1.jpg" alt="">
                            <div class="status-circle online"></div>
                            <div class="media-body">
                              <div class="about">
                                <div class="name">Vincent Porter</div>
                                <div class="status">Hello Name</div>
                              </div>
                            </div>
                          </div>
                        </li>
                        <li class="clearfix">
                          <div class="media"><img class="rounded-circle user-image" src="../assets/images/user/8.jpg" alt="">
                            <div class="status-circle online"></div>
                            <div class="media-body">
                              <div class="about">
                                <div class="name">Kori Thomas</div>
                                <div class="status">Change for anyone.</div>
                              </div>
                            </div>
                          </div>
                        </li>
                      </ul>
                    </div>
                  </div>
                  <!-- Chat left side Ends-->
                </div>
              </div>
            </div>
          </div>
        <div class="col call-chat-body">
            <div class="card">
                <div class="card-body p-0">
                    <div class="row chat-box">
                        <!-- Chat right side start-->
                        <div class="col chat-right-aside">
                            <!-- chat start-->
                            <div class="chat">
                                <!-- chat-header start-->
                                <div class="media chat-header clearfix"><img class="rounded-circle"
                                        src="{{ asset('assets/images/user/8.jpg') }}" alt="">
                                    <div class="media-body">
                                        <div class="about">
                                            <div class="name">{{ $child }}<span
                                                    class="font-primary f-12">Typing...</span></div>
                                            <div class="status digits">Last Seen 3:55 PM</div>
                                        </div>
                                    </div>
                                    <ul class="list-inline float-start float-sm-end chat-menu-icons">
                                        <li class="list-inline-item"><a href="javascript:void(0)"><i
                                                    class="icon-search"></i></a></li>
                                        <li class="list-inline-item"><a href="javascript:void(0)"><i
                                                    class="icon-clip"></i></a></li>
                                        <li class="list-inline-item"><a href="javascript:void(0)"><i
                                                    class="icon-headphone-alt"></i></a></li>
                                        <li class="list-inline-item"><a href="javascript:void(0)"><i
                                                    class="icon-video-camera"></i></a></li>
                                        <li class="list-inline-item toogle-bar"><a href="javascript:void(0)"><i
                                                    class="icon-menu"></i></a></li>
                                    </ul>
                                </div>
                                <!-- chat-header end-->
                                <div class="col-xl-12 chat-history chat-msg-box custom-scrollbar">
                                    <ul>
                                        @foreach ($messages as $message)
                                        <li class="col-xl-12 {{ Auth::user()->id === $message->sender_id ? 'clearfix' : '' }}">
                                            <div class="message {{ Auth::user()->id === $message->sender_id ? 'my-message' : 'other-message' }}"><img
                                                    class="rounded-circle {{ Auth::user()->id === $message->sender_id ? 'float-start' : 'float-end' }} chat-user-img img-30"
                                                    src="{{ asset('assets/images/user/3.png') }}" alt="">
                                                <div class="message-data {{ Auth::user()->id === $message->sender_id ? 'text-end' : 'text-start' }}">
                                                    <span class="message-data-time">{{ $message->created_at->diffForHumans() }}</span>
                                                </div> {{ $message->message }} 
                                            </div>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                                <!-- end chat-history-->
                                <div class="chat-message clearfix">
                                    <div class="row">
                                        <div class="col-xl-12 d-flex">
                                            <div class="smiley-box bg-primary">
                                                <div class="picker"><img src="{{ asset('assets/images/smiley.png') }}"
                                                        alt=""></div>
                                            </div>
                                            <form id="createChat" method="post">
                                                @csrf
                                            <div class="input-group text-box">
                                                <input class="form-control input-txt-bx" id="message-to-send"
                                                    type="hidden" name="received_id" value={{ $receiver }}
                                                    placeholder="Type a message......">
                                                    <input class="form-control input-txt-bx" id="message-to-send"
                                                    type="text" name="message" id="textarea"
                                                    placeholder="Type a message......">
                                                <button class="btn btn-primary input-group-text"
                                                    type="submit">SEND</button>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- end chat-message-->
                                <!-- chat end-->
                                <!-- Chat right side ends-->
                            </div>
                        </div>
                        <div class="col chat-menu">
                            <ul class="nav nav-tabs border-tab nav-primary" id="info-tab" role="tablist">
                                <li class="nav-item"><a class="nav-link active" id="info-home-tab" data-bs-toggle="tab"
                                        href="#info-home" role="tab" aria-selected="true">CALL</a>
                                    <div class="material-border"></div>
                                </li>
                                <li class="nav-item"><a class="nav-link" id="profile-info-tab" data-bs-toggle="tab"
                                        href="#info-profile" role="tab" aria-selected="false">STATUS</a>
                                    <div class="material-border"></div>
                                </li>
                                <li class="nav-item"><a class="nav-link" id="contact-info-tab" data-bs-toggle="tab"
                                        href="#info-contact" role="tab" aria-selected="false">PROFILE</a>
                                    <div class="material-border"></div>
                                </li>
                            </ul>
                            {{-- <div class="tab-content" id="info-tabContent">
                                <div class="tab-pane fade show active" id="info-home" role="tabpanel"
                                    aria-labelledby="info-home-tab">
                                    <div class="people-list">
                                        <ul class="list digits custom-scrollbar">
                                            <li class="clearfix">
                                                <div class="media"><img class="rounded-circle user-image"
                                                        src="../assets/images/user/4.jpg" alt="">
                                                    <div class="media-body">
                                                        <div class="about">
                                                            <div class="name">Erica Hughes</div>
                                                            <div class="status"><i
                                                                    class="fa fa-share font-success"></i>  5 May, 4:40
                                                                PM</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="clearfix">
                                                <div class="media"><img class="rounded-circle user-image mt-0"
                                                        src="../assets/images/user/1.jpg" alt="">
                                                    <div class="media-body">
                                                        <div class="about">
                                                            <div class="name">Vincent Porter
                                                                <div class="status"><i
                                                                        class="fa fa-reply font-danger"></i>  5 May,
                                                                    5:30 PM</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="clearfix">
                                                <div class="media"><img class="rounded-circle user-image"
                                                        src="../assets/images/user/8.jpg" alt="">
                                                    <div class="media-body">
                                                        <div class="about">
                                                            <div class="name">Kori Thomas</div>
                                                            <div class="status"><i
                                                                    class="fa fa-share font-success"></i>  1 Feb, 6:56
                                                                PM</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="clearfix">
                                                <div class="media"><img class="rounded-circle user-image"
                                                        src="../assets/images/user/2.png" alt="">
                                                    <div class="media-body">
                                                        <div class="about">
                                                            <div class="name">Aiden Chavez</div>
                                                            <div class="status"><i
                                                                    class="fa fa-reply font-danger"></i>  3 June, 1:22
                                                                PM</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="clearfix">
                                                <div class="media"><img class="rounded-circle user-image"
                                                        src="../assets/images/user/4.jpg" alt="">
                                                    <div class="media-body">
                                                        <div class="about">
                                                            <div class="name">Erica Hughes</div>
                                                            <div class="status"><i
                                                                    class="fa fa-share font-success"></i>  5 May, 4:40
                                                                PM</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="clearfix">
                                                <div class="media"><img class="rounded-circle user-image mt-0"
                                                        src="../assets/images/user/1.jpg" alt="">
                                                    <div class="media-body">
                                                        <div class="about">
                                                            <div class="name">Vincent Porter</div>
                                                            <div class="status"><i
                                                                    class="fa fa-share font-success"></i>  5 May, 5:30
                                                                PM</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="clearfix">
                                                <div class="media"><img class="rounded-circle user-image"
                                                        src="../assets/images/user/8.jpg" alt="">
                                                    <div class="media-body">
                                                        <div class="about">
                                                            <div class="name">Kori Thomas</div>
                                                            <div class="status"><i
                                                                    class="fa fa-reply font-danger"></i>   1 Feb, 6:56
                                                                PM</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="clearfix">
                                                <div class="media"><img class="rounded-circle user-image"
                                                        src="../assets/images/user/4.jpg" alt="">
                                                    <div class="media-body">
                                                        <div class="about">
                                                            <div class="name">Erica Hughes</div>
                                                            <div class="status"><i
                                                                    class="fa fa-share font-success"></i>  5 May, 4:40
                                                                PM</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="info-profile" role="tabpanel"
                                    aria-labelledby="profile-info-tab">
                                    <div class="people-list">
                                        <div class="search">
                                            <form class="theme-form" id="createChat" method="post">
                                                @csrf
                                                <div class="form-group">
                                                    <input type="hidden" id="receive_user" name="receiver_id"
                                                        value="{{ $receiver }}">
                                                    <textarea class="form-control" id="textarea" name="message"></textarea>
                                                    <i class="fa fa-pencil"></i>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="status">
                                        <p class="font-primary f-w-600">Active</p>
                                        <hr>
                                        <p>
                                            Established fact that a reader will be
                                            distracted  <i
                                                class="icofont icofont-emo-heart-eyes font-danger f-20"></i><i
                                                class="icofont icofont-emo-heart-eyes font-danger f-20 m-l-5"></i>
                                        </p>
                                        <hr>
                                        <p>Dolore magna aliqua  <i
                                                class="icofont icofont-emo-rolling-eyes font-success f-20"></i></p>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="info-contact" role="tabpanel"
                                    aria-labelledby="contact-info-tab">
                                    <div class="user-profile">
                                        <div class="image">
                                            <div class="avatar text-center"><img alt=""
                                                    src="../assets/images/user/2.png"></div>
                                            <div class="icon-wrapper"><i class="icofont icofont-pencil-alt-5"></i>
                                            </div>
                                        </div>
                                        <div class="user-content text-center">
                                            <h5 class="text-uppercase">mark jenco</h5>
                                            <div class="social-list">
                                                <ul>
                                                    <li><a href="javascript:void(0)"><i
                                                                class="fa fa-facebook"></i></a></li>
                                                    <li><a href="javascript:void(0)"><i
                                                                class="fa fa-google-plus"></i></a></li>
                                                    <li><a href="javascript:void(0)"><i class="fa fa-twitter"></i></a>
                                                    </li>
                                                    <li><a href="javascript:void(0)"><i
                                                                class="fa fa-instagram"></i></a></li>
                                                    <li><a href="javascript:void(0)"><i class="fa fa-rss"> </i></a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="follow text-center">
                                                <div class="row">
                                                    <div class="col border-right"><span>Following</span>
                                                        <div class="follow-num">236k</div>
                                                    </div>
                                                    <div class="col"><span>Follower</span>
                                                        <div class="follow-num">3691k </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="text-center digits">
                                                <p>Mark.jecno23@gmail.com</p>
                                                <p>+91 365 - 658 - 1236</p>
                                                <p>Fax: 123-4560</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                    <!-- Container-fluid Ends-->
                </div>
            </div>
        </div>
        {{-- <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Chat</div>
                <div class="panel-body">
                    <div id="chat-box">
                        <!-- Display all messages here -->
                        @foreach ($messages as $message)
                            <div
                                class="message-item {{ Auth::user()->id === $message->sender_id ? 'sent-message' : 'received-message' }}">
                                <h5>{{ $message->message }}</h5>
                                <p class="text-muted">
                                    {{ $message->created_at->diffForHumans() }}</p><br>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="panel-footer">
                    <!-- Input form to send new message -->
                    <form id="createChat" method="post">
                        @csrf
                        <div class="form-group">
                            <input type="hidden" id="receive_user" name="receiver_id" value="{{ $receiver }}">
                            <textarea class="form-control" id="textarea" name="message"></textarea>
                        </div>
                        <button id="load-new" class="btn btn-primary" type="submit">Send</button>
                    </form>
                </div>
            </div>
        </div> --}}
    </div>
</div>
