<div class="product-wrapper-grid">
    <div class="row ms-1 me-1">
        @if (isset($search))
            @foreach ($path as $key)
                @include('pages.review.category.springer.content.components.3-first-card')
                @include('pages.review.category.springer.content.components.4-second-card')
            @endforeach
        @else
            <center>
                <img id="img-scrap" class="text-center img-fluid" src="{{ asset('images/Search-Scraping.png') }}"
                    style="width:300px" alt="">
                <p>Klik untuk beralih ke halaman <a
                        href="https://link.springer.com/article/10.1007/s10118-023-2956-9"><b
                            class="text-primary"><u>Springer Link</u></b></a></p>
            </center>
        @endif
    </div>
</div>