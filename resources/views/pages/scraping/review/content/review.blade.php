<div class="page-body">
    <div class="container-fluid default-dash">
        <div class="row">
            @include('layout.breadcrumb')
            <div class="container-fluid product-wrapper">
                <div class="product-grid">
                    @include('pages.scraping.review.content.components.info')
                    <div id="data-review">
                        @include('pages.scraping.review.content.components.data')
                    </div>
                    <div class="container">
                        <div class="row">
                            <div id="loading" style="display: none;" class="text-center my-5 col-sm-12 col-md-12">
                                {{-- <div class="loading-container"> --}}
                                    <div class="loader-box">
                                        <div class="magnifying-glass"><div class="loading"></div></div>
                                    
                                    </div>
                                    {{-- <div class="loading-container">
                                        <div class="loading"></div>
                                    </div> --}}
                                {{-- </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
