<div class="col-xl-6 col-sm-6 xl-6">
    <div class="card">
        <div class="product-box">
            <div class="product-img">
                <div class="mt-3">
                    <div class="text-start mb-2">
                        <img class="img-fluid" style="width: 80px; height: 30px"
                                    src="{{ asset('assets/images/logo/springer.png') }}" alt="">
                    </div>
                    <p class="ms-3 ps-3"><small class="text-dark">{{ $key['identifier'] }}</small></p>
                    <div class="product-hover">
                        <ul>
                            <li><a title="Review Project"
                                data-bs-toggle="modal" onclick="addData()"
                                    data-bs-target="#modalCreate-{{ str_replace([':', '.', '/', '-'], '', $key['identifier']) }}">
                                    <i class="icon-plus"></i></a></li>
                            <li><a data-bs-toggle="modal" data-bs-target="#modalView-{{ $key['identifier'] }}"><i
                                        class="icon-eye"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            @include('pages.review.category.springer.content.components.5-modal-create')
            {{-- @include('pages.review.ieee.content.components.4-view-data') --}}
            <div class="product-details">
                <div class="product-price">
                    <h4 class="text-primary" id="product-title-full-{{ $key['identifier'] }}">{{ $key['title'] }}</h4>
                </div>
                <hr>
                <div class="rating">
                    <strong class="text-primary">
                        Publisher: {{ $key['publisher'] }}
                    </strong>
                </div>
                <div class="rating">
                    <span><b class="text-primary">Publication:</b></span>
                    <p>{{ $key['publicationName'] }}</p>
                </div>
                <hr>
                <span>
                    <b class="text-primary">Authors:</b>
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
                <div class="rating">
                    <span>
                        <b class="text-primary">Abstract:</b>
                    </span>
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
                </div>
                <hr>
                <div class="product-price mb-2">
                    Type: {{ $key['publicationType'] }}
                    <p class="pull-right">Date: {{ $key['publicationDate'] }}</p>
                </div>
                <a href="{{ $key['url'][0]['value'] }}" class="btn btn-sm btn-outline-dark btn-danger">
                    <i class="fa fa-file-pdf-o"></i>
                </a>
            </div>
        </div>
    </div>
</div>
