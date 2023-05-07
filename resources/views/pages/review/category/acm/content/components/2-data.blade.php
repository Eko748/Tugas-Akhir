<div class="product-wrapper-grid">
    <div class="row ms-1 me-1">
        @if (isset($search))
            @include('pages.review.category.acm.content.components.3-first-card')
            @include('pages.review.category.acm.content.components.4-second-card')
        @else
            <center>
                <img id="img-scrap" class="text-center img-fluid" src="{{ asset('images/Search-Scraping.png') }}"
                    style="width:300px" alt="">
                <p>Klik untuk beralih ke halaman <a target="_blank" href="https://dl.acm.org/doi/10.1145/2018567.2018569"><b
                            class="text-primary"><u>ACM Digital Library</u></b></a></p>
            </center>
        @endif
    </div>
</div>
