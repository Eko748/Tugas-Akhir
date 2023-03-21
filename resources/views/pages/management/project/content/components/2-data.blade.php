<div class="tab-pane fade show active" id="top-home" role="tabpanel" aria-labelledby="top-home-tab">
    <div id="load" class="row">
        @if ($projects != null)
            @foreach ($projects as $project)
                @php
                    $current_time = \Carbon\Carbon::now();
                    $start_date = \Carbon\Carbon::parse($project->start_date)->setTimezone('Asia/Jakarta');
                    $end_date = \Carbon\Carbon::parse($project->end_date)->setTimezone('Asia/Jakarta');
                    $duration_in_minutes = $end_date->diffInMinutes($start_date);
                    $time_passed_in_minutes = $current_time->diffInMinutes($start_date);
                    $time_left_in_minutes = $duration_in_minutes - $time_passed_in_minutes;
                    
                    if ($time_left_in_minutes <= 0) {
                        $status = '<i class="fa fa-check text-success"></i>';
                        $time_left = '<span class="text-danger">Project telah berakhir</span>';
                    } elseif ($time_left_in_minutes < 60) {
                        $status = '<i class="fa fa-spin fa-cog" text-danger></i>';
                        $time_left = '<span class="text-warning">Sisa ' . $time_left_in_minutes . ' menit</span>';
                    } elseif ($time_left_in_minutes < 1440) {
                        $status = '<i class="fa fa-spin fa-cog text-warning"></i>';
                        $time_left = '<span class="text-success">Sisa ' . floor($time_left_in_minutes / 60) . ' jam ' . $time_left_in_minutes % 60 . ' menit</span>';
                    } else {
                        $status = '<i class="fa fa-spin fa-cog text-info"></i>';
                        $time_left = '<span class="text-info">Sisa ' . floor($time_left_in_minutes / 1440) . ' hari ' . floor(($time_left_in_minutes % 1440) / 60) . ' jam</span>';
                    }
                @endphp
                <div class="col-xxl-4 box-col-6 col-lg-6">
                    <div class="project-box"><span class="badge badge-light-primary">{!! $status !!}</span>
                        <h6>{{ $project['title'] }}</h6>
                        <div class="media"><img class="img-20 me-2 rounded-circle" src="../assets/images/user/3.jpg"
                                alt="" data-original-title="" title="">
                            <div class="media-body">
                                <p>
                                    @php
                                        $priority = $project->priority;
                                        
                                        if ($priority == 'P1') {
                                            $priority = '<span class="text-success"><b>Low</b></span>';
                                        } elseif ($priority == 'P2') {
                                            $priority = '<span class="text-info"><b>Medium</b></span>';
                                        } elseif ($priority == 'P3') {
                                            $priority = '<span class="text-warning"><b>High</b></span>';
                                        } elseif ($priority == 'P4') {
                                            $priority = '<span class="text-danger"><b>Urgent</b></span>';
                                        } else {
                                            $priority = '<span class="text-dark">Not Defined</span>';
                                        }
                                    @endphp
                                    {!! $priority !!}
                                </p>
                            </div>
                        </div>
                        <p>
                            {{ $project['description'] }}
                        </p>
                        <div class="row details">
                            <div class="col-5"><span>Commit </span></div>
                            <div class="col-7 font-primary text-primary">
                                {{ $project->hasProject->count() }}
                            </div>
                            <div class="col-5"> <span>Deadline</span></div>
                            <div class="col-7 font-primary">{!! $time_left !!}</div>
                        </div>
                        {{-- <div class="customers">
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
                                        </div> --}}
                        <div class="project-status mt-4">
                            <div class="media mb-0">
                                <p>70% </p>
                                <div class="media-body text-end"><span>Done</span></div>
                            </div>
                            <div class="progress" style="height: 5px">
                                <div class="progress-bar-animated bg-primary progress-bar-striped" role="progressbar"
                                    style="width: 70%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                        <a href="{{ Auth::user()->role_id == 1 ? route('management.project.detail', ['uuid_project' => $project->uuid_project]) : route('project.detail', ['uuid_project' => $project->uuid_project]) }}"
                            class="mt-3 btn badge-light-secondary btn-sm">Detail</a>
                    </div>
                </div>
            @endforeach
        @else
            <center>
                <img id="img-scrap" class="text-center img-fluid" src="{{ asset('images/Search-Scraping.png') }}"
                    style="width:300px" alt="">
            </center>
        @endif
        @if ($projects == !null)
            <h5 class="mb-4">
                {{ $projects->links(null, ['id' => 'projects', 'data-identifier' => 'projects']) }}
            </h5>
        @else
            <h1>Tidak ada Project</h1>
        @endif
    </div>
</div>
