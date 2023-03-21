<div class="tab-pane" id="top-doing" role="tabpanel" aria-labelledby="top-doing-tab">
    <div id="load" class="row">
        @if ($doing != null)
            @foreach ($doing as $v)
                @php
                    $c = \Carbon\Carbon::now();
                    $s = \Carbon\Carbon::parse($v->start_date)->setTimezone('Asia/Jakarta');
                    $e = \Carbon\Carbon::parse($v->end_date)->setTimezone('Asia/Jakarta');
                    $d = $e->diffInMinutes($s);
                    $ts = $c->diffInMinutes($s);
                    $tl = $d - $ts;
                    
                    if ($tl <= 0) {
                        $status = '<i class="fa fa-check text-success"></i>';
                        $time = '<span class="text-danger">Project telah berakhir</span>';
                    } elseif ($tl < 60) {
                        $status = '<i class="fa fa-spin fa-cog" text-danger></i>';
                        $time = '<span class="text-warning">Sisa ' . $tl . ' menit</span>';
                    } elseif ($tl < 1440) {
                        $status = '<i class="fa fa-spin fa-cog text-warning"></i>';
                        $time = '<span class="text-success">Sisa ' . floor($tl / 60) . ' jam ' . $tl % 60 . ' menit</span>';
                    } else {
                        $status = '<i class="fa fa-spin fa-cog text-info"></i>';
                        $time = '<span class="text-info">Sisa ' . floor($tl / 1440) . ' hari ' . floor(($tl % 1440) / 60) . ' jam</span>';
                    }
                @endphp
                <div class="col-xxl-4 box-col-6 col-lg-6">
                    <div class="project-box"><span class="badge badge-light-primary">{!! $status !!}</span>
                        <h6>{{ $v['title'] }}</h6>
                        <div class="media"><img class="img-20 me-2 rounded-circle" src="../assets/images/user/3.jpg"
                                alt="" data-original-title="" title="">
                            <div class="media-body">
                                <p>
                                    @php
                                        $p = $v->priority;
                                        
                                        if ($p == 'P1') {
                                            $p = '<span class="text-success"><b>Low</b></span>';
                                        } elseif ($p == 'P2') {
                                            $p = '<span class="text-info"><b>Medium</b></span>';
                                        } elseif ($p == 'P3') {
                                            $p = '<span class="text-warning"><b>High</b></span>';
                                        } elseif ($p == 'P4') {
                                            $p = '<span class="text-danger"><b>Urgent</b></span>';
                                        } else {
                                            $p = '<span class="text-dark">Not Defined</span>';
                                        }
                                    @endphp
                                    {!! $p !!}
                                </p>
                            </div>
                        </div>
                        <p>
                            {{ $v['description'] }}
                        </p>
                        <div class="row details">
                            <div class="col-5"><span>Commit </span></div>
                            <div class="col-7 font-primary text-primary">
                                {{ $v->hasProject->count() }}
                            </div>
                            <div class="col-5"> <span>Deadline</span></div>
                            <div class="col-7 font-primary">{!! $time !!}</div>
                        </div>
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
                        <a href="{{ Auth::user()->role_id == 1 ? route('management.project.detail', ['uuid_project' => $v->uuid_project]) : route('project.detail', ['uuid_project' => $v->uuid_project]) }}"
                            class="mt-3 btn badge-light-secondary btn-sm">Detail</a>
                    </div>
                </div>
            @endforeach
        @endif
        {{-- @if ($doing == !null)
            <h5 class="mb-4">
                {{ $doing->links() }}
            </h5>
        @else
            <h1>Tidak ada Project</h1>
        @endif --}}
    </div>
</div>