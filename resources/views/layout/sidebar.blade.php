<div class="sidebar-wrapper">
    <div>
        <div class="logo-wrapper">
            <a href="/"><img class="img-fluid for-light" src="{{ asset('assets/images/logo/small-logo.png') }}"
                    alt="" /><img class="img-fluid for-dark"
                    src="{{ asset('assets/images/logo/small-white-logo.png') }}" alt="" /></a>
            {{-- <div class="back-btn"><i class="fa fa-angle-left"></i></div> --}}
        </div>
        <div class="logo-icon-wrapper">
            <a href="/"><img class="img-fluid" src="{{ asset('assets/images/logo-icon.png') }}"
                    alt="" /></a>
        </div>
        <nav class="sidebar-main">
            {{-- <div class="left-arrow" id="left-arrow">
        <i data-feather="arrow-left"></i>
      </div> --}}
            <div id="sidebar-menu">
                <ul class="sidebar-links" id="simple-bar">
                    <li class="back-btn">
                        <a href="/"><img class="img-fluid" src="{{ asset('assets/images/logo-icon.png') }}"
                                alt="" /></a>
                        <div class="mobile-back text-end">
                            <span>Back</span><i class="fa fa-angle-right ps-2" aria-hidden="true"> </i>
                        </div>
                    </li>
                    @if (Auth::user()->role_id == '1')
                        <li class="sidebar-list">
                            {{-- <label class="badge badge-light-primary">2</label --}}
                            <a class="sidebar-link" href="{{ route('dashboard.index') }}">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g>
                                        <g>
                                            <path d="M9.07861 16.1355H14.8936" stroke="#130F26" stroke-width="1.5"
                                                stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M2.3999 13.713C2.3999 8.082 3.0139 8.475 6.3189 5.41C7.7649 4.246 10.0149 2 11.9579 2C13.8999 2 16.1949 4.235 17.6539 5.41C20.9589 8.475 21.5719 8.082 21.5719 13.713C21.5719 22 19.6129 22 11.9859 22C4.3589 22 2.3999 22 2.3999 13.713Z"
                                                stroke="#130F26" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round"></path>
                                        </g>
                                    </g>
                                </svg><span class="dashboard">Dashboard </span></a>

                        </li>
                        <li class="sidebar-list">
                            <a class="sidebar-link sidebar-title" href="#">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g>
                                        <g>
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M2.75024 12C2.75024 5.063 5.06324 2.75 12.0002 2.75C18.9372 2.75 21.2502 5.063 21.2502 12C21.2502 18.937 18.9372 21.25 12.0002 21.25C5.06324 21.25 2.75024 18.937 2.75024 12Z"
                                                stroke="#130F26" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round"></path>
                                            <path d="M15.2045 13.8999H15.2135" stroke="#130F26" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path d="M12.2045 9.8999H12.2135" stroke="#130F26" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path d="M9.19557 13.8999H9.20457" stroke="#130F26" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"></path>
                                        </g>
                                    </g>
                                </svg><span class="management">Management</span></a>
                            <ul class="sidebar-submenu">
                                <li><a href="{{ route('management.member.index') }}">Member</a></li>
                                <li>
                                    <a class="submenu-title" href="#">Project<span class="sub-arrow"><i
                                                class="fa fa-angle-right"></i></span></a>
                                    <ul class="nav-sub-childmenu submenu-content">
                                        <li>
                                            <a href="{{ route('management.project.index') }}">Project Master</a>
                                        </li>
                                        @php
                                            $projects = App\Models\Project::where('created_by', Auth::user()->id)->get();
                                        @endphp
                                        @if ($projects == !null)
                                        @foreach($projects as $project)
                                        <li>
                                            <a href="{{ route('management.project.detail', ["uuid_project"=> $project->uuid_project]) }}"
                                                data-bs-trigger="hover" data-container="body" data-bs-toggle="popover" 
                                                data-bs-placement="right" data-offset="-5px -5px" 
                                                data-bs-content="{{ $project->description }}" 
                                                title="{{ $project->title }}">
                                                <small class="">{{ $project['title'] }}</small>
                                            </a>
                                        </li>
                                        @endforeach 
                                        @endif
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li class="sidebar-list">
                            <a class="sidebar-link sidebar-title" href="#">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g>
                                        <g>
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M2.75024 12C2.75024 5.063 5.06324 2.75 12.0002 2.75C18.9372 2.75 21.2502 5.063 21.2502 12C21.2502 18.937 18.9372 21.25 12.0002 21.25C5.06324 21.25 2.75024 18.937 2.75024 12Z"
                                                stroke="#130F26" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round"></path>
                                            <path d="M15.2045 13.8999H15.2135" stroke="#130F26" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path d="M12.2045 9.8999H12.2135" stroke="#130F26" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path d="M9.19557 13.8999H9.20457" stroke="#130F26" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"></path>
                                        </g>
                                    </g>
                                </svg><span class="">Scraping</span></a>
                            <ul class="sidebar-submenu">
                                <li><a href="{{ route('scraping.index') }}">Document</a></li>
                                <li><a href="{{ route('scraping.review.index') }}">Review</a></li>
                            </ul>
                        </li>
                        <li class="sidebar-list">
                            <a class="sidebar-link sidebar-title" href="#">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g>
                                        <g>
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M2.75024 12C2.75024 5.063 5.06324 2.75 12.0002 2.75C18.9372 2.75 21.2502 5.063 21.2502 12C21.2502 18.937 18.9372 21.25 12.0002 21.25C5.06324 21.25 2.75024 18.937 2.75024 12Z"
                                                stroke="#130F26" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round"></path>
                                            <path d="M15.2045 13.8999H15.2135" stroke="#130F26" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path d="M12.2045 9.8999H12.2135" stroke="#130F26" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path d="M9.19557 13.8999H9.20457" stroke="#130F26" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"></path>
                                        </g>
                                    </g>
                                </svg><span class="recycle">Recycle</span></a>
                            <ul class="sidebar-submenu">
                                <li><a href="{{ route('management.member.index') }}">Member</a></li>
                                <li><a href="{{ route('management.member.index') }}">Project</a></li>
                            </ul>
                        </li>
                    @else
                        <li class="sidebar-list">
                            <label class="badge badge-light-primary">2</label><a class="sidebar-link sidebar-title"
                                href="#">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g>
                                        <g>
                                            <path d="M9.07861 16.1355H14.8936" stroke="#130F26" stroke-width="1.5"
                                                stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M2.3999 13.713C2.3999 8.082 3.0139 8.475 6.3189 5.41C7.7649 4.246 10.0149 2 11.9579 2C13.8999 2 16.1949 4.235 17.6539 5.41C20.9589 8.475 21.5719 8.082 21.5719 13.713C21.5719 22 19.6129 22 11.9859 22C4.3589 22 2.3999 22 2.3999 13.713Z"
                                                stroke="#130F26" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round"></path>
                                        </g>
                                    </g>
                                </svg><span class="settings">Settings </span></a>
                            <ul class="sidebar-submenu">
                                <li><a class="lan-4" href="/dashboard_default">Default</a></li>
                                <li>
                                    <a class="lan-5" href="/dashboard_ecommerce">E-commerce</a>
                                </li>
                                <li><a href="/dashboard_crypto">Crypto</a></li>
                            </ul>
                        </li>
                    @endif
                </ul>
                <div class="sidebar-img-section">
                    <div class="sidebar-img-content">
                        <img class="img-fluid" src="{{ asset('assets/images/side-bar.png') }}" alt="" />
                        <h4>Need Help ?</h4>
                        {{-- <a class="txt" href="https://pixelstrap.freshdesk.com/support/home">Raise ticket at
                            "support@pixelstrap.com"</a> --}}
                        <a class="btn btn-secondary" href="{{ route('logout') }}">Log Out</a>
                    </div>
                </div>
            </div>
            {{-- <div class="right-arrow" id="right-arrow">
        <i data-feather="arrow-right"></i>
      </div> --}}
        </nav>
    </div>
</div>
