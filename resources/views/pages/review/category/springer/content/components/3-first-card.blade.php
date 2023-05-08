<div class="col-xl-6 col-sm-6 xl-6">
    <div class="card">
        <div class="product-box">
            <div class="product-img">
                <div class="mt-3">
                    <div class="text-start ms-1 mb-2">
                        <img class="img-fluid" style="width: 90px; height: 30px"
                            src="{{ asset('assets/images/logo/springer.png') }}" alt="">
                    </div>
                    <p class="ms-3 ps-3"><small class="text-dark">{{ $key['identifier'] }}</small></p>
                    <div class="product-hover">
                        <ul>
                            <li><a data-bs-toggle="modal" data-bs-target="#modalView-springer"><i
                                        class="icon-eye"></i></a></li>
                            <li><a title="Review Project" data-bs-toggle="modal" onclick="addData()"
                                    data-bs-target="#modalCreate-{{ str_replace([':', '.', '/', '-'], '', $key['identifier']) }}">
                                    <i class="icon-plus"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            @include('pages.review.category.springer.content.components.5-modal-create')
            @include('pages.review.category.springer.content.components.6-modal-view')
            <div class="product-details">
                <div class="product-price">
                    <h4 class="show text-primary" id="product-title-full-{{ $key['identifier'] }}">{{ $key['title'] }}
                    </h4>
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
                    <div class="row">
                        <div class="col-md-6 col-sm-3">
                            <span><small class="text-primary">Type:
                                </small><small>{{ $key['publicationType'] }}</small></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <span><small class="text-primary">Publication Date:
                                </small><small>{{ $key['publicationDate'] }}</small></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-3">
                            <span><small class="text-primary">Cited: </small><small>0</small></span>
                        </div>
                    </div>
                </div>
                <hr>
                <a href="{{ $key['url'][0]['value'] }}" target="_blank" title="Lihat tautan asli"
                    class="cool text-white btn btn-sm btn-outline-dark btn-danger">
                    <i class="fa fa-paper-plane"></i>
                </a>
                @auth
                    <div class="pull-right col-md-6 col-sm-6">
                        <a data-bs-toggle="modal" title="Tambahkan Data Review ke Project" onclick="addData()"
                            data-bs-placement="bottom"
                            data-bs-target="#modalCreate-{{ str_replace([':', '.', '/', '-'], '', $key['identifier']) }}"
                            class="pull-right cool text-white btn btn-sm btn-outline-dark btn-success">
                            <i class="fa fa-plus-circle"></i>
                        </a>
                    </div>
                @endauth
            </div>
        </div>
    </div>
</div>
