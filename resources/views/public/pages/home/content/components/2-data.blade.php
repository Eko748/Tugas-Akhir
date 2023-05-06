<div class="product-wrapper-grid mb-5">
    <div class="row ms-1 me-1">
        @if (isset($search))
            @include('public.pages.home.content.components.3-first-card')
            @include('public.pages.home.content.components.4-second-card')
        @else
            <center>
                <img id="img-scrap" class="text-center img-fluid" src="{{ asset('images/Search-Scraping.png') }}"
                    style="width:300px" alt="">
            </center>
        @endif
    </div>
</div>