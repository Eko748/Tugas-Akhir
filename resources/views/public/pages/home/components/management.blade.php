<br id="management"><br><br><br><br>
<div class="row mb-3">
    <div class="col-xl-5 col-lg-5 col-md-5 col-sm-5">
        <div class="row pull-right">
            <div class="col-xl-1 col-lg-1 col-md-1 col-sm-1">
            </div>
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4">
                <div class="title">
                    <h1>Management</h1>
                </div>
            </div>
            <div class="col-xl-7 col-lg-7 col-md-7 col-sm-7">
            </div>
            <div class="row">
                <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2">
                </div>
                <div class="col-xl-10 col-lg-10 col-md-10 col-sm-10">
                    <h4 class="f-w-300">
                        <blockquote>Kelola anggota anda untuk berkolaborasi dalam proyek SLR yang sama
                            <br>
                            @auth
                                @if (Auth::user()->role_id == '2')
                                    <a href="{{ route('dashboard.index') }}"
                                        class="btn btn-lg btn-white btn-outline-primary mt-5">Manage Now</a>
                                @else
                                    <a href="{{ route('management.member.index') }}"
                                        class="btn btn-lg btn-white btn-outline-primary mt-5">Manage Now</a>
                                @endif
                            @endauth
                            @guest
                                <a href="{{ route('management.member.index') }}"
                                    class="btn btn-lg btn-white btn-outline-primary mt-5">Manage Now</a>
                            @endguest
                        </blockquote>
                    </h4>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-7 col-lg-7 col-md-7 col-sm-7">
        <div class="row text-center">
            <div class="mb-3 col-md-12">
                <div class=""><img class="img-fluid" style="width: 90%; height: 90%"
                        src="{{ asset('assets/images/logo/1-management.png') }}" alt=""></div>
            </div>
        </div>
    </div>
</div>
