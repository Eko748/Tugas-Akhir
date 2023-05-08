@guest
    <section class="demo-section section-py-space" id="demo">
        <div class="title">
            <h1>Demo</h1>
        </div>
        <div class="custom-container">
            <div class="row demo-block">
                <div class="demo-box">
                    <div class="mt-3 mb-3 container-fluid product-wrapper col-md-12">
                        <div class="product-grid">
                            <div class="row text-center mb-2">
                                <strong class="ms-3 mb-3">
                                    <i class="fa fa-info-circle fa-3x hovering" title="Uji coba Review hanya berlaku pada format URL ACM"></i>
                                </strong>
                            </div>
                            @include('public.pages.home.components.1-menu')
                            <div id="data-review" class="mt-3">
                                @include('public.pages.home.components.2-data')
                            </div>
                            @include('pages.review.components.1-load')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endguest
