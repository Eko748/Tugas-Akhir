<li class="sidebar-list">
    <a class="sidebar-link" href="{{ route('dashboard.index') }}">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <g>
                <g>
                    <path d="M9.07861 16.1355H14.8936" stroke="#130F26" stroke-width="1.5" stroke-linecap="round"
                        stroke-linejoin="round"></path>
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M2.3999 13.713C2.3999 8.082 3.0139 8.475 6.3189 5.41C7.7649 4.246 10.0149 2 11.9579 2C13.8999 2 16.1949 4.235 17.6539 5.41C20.9589 8.475 21.5719 8.082 21.5719 13.713C21.5719 22 19.6129 22 11.9859 22C4.3589 22 2.3999 22 2.3999 13.713Z"
                        stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                </g>
            </g>
        </svg><span class="dashboard">Dashboard </span></a>

</li>
<li class="sidebar-list">
    <a class="sidebar-link sidebar-title" href="#">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <g>
                <g>
                    <path d="M14.3053 15.45H8.90527" stroke="#130F26" stroke-width="1.5" stroke-linecap="round"
                        stroke-linejoin="round"></path>
                    <path d="M12.2604 11.4387H8.90442" stroke="#130F26" stroke-width="1.5" stroke-linecap="round"
                        stroke-linejoin="round"></path>
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M20.1598 8.3L14.4898 2.9C13.7598 2.8 12.9398 2.75 12.0398 2.75C5.74978 2.75 3.64978 5.07 3.64978 12C3.64978 18.94 5.74978 21.25 12.0398 21.25C18.3398 21.25 20.4398 18.94 20.4398 12C20.4398 10.58 20.3498 9.35 20.1598 8.3Z"
                        stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                    <path d="M13.9342 2.83276V5.49376C13.9342 7.35176 15.4402 8.85676 17.2982 8.85676H20.2492"
                        stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                </g>
            </g>
        </svg>
        <span class="management">Management</span></a>
    <ul class="sidebar-submenu">
        @php
            $auth = Auth::user()->id;
            $m = App\Models\Project::where('created_by', $auth)->first();
            $project = $m->uuid_project;
        @endphp
        <li>
            <a href="{{ route('management.member.index') }}">Member</a>
        </li>
        <li>
            <a href="{{ route('management.project.index', ['uuid_project' => $project]) }}">Project</a>
        </li>
        {{-- <li>
            <a class="project-master" href="{{ route('management.project.index') }}">
                Project Master
                @if ($projects->count() > 0)
                    <sup class="mt-2 text-primary"><b>{{ $projects->count() }}</b></sup>
                @endif
            </a>
        </li> --}}
        {{-- @if (!empty($projects)) --}}
        {{-- @if ($cv) --}}
        {{-- <li>
                <a class="submenu-title" href="#">Up Coming<span class="sub-arrow"><i
                            class="fa fa-angle-right"></i></span></a>
                <ul class="nav-sub-childmenu submenu-content">
                    @if (!empty($p))
                        @foreach ($p as $pr)
                            @php
                                $start_h = \Carbon\Carbon::parse($pr->start_date)->setTimezone('Asia/Jakarta');
                                $end_h = \Carbon\Carbon::parse($pr->end_date)->setTimezone('Asia/Jakarta');
                                $current_h = \Carbon\Carbon::now()->setTimezone('Asia/Jakarta');
                                $g = $current_h < $start_h && $current_h < $end_h;
                            @endphp

                            @if ($g)
                                <li>
                                    <a href="{{ route('management.project.detail', ['uuid_project' => $pr->uuid_project]) }}"
                                        data-bs-trigger="hover" data-container="body" data-bs-toggle="popover"
                                        data-bs-placement="right" data-offset="-5px -5px"
                                        data-bs-content="{{ $pr->description }}" title="{{ $pr->subject }}">
                                        <small class="">{{ $pr['subject'] }}</small>
                                    </a>
                                </li>
                            @endif
                        @endforeach
                    @endif
                </ul>
            </li> --}}
        {{-- @endif --}}
        {{-- @if ($c) --}}
        {{-- <li>
                <a class="submenu-title" href="#">Doing <span class="sub-arrow"><i
                            class="fa fa-angle-right"></i></span></a>
                <ul class="nav-sub-childmenu submenu-content">
                    @if (!empty($projects))
                        @foreach ($projects as $project)
                            @php
                                $start_date = \Carbon\Carbon::parse($project->start_date)->setTimezone('Asia/Jakarta');
                                $end_date = \Carbon\Carbon::parse($project->end_date)->setTimezone('Asia/Jakarta');
                                $current_time = \Carbon\Carbon::now()->setTimezone('Asia/Jakarta');
                                $h = $current_time > $start_date && $current_time < $end_date;
                            @endphp

                            @if ($h)
                                <li>
                                    <a href="{{ route('management.project.detail', ['uuid_project' => $project->uuid_project]) }}"
                                        data-bs-trigger="hover" data-container="body" data-bs-toggle="popover"
                                        data-bs-placement="right" data-offset="-5px -5px"
                                        data-bs-content="{{ $project->description }}" title="{{ $project->subject }}">
                                        <small class="">{{ $project['subject'] }}</small>
                                    </a>
                                </li>
                            @endif
                        @endforeach
                    @endif
                </ul>
            </li> --}}
        {{-- @endif --}}
        {{-- @endif --}}

    </ul>
</li>
<li class="sidebar-list">
    <a class="sidebar-link sidebar-title" href="#">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <g>
                <g>
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M11.2753 2.71436C16.0029 2.71436 19.8363 6.54674 19.8363 11.2753C19.8363 16.0039 16.0029 19.8363 11.2753 19.8363C6.54674 19.8363 2.71436 16.0039 2.71436 11.2753C2.71436 6.54674 6.54674 2.71436 11.2753 2.71436Z"
                        stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M19.8987 18.4878C20.6778 18.4878 21.3092 19.1202 21.3092 19.8983C21.3092 20.6783 20.6778 21.3097 19.8987 21.3097C19.1197 21.3097 18.4873 20.6783 18.4873 19.8983C18.4873 19.1202 19.1197 18.4878 19.8987 18.4878Z"
                        stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                </g>
            </g>
        </svg>
        <span class="">Review</span></a>
    <ul class="sidebar-submenu">
        <li><a href="{{ route('review.master.index') }}">Review Master</a></li>
        <li>
            <a class="submenu-title" href="#">Category<span class="sub-arrow"><i
                        class="fa fa-angle-right"></i></span></a>
            <ul class="nav-sub-childmenu submenu-content">
                <li><a href="{{ route('review.ieee.index') }}">IEEE</a></li>
                <li><a href="{{ route('review.acm.index') }}">ACM</a></li>
                <li><a href="{{ route('review.springer.index') }}">Springer</a></li>
            </ul>
        </li>
    </ul>
</li>
<li class="sidebar-list">
    <a class="sidebar-link sidebar-title" href="#">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <g>
                <g>
                    <path d="M11.1437 17.8829H4.67114" stroke="#130F26" stroke-width="1.5" stroke-linecap="round"
                        stroke-linejoin="round"></path>
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M15.205 17.8839C15.205 19.9257 15.8859 20.6057 17.9267 20.6057C19.9676 20.6057 20.6485 19.9257 20.6485 17.8839C20.6485 15.8421 19.9676 15.1621 17.9267 15.1621C15.8859 15.1621 15.205 15.8421 15.205 17.8839Z"
                        stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                    <path d="M14.1765 7.39439H20.6481" stroke="#130F26" stroke-width="1.5" stroke-linecap="round"
                        stroke-linejoin="round"></path>
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M10.1153 7.39293C10.1153 5.35204 9.43436 4.67114 7.39346 4.67114C5.35167 4.67114 4.67078 5.35204 4.67078 7.39293C4.67078 9.43472 5.35167 10.1147 7.39346 10.1147C9.43436 10.1147 10.1153 9.43472 10.1153 7.39293Z"
                        stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                </g>
            </g>
        </svg>
        <span class="recycle">Recycle</span></a>
    <ul class="sidebar-submenu">
        <li><a href="{{ route('recycle.member') }}">Member</a></li>
        <li><a href="{{ route('recycle.project') }}">Project</a></li>
    </ul>
</li>
