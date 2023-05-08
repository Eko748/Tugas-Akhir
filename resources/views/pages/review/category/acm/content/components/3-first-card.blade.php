<div class="col-xl-6 col-sm-6 xl-6">
    <div class="card">
        <div class="product-box">
            <div class="product-img">
                <div class="mt-3">
                    <div class="text-start mb-2">
                        <img class="img-fluid ms-3" style="width:20%; height:20%"
                            src="{{ asset('assets/images/logo/acm.png') }}" alt="">
                    </div>
                    @auth
                        <div class="product-hover">
                            <ul>
                                <li><a data-bs-toggle="modal" onclick="addData()" data-bs-target="#modalView-acm">
                                        <i class="icon-eye"></i></a></li>
                                <li><a data-bs-toggle="modal" onclick="addData()" data-bs-target="#modalCreate-acm">
                                        <i class="icon-plus"></i></a></li>
                            </ul>
                        </div>
                    @endauth
                </div>
            </div>
            @auth
                @include('pages.review.category.acm.content.components.5-modal-create')
                @include('pages.review.category.acm.content.components.6-modal-view')
            @endauth
            <div class="product-details">
                <div class="product-price">
                    <h4 class="show text-primary">{{ $key['title'] }}</h4>
                </div>
                <hr>
                <div class="rating">
                    <strong class="text-primary">
                        Publisher: {{ $key['publisher'] }}
                    </strong>
                </div>
                <div class="rating">
                    <span><b class="text-primary">Publication:</b></span>
                    <p>{{ $key['publication'] }}</p>
                </div>
                <hr>
                <span>
                    <b class="text-primary">Authors:</b>
                </span><br>
                @foreach ($key['authors'] as $author)
                    <span>
                        <small>- {{ $author }}</small>
                    </span><br>
                @endforeach
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
                            <span><small class="text-primary">Type: </small><small>{{ $key['type'] }}</small></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <span><small class="text-primary">Publication Date: </small><small>{{ $key['year'] }}</small></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-3">
                            <span><small class="text-primary">Cited: </small><small>{{ $key['cited'] }}</small></span>
                        </div>
                    </div>
                </div>
                <hr>
                    <a href="{{ $search }}" target="_blank" title="Lihat tautan asli"
                        class="cool text-white btn btn-sm btn-outline-dark btn-danger">
                        <i class="fa fa-paper-plane"></i>
                    </a>
                    @auth
                        <a data-bs-toggle="modal" title="Tambahkan Data Review ke Project" onclick="addData()"
                            data-bs-placement="bottom" data-bs-target="#modalCreate-acm"
                            class="pull-right cool text-white btn btn-sm btn-outline-dark btn-success">
                            <i class="fa fa-plus-circle"></i>
                        </a>
                    @endauth
            </div>
        </div>
    </div>
</div>
