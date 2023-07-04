<div class="sidebar-wrapper">
    <div>
        <div class="logo-wrapper">
            <a href="{{ route('home') }}">
                <img class="img-fluid for-light" style="width:300%; height:300%"
                    src="{{ asset('assets/images/logo/slr.png') }}" alt="" />
                <img class="img-fluid for-dark" style="width:300%; height:300%"
                    src="{{ asset('assets/images/logo/logo-dark.png') }}" alt="" />
            </a>
        </div>
        <div class="logo-icon-wrapper">
            <a href="{{ route('home') }}"><img class="img-fluid" src="{{ asset('assets/images/logo/slr.png') }}"
                    alt="" /></a>
        </div>
        <nav class="sidebar-main">
            <div class="left-arrow" id="left-arrow">
                <i data-feather="arrow-left"></i>
            </div>
            <div id="sidebar-menu">
                <ul class="sidebar-links" id="simple-bar">
                    <li class="back-btn">
                        <a href="/"><img class="img-fluid" src="{{ asset('assets/images/logo-icon.png') }}"
                                alt="" /></a>
                        <div class="mobile-back text-end">
                            <span>Back</span><i class="fa fa-angle-right ps-2" aria-hidden="true"> </i>
                        </div>
                    </li>
                    @if (Auth::check())
                        @if (Auth::user()->role_id == '1')
                            @include('layout.sidebar.leader')
                        @elseif (Auth::user()->role_id == '2')
                            @include('layout.sidebar.member')
                        @endif
                    @endif
                </ul>
                {{-- <div class="sidebar-img-section mt-5">
                    <div class="sidebar-img-content mt-5">
                        <img class="img-fluid" src="{{ asset('assets/images/logo/slr-logo.png') }}" alt="" />
                    </div>
                </div> --}}
            </div>
        </nav>
    </div>
</div>
