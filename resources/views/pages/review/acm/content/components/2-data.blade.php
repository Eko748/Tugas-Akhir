<div class="product-wrapper-grid">
    <div class="row">
        @if ($search != null)
            <div class="col-xl-3 col-sm-6 xl-4">
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
                                        <li><a data-bs-toggle="modal" href="addData()"
                                                data-bs-target="#modalCreate-acm">
                                                <i class="icon-plus"></i></a></li>
                                        <li><a data-bs-toggle="modal" href="addData()"
                                                data-bs-target="#modalCreate-acm">
                                                <i class="icon-eye"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        @include('pages.review.acm.content.components.3-create-data')
                        {{-- @include('pages.review.ieee.content.components.4-view-data') --}}
                        <div class="product-details">
                            <div class="product-price">
                                <span class="text-primary" id="product-title-full"
                                    style="display:none;">{{ $key['title'] }}</span>
                                <span class="text-primary" id="product-title-short">{{ $key['title'] }}</span>
                                {{-- <a href="javascript:void(0)" id="read-more-link"
                                        onclick="showFullTitle('')"><small><i
                                                class="fa fa-chevron-circle-right"></i></small></a>
                                    <a href="javascript:void(0)" id="read-less-link"
                                        onclick="hideFullTitle('')"
                                        style="display:none;"><small><i
                                                class="fa fa-chevron-circle-left"></i></small></a> --}}
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
            </center>
        @endif
    </div>
</div>
