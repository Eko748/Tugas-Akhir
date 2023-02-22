<div class="col-sm-12">
    <div class="card">
        <div class="card-body">
            <div class="tab-content" id="top-tabContent">
                <div class="tab-pane fade show active" id="top-home" role="tabpanel" aria-labelledby="top-home-tab">
                    <div id="load" class="row">
                        @if ($project != null)
                            @foreach ($project as $key)
                                <div class="col-xxl-4 box-col-6 col-lg-6">
                                    <div class="project-box"><span class="badge badge-primary">Doing</span>
                                        <h6>{{ $key['title'] }}</h6>
                                        <div class="media"><img class="img-20 me-2 rounded-circle"
                                                src="../assets/images/user/3.jpg" alt="" data-original-title=""
                                                title="">
                                            <div class="media-body">
                                                <p>
                                                    @php
                                                        $priority = $key->priority;
                                                        
                                                        if ($priority == 1) {
                                                            $priority = '<span class="text-info">Low Priority</span>';
                                                        } elseif ($priority == 2) {
                                                            $priority = '<span class="text-success">Medium Priority</span>';
                                                        } elseif ($priority == 3) {
                                                            $priority = '<span class="text-warning">High Priority</span>';
                                                        } elseif ($priority == 4) {
                                                            $priority = '<span class="text-danger">Urgent Priority</span>';
                                                        } else {
                                                            $priority = '<span class="text-dark">Not Defined</span>';
                                                        }
                                                        
                                                    @endphp
                                                    {!! $priority !!}
                                                </p>
                                            </div>
                                        </div>
                                        <p>
                                            {{ $key['description'] }}
                                        </p>
                                        <div class="row details">
                                            <div class="col-6"><span>Issues </span></div>
                                            <div class="col-6 font-primary">12 </div>
                                            <div class="col-6"> <span>Resolved</span></div>
                                            <div class="col-6 font-primary">5</div>
                                            <div class="col-6"> <span>Comment</span></div>
                                            <div class="col-6 font-primary">7</div>
                                        </div>
                                        <div class="customers">
                                            <ul>
                                                <li class="d-inline-block"><img class="img-30 rounded-circle"
                                                        src="../assets/images/user/3.jpg" alt=""
                                                        data-original-title="" title=""></li>
                                                <li class="d-inline-block"><img class="img-30 rounded-circle"
                                                        src="../assets/images/user/5.jpg" alt=""
                                                        data-original-title="" title=""></li>
                                                <li class="d-inline-block"><img class="img-30 rounded-circle"
                                                        src="../assets/images/user/1.jpg" alt=""
                                                        data-original-title="" title=""></li>
                                                <li class="d-inline-block ms-2">
                                                    <p class="f-12">+10 More</p>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="project-status mt-4">
                                            <div class="media mb-0">
                                                <p>70% </p>
                                                <div class="media-body text-end"><span>Done</span></div>
                                            </div>
                                            <div class="progress" style="height: 5px">
                                                <div class="progress-bar-animated bg-primary progress-bar-striped"
                                                    role="progressbar" style="width: 70%" aria-valuenow="10"
                                                    aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <center>
                                <img id="img-scrap" class="text-center img-fluid"
                                    src="{{ asset('images/Search-Scraping.png') }}" style="width:300px" alt="">
                            </center>
                        @endif
                        <h3 class="mb-4">{!! $project->links() !!}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
