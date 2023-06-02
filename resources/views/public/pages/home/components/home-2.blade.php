<section class="demo-section section-py-space" id="scraping">
    <div class="custom-container">
        <div class="card">
            <div class="card-header">
                <div class="title">
                    <h1>Scraping</h1>
                </div>
                <div class="row">
                    <div class="col-xl-2 col-md-2 col-sm-2">
                    </div>
                    <div class="figure text-center col-xl-8 col-md-8 col-sm-8">
                        <h4 class="f-w-300">
                            <blockquote class="blockquote mb-0">Systematic Literature Review dilakukan melalui teknologi
                                Scraping pada beberapa website seperti IEEE, ACM dan Springer untuk mempermudah dan
                                mempercepat proses pengumpulan data</blockquote>
                        </h4>
                        <a href="{{ route('login') }}" class="btn btn-lg btn-outline-primary">Get Started</a>
                    </div>
                    <div class="col-xl-2 col-md-2 col-sm-2">
                    </div>
                </div>
            </div>
            <div class="card-body mb-5">
                <div class="row demo-block">
                    <div class="col-lg-4 col-md-4 col-sm-6 wow pulse">
                        <div class="demo-box text-center">
                            <div class="img-wrraper"><img class="img-fluid" style="width: 200px; height: 100px"
                                    src="{{ asset('assets/images/logo/ieee.png') }}" alt=""></div>
                            <div class="demo-title"><a class="btn" href="https://ieeexplore.ieee.org/"
                                    target="_blank">
                                    <i class="fa fa-paper-plane"></i></a></div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6 wow pulse">
                        <div class="demo-box text-center">
                            <div class="img-wrraper"><img class="img-fluid ms-5 me-5"
                                    style="width: 100px; height: 100px" src="{{ asset('assets/images/logo/acm.png') }}"
                                    alt=""></div>
                            <div class="demo-title"><a class="btn" href="https://www.acm.org/" target="_blank"><i
                                        class="fa fa-paper-plane"></i></a></div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6 wow pulse">
                        <div class="demo-box text-center">
                            <div class="img-wrraper"><img class="img-fluid" style="width: 200px; height: 100px"
                                    src="{{ asset('assets/images/logo/springer.png') }}" alt=""></div>
                            <div class="demo-title"><a class="btn" href="https://link.springer.com/"
                                    target="_blank"><i class="fa fa-paper-plane"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                @include('public.pages.home.components.management')
                @include('public.pages.home.components.search')
            </div>
        </div>
    </div>
</section>
