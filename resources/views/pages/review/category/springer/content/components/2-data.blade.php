<div class="product-wrapper-grid">
    <div class="row">
        @if ($search != null)
            @foreach ($path as $key)
                <div class="col-xl-3 col-sm-6 xl-4">
                    <div class="card">
                        <div class="product-box">
                            <div class="product-img">
                                <div class="mt-3">
                                    <div class="text-start mb-2">
                                        <img class="img-fluid ms-3" style="width: 100%;"
                                            src="https://link.springer.com/static/0ec8b27393b8fa28d3a17e3ebe39646d1d6540e9/sites/link/images/logo_high_res.png"
                                            alt="">
                                    </div>
                                    <p class="ms-3"><small class="text-dark">{{ $key['identifier'] }}</small></p>
                                    <div class="product-hover">
                                        <ul>
                                            <li><a data-bs-toggle="modal" onclick="addData()"
                                                    data-bs-target="#modalCreate-{{ str_replace([':', '.', '/', '-'], '', $key['identifier']) }}">
                                                    <i class="icon-plus"></i></a></li>
                                            <li><a data-bs-toggle="modal"
                                                    data-bs-target="#modalView-{{ $key['identifier'] }}"><i
                                                        class="icon-eye"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            @include('pages.review.category.springer.content.components.3-modal-create')
                            {{-- @include('pages.review.ieee.content.components.4-view-data') --}}
                            <div class="product-details">
                                <div class="product-price">
                                    <span class="text-primary" id="product-title-full-{{ $key['identifier'] }}"
                                        style="display:none;">{{ $key['title'] }}</span>
                                    <span class="text-primary"
                                        id="product-title-short-{{ $key['identifier'] }}">{{ Str::words($key['title'], 5, '...') }}</span>
                                    <a href="javascript:void(0)" id="read-more-link-{{ $key['identifier'] }}"
                                        onclick="showFullTitle('{{ $key['identifier'] }}')"><small><i
                                                class="fa fa-chevron-circle-right"></i></small></a>
                                    <a href="javascript:void(0)" id="read-less-link-{{ $key['identifier'] }}"
                                        onclick="hideFullTitle('{{ $key['identifier'] }}')"
                                        style="display:none;"><small><i
                                                class="fa fa-chevron-circle-left"></i></small></a>
                                </div>
                                <hr>
                                <div class="rating">
                                    <strong class="text-dark">
                                        Publisher: {{ $key['publisher'] }}
                                    </strong>
                                    <br>
                                    <strong>
                                        <p>{{ $key['publicationName'] }}</p>
                                    </strong>
                                    <strong>
                                        <p>{{ $key['url'][0]['value'] }}</p>
                                    </strong>
                                </div>
                                <span>
                                    <b>Authors:</b>
                                </span>
                                @if (isset($key['creators']))
                                    @foreach ($key['creators'] as $value)
                                        <p>
                                            - {{ $value['creator'] }}
                                        </p>
                                    @endforeach
                                @else
                                    <p>
                                        - Tidak dicantumkan
                                    </p>
                                @endif
                                <hr>
                                <div class="product-price mb-2">
                                    Type: {{ $key['publicationType'] }}
                                    <p class="pull-right">Date: {{ $key['publicationDate'] }}</p>
                                </div>
                                {{-- <a href="{{ $key['pdf_url'] }}" class="btn btn-sm btn-outline-dark btn-danger">
                                    <i class="fa fa-file-pdf-o"></i>
                                </a> --}}
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <center>
                <img id="img-scrap" class="text-center img-fluid" src="{{ asset('images/Search-Scraping.png') }}"
                    style="width:300px" alt="">
            </center>
        @endif
    </div>
</div>
