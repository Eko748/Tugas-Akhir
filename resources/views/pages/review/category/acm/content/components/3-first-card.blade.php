<div class="col-xl-6 col-sm-6 xl-6">
    <div class="card">
        <div class="product-box">
            <div class="product-img">
                <div class="mt-3">
                    <div class="text-start mb-2">
                        <img class="img-fluid ms-3" style="width:50%"
                            src="https://www.acm.org/binaries/content/gallery/global/top-menu/acm_logo_tablet.svg"
                            alt="">
                    </div>
                    {{-- <p class="ms-3"><small class="text-dark"></small></p> --}}
                    <div class="product-hover">
                        <ul>
                            <li><a data-bs-toggle="modal" onclick="addData()" data-bs-target="#modalCreate-acm">
                                    <i class="icon-plus"></i></a></li>
                            <li><a data-bs-toggle="modal" onclick="addData()" data-bs-target="#modalCreate-acm">
                                    <i class="icon-eye"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            @include('pages.review.category.acm.content.components.5-modal-create')
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
                </span>
                @foreach ($key['authors'] as $author)
                    <p>
                        - {{ $author }}
                    </p>
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
                <div class="product-price mb-2">
                    Type: {{ $key['type'] }}
                    <p class="pull-right">Date: {{ $key['year'] }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
