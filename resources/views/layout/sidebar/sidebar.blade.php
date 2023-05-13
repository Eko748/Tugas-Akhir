<div class="sidebar-wrapper">
    <div>
        <div class="logo-wrapper">
            <a href="/">
                <img class="img-fluid for-light" style="width:300%; height:300%"
                    src="{{ asset('assets/images/logo/slr.png') }}" alt="" />
                <img class="img-fluid for-dark" style="width:300%; height:300%"
                    src="{{ asset('assets/images/logo/logo-dark.png') }}" alt="" />
            </a>
            {{-- <div class="back-btn"><i class="fa fa-angle-left"></i></div> --}}
        </div>
        <div class="logo-icon-wrapper">
            <a href="/"><img class="img-fluid" src="{{ asset('assets/images/logo/slr.png') }}"
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
                <div class="sidebar-img-section mb-3">
                    <div class="sidebar-img-content mb-3">
                        <img class="img-fluid" src="{{ asset('assets/images/logo/slr-logo.png') }}" alt="" />
                        <h4></h4>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a title="Log Out" class="cool btn btn-secondary btn-outline-dark"
                                href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                this.closest('form').submit();">
                                <i class="fa fa-sign-out"></i>
                            </a>
                        </form>
                    </div>
                </div>
            </div>
            {{-- <div class="right-arrow" id="right-arrow">
                <i data-feather="arrow-right"></i>
            </div> --}}
        </nav>
    </div>
</div>
