<div class="modal fade" id="modalView-springer">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-dark" id="title-review"><i class="fa fa-folder-open"></i> <strong>Detail Review</strong></h5>
                <button class="btn-close text-dark btn-outline-danger" type="button" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="product-box row">
                    <div class="product-img col-lg-1">
                        <img class="img-fluid" style="width: 80px; height: 30px"
                            src="{{ asset('assets/images/logo/springer.png') }}" alt="">
                    </div>
                    <div class="product-details col-lg-10 text-justify"><a href="product-page.html">
                            <h4>Publisher: {{ $key['publisher'] }}</h4>
                        </a>
                        <div class="product-price">
                            <span>Type: {{ $key['publicationType'] }}</span>
                            {{-- <p class="pull-right">
                                Cited: {{ $key['cited'] }}
                            </p> --}}
                        </div>
                        <div class="product-price">
                            <span>Publication Title: {{ $key['publicationName'] }}</span>
                        </div>
                        <div class="product-price">
                            <span>Publication Date: {{ $key['publicationDate'] }}</span>
                        </div>
                        <div class="product-view mb-2">
                            <div class="product-price">
                                <h2>{{ $key['title'] }}</h2>
                            </div>
                            <span>
                                <b class="f-w-600">Abstract:</b>
                            </span>
                            <p class="mb-0">
                                @if ($key['abstract'] == null)
                                    Tidak Dicantumnkan
                                @else
                                    {{ $key['abstract'] }}
                                @endif
                            </p>
                        </div>
                        <div class="col-xl-4 col-sm-4 xl-4 mb-1">
                            <b>
                                <span>Keywords:</span>
                            </b>
                        </div>
                        <div class="row mb-3">
                            @if ($key['keyword'] == null)
                                <span>Tidak Ada</span>
                            @else
                                @foreach ($key['keyword'] as $keywords)
                                    <div class="col-xl-1 col-sm-0 xl-1">
                                    </div>
                                    <div class="col-xl-5 col-sm-8 xl-6 mb-2">
                                        <span class="btn btn-outline-primary">
                                            <span>
                                                {{ $keywords }}
                                            </span>
                                        </span>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        {{-- <div class="product-view row mb-3">
                            <div class="">
                                <span><b>References:</b></span>
                            </div>
                            @if (isset($key['references']))
                                @php
                                    $no = 1;
                                @endphp
                                <span>
                                    <small>
                                        @foreach ($key['references'] as $references)
                                            <div class="row">
                                                <div class="col-md-1" style="text-align: center;">
                                                    <p class="text-justify pull-right">
                                                        {{ $no++ }}.
                                                    </p>
                                                </div>
                                                <div class="col-md-11">
                                                    <p class="text-justify">
                                                        {{ $references }}
                                                    </p>
                                                </div>
                                            </div>
                                        @endforeach
                                    </small>
                                </span>
                            @endif
                        </div> --}}
                    </div>
                    <div class="col-lg-1">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
