<br id="search-scraping"><br><br><br><br>
<div class="row">
    <div class="col-md-12 col-xl-12">
        <div class="col-xl-5 col-lg-5 col-md-5 col-sm-5 pull-right" id="scrap">
            <div class="row">
                <div class="col-xl-1 col-lg-1 col-md-1 col-sm-1">
                </div>
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4">
                    <div class="title">
                        <h1>Scraping</h1>
                    </div>
                </div>
                <div class="col-xl-7 col-lg-7 col-md-7 col-sm-7">
                </div>
                <div class="row">
                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2">
                    </div>
                    <div class="col-xl-10 col-lg-10 col-md-10 col-sm-10">
                        <h4 class="f-w-300">
                            <blockquote>Pencarian artikel dapat dengan mudah hanya dengan menerapkan format
                                URL yang sesuai
                                <br>
                                <a href="{{ route('review.master.index') }}"
                                    class="btn btn-lg btn-white btn-outline-primary mt-5">Scraping Now</a>
                            </blockquote>
                        </h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-7 col-lg-7 col-md-7 col-sm-7" id="demo">
            <div class="row demo-block">
                <div class="demo-box">
                    <div class="mb-3 col-md-12">
                        <div class="row text-center mb-2">
                            <strong class="ms-3 mb-3">
                                @auth
                                    <strong class="mb-3"><i>Session Terdeteksi</i></strong>
                                    <br>
                                    <a href="{{ route('dashboard.index') }}" class="btn btn-sm btn-outline-primary">Back to
                                        Dashboard</a>
                                @endauth
                            </strong>
                        </div>
                        @guest
                            @include('public.pages.home.components.1-menu')
                        @endguest
                        <div id="data-review" class="mt-3">
                            @include('public.pages.home.components.2-data')
                        </div>
                        @guest
                            @include('pages.review.components.1-load')
                        @endguest
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
