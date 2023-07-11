<div class="product-wrapper-grid mb-3">
    <div class="row ms-1 me-1">
        @if (isset($search))
            @foreach ($path as $key)
                @if (isset($key))
                    @include('pages.review.category.ieee.content.components.3-first-card')
                    @include('pages.review.category.ieee.content.components.4-second-card')
                @endif
            @endforeach
        @else
            <center>
                @if (isset($error))
                    <div class="col-md-6 col-lg-6 alert alert-danger inverse alert-dismissible fade show mb-3"
                        role="alert"><i class="icon-alert"></i>
                        <span>{{ $error }}</span>
                        <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <img id="img-scrap" class="text-center img-fluid" src="{{ asset('images/Search-Scraping.png') }}"
                        style="width:300px" alt="">
                    <p>Klik untuk beralih ke halaman
                        <a target="_blank" href="https://ieeexplore.ieee.org/document/6606614">
                            <b class="text-primary">
                                <u>IEEE Xplore</u>
                            </b>
                        </a>
                    </p>
                @else
                    <img id="img-scrap" class="text-center img-fluid" src="{{ asset('images/Search-Scraping.png') }}"
                        style="width:300px" alt="">
                    <p>Klik untuk beralih ke halaman
                        <a target="_blank" href="https://ieeexplore.ieee.org/document/6606614">
                            <b class="text-primary">
                                <u>IEEE Xplore</u>
                            </b>
                        </a>
                    </p>
                @endif
            </center>
        @endif
    </div>
</div>
