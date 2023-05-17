<div class="ribbon-wrapper card">
    <div class="card-body">
        <div class="ribbon ribbon-clip ribbon-secondary">
            <b>Scraping Data</b>
        </div>
        <div class="row">
            <div class="col-md-4 col-sm-4">
                <div class="card">
                    <div class="card-body">
                        <div class="widget-card">
                            <div class="media-body">
                                <div class="row mb-3">
                                    <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                                        <img style="width: 100px; height: 70px"
                                            src="{{ asset('assets/images/logo/ieee.png') }}" alt="">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <a href="{{ Auth::user()->role_id == 1 ? route('review.ieee.index') : route('ieee.index') }}"
                                            title="Scraping IEEE" class="btn btn-outline-primary" data-bs-placement="bottom">
                                            IEEE <i class="fa fa-paper-plane"> </i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-4">
                <div class="card">
                    <div class="card-body">
                        <div class="widget-card">
                            <div class="media-body">
                                <div class="row mb-3">
                                    <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                                        <img style="width: 70px; height: 70px"
                                            src="{{ asset('assets/images/logo/acm.png') }}" alt="">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 text-center">
                                        <a href="{{ Auth::user()->role_id == 1 ? route('review.acm.index') : route('acm.index') }}"
                                            title="Scraping ACM" class="btn btn-outline-primary" data-bs-placement="bottom">
                                            ACM <i class="fa fa-paper-plane"> </i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-4">
                <div class="card">
                    <div class="card-body">
                        <div class="widget-card">
                            <div class="media-body">
                                <div class="row mb-3">
                                    <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                                        <img style="width: 130px; height: 70px"
                                            src="{{ asset('assets/images/logo/springer.png') }}" alt="">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 text-center">
                                        <a href="{{ Auth::user()->role_id == 1 ? route('review.springer.index') : route('springer.index') }}"
                                            title="Scraping Springer" class="btn btn-outline-primary" data-bs-placement="bottom">
                                            <small>Springer</small> <i class="fa fa-paper-plane"> </i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- <div class="default-according style-1" id="accordionoc">
            <div class="card">
                <div class="card-header pb-0">
                    <h5 class="mb-0">
                        <button class="btn btn-link text-white bg-primary" data-bs-toggle="collapse"
                            data-bs-target="#data-ieee" aria-expanded="true" aria-controls="collapse11">
                            IEEE
                            #<span>A</span></button>
                    </h5>
                </div>
                <div class="collapse show" id="data-ieee" aria-labelledby="collapseicon" data-bs-parent="#accordionoc">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-2 col-sm-2 col-xs-2 text-center">
                                <img style="width: 90px; height: 60px" src="{{ asset('assets/images/logo/ieee.png') }}"
                                    alt="">
                            </div>
                            <div class="col-md-10">
                                IEEE atau singkatan dari The Institute of Electrical and Electronics
                                Engineers merupakan website penyedia jurnal terbesar. Jurnal-jurnal yang
                                lolos masuk IEEE ini sangat berkualitas sehingga tempat ini adalah tempat
                                paling favorit bagi para penulis jurnal.
                            </div>
                        </div>
                        <a href="{{ Auth::user()->role_id == 1 ? route('review.ieee.index') : route('ieee.index') }}"
                            title="Review IEEE" class="review-go btn-success me-1 mt-1 mb-1">
                            <i class="fa fa-paper-plane"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header pb-0">
                    <h5 class="mb-0">
                        <button class="btn btn-link collapsed text-white bg-primary" data-bs-toggle="collapse"
                            data-bs-target="#data-acm" aria-expanded="false">
                            ACM #<span>B</span></button>
                    </h5>
                </div>
                <div class="collapse" id="data-acm" aria-labelledby="headingeight" data-bs-parent="#accordionoc">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-2 col-sm-2 col-xs-2 text-center">
                                <img style="width: 70px; height: 70px" src="{{ asset('assets/images/logo/acm.png') }}"
                                    alt="">
                            </div>
                            <div class="col-md-10">
                                ACM, singkatan dari Association for Computing Machinery (Asosiasi untuk
                                Permesinan Komputer), adalah sebuah serikat ilmiah dan pendidikan komputer
                                pertama di dunia yang didirikan pada tahun 1947.
                            </div>
                        </div>
                        <a href="{{ Auth::user()->role_id == 1 ? route('review.acm.index') : route('acm.index') }}"
                            title="Review ACM" class="review-go btn-success me-1 mt-1 mb-1">
                            <i class="fa fa-paper-plane"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header pb-0">
                    <h5 class="mb-0">
                        <button class="btn btn-link collapsed text-white bg-primary" data-bs-toggle="collapse"
                            data-bs-target="#data-springer" aria-expanded="false" aria-controls="collapseicon2">Springer
                            #<span>C</span></button>
                    </h5>
                </div>
                <div class="collapse" id="data-springer" data-bs-parent="#accordionoc">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-2 col-sm-2 col-xs-2 text-center">
                                <img style="width: 80px; height: 30px"
                                    src="{{ asset('assets/images/logo/springer.png') }}" alt="">
                            </div>
                            <div class="col-md-10">
                                Springer adalah perusahaan penerbitan global yang menerbitkan buku, buku
                                elektronik, dan jurnal tinjauan sejawat di terbitan-terbitan sains, teknik,
                                dan medis (STM).
                            </div>
                        </div>
                        <a href="{{ Auth::user()->role_id == 1 ? route('review.springer.index') : route('springer.index') }}"
                            title="Review Springer" class="review-go btn-success me-1 mt-1 mb-1">
                            <i class="fa fa-paper-plane"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div> --}}
    </div>
</div>
