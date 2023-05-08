<header class="landing-header">
    <div class="custom-container">
        <div class="row">
            <div class="col-12">
                <nav class="navbar navbar-light p-0" id="navbar-example2"><a class="navbar-brand" href="#slr">
                        <img class="img-fluid logo" style="width: 50px" src="{{ asset('assets/images/logo/slr-dark.png') }}"
                            alt=""></a>
                    <ul class="landing-menu nav nav-pills">
                        <li class="nav-item menu-back">back<i class="fa fa-angle-right"></i></li>
                        <li class="nav-item"><a class="nav-link" href="#home"><i class="fa fa-home"></i>Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="#review"><i class="fa fa-file-text"></i>Review</a></li>
                        @guest
                        <li class="nav-item"><a class="nav-link" href="#demo"><i class="fa fa-search"></i>Demo</a></li>
                        @endguest
                        <li class="nav-item"><a class="nav-link" href="#about"><i class="fa fa-info-circle"></i>About</a></li>
                    </ul>
                    <div class="buy-block"><a class="btn-landing btn-outline-dark btn-white" href="{{ route('login') }}"
                            target="_blank"><i class="fa fa-sign-in"></i> <span>Login</span></a>
                        <div class="toggle-menu"><i class="fa fa-bars"></i></div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</header>
