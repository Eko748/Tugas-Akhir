@if ($doing != null)
    @if ($page_doing->count() > 12)
        {{ $doing->render('pagination.project', compact('projects')) }}
    @endif
    <div class="tab-pane" id="top-doing" role="tabpanel" aria-labelledby="top-doing-tab">
        <div id="load" class="row">
            @foreach ($doing as $project)
                @php
                    $current_time = \Carbon\Carbon::now();
                    $start_date = \Carbon\Carbon::parse($project->start_date)->setTimezone('Asia/Jakarta');
                    $end_date = \Carbon\Carbon::parse($project->end_date)->setTimezone('Asia/Jakarta');
                    $duration_in_minutes = $end_date->diffInMinutes($start_date);
                    $time_passed_in_minutes = $current_time->diffInMinutes($start_date);
                    $time_left_in_minutes = $duration_in_minutes - $time_passed_in_minutes;
                    $t = $start_date->diffInMinutes($current_time);
                    
                    if ($current_time < $start_date) {
                        $status = '<i class="fa fa-spin fa-cog text-info"></i>';
                        $time_left = '<span class="text-info">Belum Dimulai</span>';
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
                        <h6>{{ $project['subject'] }}</h6>
                        <div class="media">
                            <div class="media-body">
                                <p>
                                    @php
                                        $priority = $project->priority;
                                        
                                        if ($priority == 'P1') {
                                            $priority = 'success';
                                            $info = 'Rendah';
                                        } elseif ($priority == 'P2') {
                                            $priority = 'info';
                                            $info = 'Sedang';
                                        } elseif ($priority == 'P3') {
                                            $priority = 'warning';
                                            $info = 'Tinggi';
                                        } elseif ($priority == 'P4') {
                                            $priority = 'danger';
                                            $info = 'Urgent';
                                        } else {
                                            $priority = 'dark';
                                            $info = 'Tidak ada';
                                        }
                                    @endphp
                                    <span title="Prioritas {!! $info !!}"
                                        class="btn badge-{!! $priority !!} btn-sm"></span>
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
                            <div class="col-5"><span>Target </span></div>
                            <div class="col-7 font-primary text-primary">
                                {{ $project->target }}
                            </div>
                            <div class="col-5"> <span>Deadline</span></div>
                            <div class="col-7 font-primary"><small>{!! $time_left !!}</small></div>
                        </div>
                        @php
                            $progress = $project->hasProject->count();
                            $target = $project->target;
                            $width = $progress >= $target ? 100 : ($progress / $target) * 100;
                            $width = $width > 100 ? 100 : $width;
                            if (floor($width) == $width) {
                                $width = number_format($width, 0);
                            } else {
                                $width = number_format($width, 2);
                            }
                            if ($width <= 25) {
                                $bg = 'danger';
                            } elseif ($width > 25 && $width <= 50) {
                                $bg = 'warning';
                            } elseif ($width > 50 && $width <= 75) {
                                $bg = 'info';
                            } elseif ($width > 75 && $width <= 100) {
                                $bg = 'success';
                            } else {
                                $bg = 'dark';
                            }
                        @endphp
                        <div class="project-status mt-4">
                            <div class="media mb-0">
                                <p>{{ $width }}% </p>
                                <div class="media-body text-end">
                                    @if ($width >= 100)
                                        <span>Done</span>
                                    @else
                                        <span>Progres</span>
                                    @endif
                                </div>
                            </div>
                            <div class="progress" style="height: 5px">
                                <div class="progress-bar-animated bg-{!! $bg !!} progress-bar-striped"
                                    role="progressbar" style="width: {{ $width }}%"
                                    aria-valuenow="{{ $width }}" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                        <a href="{{ Auth::user()->role_id == 1 ? route('management.project.detail', ['uuid_project' => $project->uuid_project]) : route('project.detail', ['uuid_project' => $project->uuid_project]) }}"
                            class="mt-3 btn badge-light-primary btn-xs"
                            title="Lihat semua commit project {{ $project['subject'] }}">
                            <i class="fa fa-folder-open"></i> Detail Commit
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    @if ($page_doing->count() > 12)
        {{ $doing->render('pagination.project', compact('projects')) }}
    @endif
@else
    <center>
        <img id="img-scrap" class="text-center img-fluid" src="{{ asset('images/Search-Scraping.png') }}"
            style="width:300px" alt="">
    </center>
@endif
