<div class="product-wrapper-grid">
    <div class="row">
        @if (isset($search))
            <div class="col-xl-6 col-sm-9 xl-7">
                <div class="card">
                    <div class="product-box">
                        <div class="product-img">
                            <div class="mt-3">
                                <div class="text-start mb-2">
                                    <img class="img-fluid ms-3" style="width: 100%;"
                                        src="https://www.acm.org/binaries/content/gallery/global/top-menu/acm_logo_tablet.svg"
                                        alt="">
                                </div>
                                {{-- <p class="ms-3"><small class="text-dark"></small></p> --}}
                                <div class="product-hover">
                                    <ul>
                                        <li><a data-bs-toggle="modal" onclick="addData()"
                                                data-bs-target="#modalCreate-acm">
                                                <i class="icon-plus"></i></a></li>
                                        <li><a data-bs-toggle="modal" href="addData()"
                                                data-bs-target="#modalCreate-acm">
                                                <i class="icon-eye"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        @include('pages.review.category.acm.content.components.3-modal-create')
                        <div class="product-details">
                            <div class="product-price">
                                <span class="show text-primary" style="display:none;">{{ $key['title'] }}</span>
                                <span class="hide text-primary">{{ Str::words($key['title'], 5, '...') }}</span>
                                <a href="javascript:void(0)" class="read-more" onclick="showFullTitle()"><small><i
                                            class="fa fa-chevron-circle-right"></i></small></a>
                                <a href="javascript:void(0)" class="read-less" onclick="hideFullTitle()"
                                    style="display:none;"><small><i class="fa fa-chevron-circle-left"></i></small></a>
                            </div>
                            <hr>
                            <div class="rating">
                                <strong class="text-dark">
                                    Publisher: {{ $key['publisher'] }}
                                </strong>
                                <br>
                                <strong>
                                    <p>{{ $key['publication'] }}</p>
                                </strong>
                            </div>
                            <span>
                                Abstract:
                            </span>
                            <br>
                            <p class="show" style="display:none;">
                                {{ $key['abstract'] }}
                            </p>
                            <p class="hide">
                                {{ Str::words($key['abstract'], 10, '...') }}
                            </p>
                            <a href="javascript:void(0)" class="read-more" onclick="showFullAbstract()">
                                <small><i class="fa fa-chevron-circle-right"></i></small></a>
                            <a href="javascript:void(0)" class="read-less" onclick="hideFullAbstract()"
                                style="display:none;"><small><i class="fa fa-chevron-circle-left"></i></small></a>
                            <br>
                            <span>
                                <b>Authors:</b>
                            </span>
                            @foreach ($key['authors'] as $author)
                                <p>
                                    - {{ $author }}
                                </p>
                            @endforeach
                            <hr>
                            <div class="product-price mb-2">
                                Type: {{ $key['type'] }}
                                <p class="pull-right">Date: {{ $key['year'] }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <center>
                <img id="img-scrap" class="text-center img-fluid" src="{{ asset('images/Search-Scraping.png') }}"
                    style="width:300px" alt="">
                    <p>Klik untuk beralih ke halaman <a href="https://dl.acm.org/doi/10.1145/2018567.2018569"><b class="text-primary"><u>ACM Digital Library</u></b></a></p>
            </center>
        @endif
    </div>
</div>
