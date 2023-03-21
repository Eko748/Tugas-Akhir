<li class="sidebar-list">
    {{-- <label class="badge badge-light-primary">2</label --}}
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
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M2.75024 12C2.75024 5.063 5.06324 2.75 12.0002 2.75C18.9372 2.75 21.2502 5.063 21.2502 12C21.2502 18.937 18.9372 21.25 12.0002 21.25C5.06324 21.25 2.75024 18.937 2.75024 12Z"
                        stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                    <path d="M15.2045 13.8999H15.2135" stroke="#130F26" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round"></path>
                    <path d="M12.2045 9.8999H12.2135" stroke="#130F26" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round"></path>
                    <path d="M9.19557 13.8999H9.20457" stroke="#130F26" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round"></path>
                </g>
            </g>
        </svg><span class="management">Management</span></a>
    <ul class="sidebar-submenu">
        @php
            $projects = App\Models\Project::with('getUser')
                ->where('created_by', Auth::user()->id)
                ->orderBy('created_at', 'desc')
                ->get();
            $p = App\Models\Project::with('getUser')
                ->where('created_by', Auth::user()->id)
                ->get();
        @endphp
        @foreach ($projects as $v)
            @php
                $start = \Carbon\Carbon::parse($v->start_date)->setTimezone('Asia/Jakarta');
                $end = \Carbon\Carbon::parse($v->end_date)->setTimezone('Asia/Jakarta');
                $current = \Carbon\Carbon::now()->setTimezone('Asia/Jakarta');
            @endphp
        @endforeach
        <li>
            <a href="{{ route('management.member.index') }}">Member</a>
        </li>
        <li>
            <a class="project-master" href="{{ route('management.project.index') }}">
                Project Master
                @if ($projects->count() > 0)
                    <sup class="mt-2 text-primary"><b>{{ $projects->count() }}</b></sup>
                @endif
            </a>
        </li>

        @if (!empty($v))
            @if ($current <= $end && $current >= $start)
                <li>
                    <a class="submenu-title" href="#">Doing <span class="sub-arrow"><i
                                class="fa fa-angle-right"></i></span></a>
                    <ul class="nav-sub-childmenu submenu-content">
                        @if (!empty($projects))
                            @foreach ($projects as $project)
                                @php
                                    $start_date = \Carbon\Carbon::parse($project->start_date)->setTimezone('Asia/Jakarta');
                                    $end_date = \Carbon\Carbon::parse($project->end_date)->setTimezone('Asia/Jakarta');
                                    $current_time = \Carbon\Carbon::now()->setTimezone('Asia/Jakarta');
                                @endphp

                                @if ($current_time <= $end_date && $current_time >= $start_date)
                                    <li>
                                        <a href="{{ route('management.project.detail', ['uuid_project' => $project->uuid_project]) }}"
                                            data-bs-trigger="hover" data-container="body" data-bs-toggle="popover"
                                            data-bs-placement="right" data-offset="-5px -5px"
                                            data-bs-content="{{ $project->description }}" title="{{ $project->title }}">
                                            <small class="">{{ $project['title'] }}</small>
                                        </a>
                                    </li>
                                @endif
                            @endforeach
                        @endif
                    </ul>
                </li>

                <li>
                    <a class="submenu-title" href="#">Up Coming<span class="sub-arrow"><i
                                class="fa fa-angle-right"></i></span></a>
                    <ul class="nav-sub-childmenu submenu-content">
                        @if (!empty($projects))
                            @foreach ($projects as $project)
                                @php
                                    $start_h = \Carbon\Carbon::parse($project->start_date)->setTimezone('Asia/Jakarta');
                                    $end_h = \Carbon\Carbon::parse($project->end_date)->setTimezone('Asia/Jakarta');
                                    $current_h = \Carbon\Carbon::now()->setTimezone('Asia/Jakarta');
                                @endphp

                                @if ($current_h <= $start_h)
                                    <li>
                                        <a href="{{ route('management.project.detail', ['uuid_project' => $project->uuid_project]) }}"
                                            data-bs-trigger="hover" data-container="body" data-bs-toggle="popover"
                                            data-bs-placement="right" data-offset="-5px -5px"
                                            data-bs-content="{{ $project->description }}"
                                            title="{{ $project->title }}">
                                            <small class="">{{ $project['title'] }}</small>
                                        </a>
                                    </li>
                                @endif
                            @endforeach
                        @endif
                    </ul>
                </li>
            @endif
        @endif
    </ul>
</li>
<li class="sidebar-list">
    <a class="sidebar-link sidebar-title" href="#">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <g>
                <g>
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M2.75024 12C2.75024 5.063 5.06324 2.75 12.0002 2.75C18.9372 2.75 21.2502 5.063 21.2502 12C21.2502 18.937 18.9372 21.25 12.0002 21.25C5.06324 21.25 2.75024 18.937 2.75024 12Z"
                        stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                    <path d="M15.2045 13.8999H15.2135" stroke="#130F26" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round"></path>
                    <path d="M12.2045 9.8999H12.2135" stroke="#130F26" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round"></path>
                    <path d="M9.19557 13.8999H9.20457" stroke="#130F26" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round"></path>
                </g>
            </g>
        </svg><span class="">Review</span></a>
    <ul class="sidebar-submenu">
        <li><a href="{{ route('review.master.index') }}">Review Master</a></li>
        <li>
            <a class="submenu-title" href="#">Category<span class="sub-arrow"><i
                        class="fa fa-angle-right"></i></span></a>
            <ul class="nav-sub-childmenu submenu-content">
                <li><a href="{{ route('review.ieee.index') }}">IEEE</a></li>
                <li><a href="{{ route('review.sciencedirect.index') }}">Science Direct</a></li>
                <li><a href="{{ route('review.springer.index') }}">Springer</a></li>
                <li><a href="{{ route('review.acm.index') }}">ACM</a></li>
                <li><a href="{{ route('review.citeseerx.index') }}">CiterX</a></li>
            </ul>
        </li>
    </ul>
</li>
<li class="sidebar-list">
    <a class="sidebar-link sidebar-title" href="#">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <g>
                <g>
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M2.75024 12C2.75024 5.063 5.06324 2.75 12.0002 2.75C18.9372 2.75 21.2502 5.063 21.2502 12C21.2502 18.937 18.9372 21.25 12.0002 21.25C5.06324 21.25 2.75024 18.937 2.75024 12Z"
                        stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                    <path d="M15.2045 13.8999H15.2135" stroke="#130F26" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round"></path>
                    <path d="M12.2045 9.8999H12.2135" stroke="#130F26" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round"></path>
                    <path d="M9.19557 13.8999H9.20457" stroke="#130F26" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round"></path>
                </g>
            </g>
        </svg><span class="recycle">Recycle</span></a>
    <ul class="sidebar-submenu">
        <li><a href="{{ route('management.member.index') }}">Member</a></li>
        <li><a href="{{ route('management.member.index') }}">Project</a></li>
    </ul>
</li>
