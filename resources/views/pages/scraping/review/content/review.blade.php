<div class="page-body">
    <div class="container-fluid">
        <div class="row">
            @include('layout.breadcrumb')
        </div>
    </div>
    <div class="container-fluid product-wrapper">
        <div class="product-grid">
            @include('pages.scraping.review.content.components.1-menu')
            <div id="data-review">
                @include('pages.scraping.review.content.components.2-data')
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            @include('pages.scraping.review.content.components.3-load')
        </div>
    </div>

</div>
