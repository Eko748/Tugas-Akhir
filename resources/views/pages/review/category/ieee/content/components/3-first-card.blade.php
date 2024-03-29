<div class="col-xl-6 col-sm-6 xl-6">
    <div class="card">
        <div class="product-box">
            <div class="product-img mb-2">
                <div class="text-start">
                    <div class="row mt-3">
                        <div class="col-md-3 col-sm-3 col-xs-3">
                            <img class="img-fluid" style="width: 120px; height: 60px"
                                src="{{ asset('assets/images/logo/ieee.png') }}" alt="">
                        </div>
                    </div>
                </div>
                <div class="product-hover">
                    <ul>
                        <li class="mb-3">
                            <a data-bs-toggle="modal" title="Lihat Detail"
                                data-bs-target="#modalView-{{ $key['article_number'] }}">
                                <i class="icon-eye"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            @include('pages.review.category.ieee.content.components.5-modal-create')
            @include('pages.review.category.ieee.content.components.6-modal-view')
            <div class="product-details">
                <div class="product-price">
                    <h4 class="text-primary">{{ $key['title'] }}</h4>
                </div>
                <hr>
                <div class="rating">
                    <span>
                        <b class="text-primary">
                            Publisher: {{ $key['publisher'] }}
                        </b>
                    </span>
                </div>
                <div class="rating">
                    <span><b class="text-primary">Publication:</b></span>
                    <p>{{ $key['publication_title'] }}</p>
                </div>
                <hr>
                <span>
                    @php
                        $cek = [];
                        foreach ($key['authors'] as $author) {
                            foreach ($author as $a) {
                                $cek[] = $a;
                            }
                        }
                    @endphp
                    <b class="text-primary">Authors:</b><br>
                </span>
                @if (isset($cek))
                    @foreach ($cek as $name => $value)
                        @if ($value['full_name'] == [])
                            <p>
                                <span>Tidak tercatat!</span>
                            </p>
                        @else
                            <span>
                                <small>- {{ $value['full_name'] }}</small><br>
                            </span>
                        @endif
                    @endforeach
                @endif
                <hr>
                <div class="rating">
                    <span><b class="text-primary">Abstract:</b></span>
                    <p class="show" style="display:none;">
                        {{ $key['abstract'] }}
                    </p>
                    <p class="hide">
                        {{ Str::words($key['abstract'], 10, '...') }}
                    </p>
                    <a href="#more-abstract" class="read-more" onclick="showFullAbstract()">
                        <small><i class="fa fa-chevron-circle-right"></i></small></a>
                    <a href="#less-abstract" class="read-less" onclick="hideFullAbstract()"
                        style="display:none;"><small><i class="fa fa-chevron-circle-left"></i></small></a>
                    <br>
                </div>
                <hr>
                <div class="product-price mb-2">
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <span><small class="text-primary">Type:
                                </small><small>{{ $key['content_type'] }}</small></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <span><small class="text-primary">Publication Date:
                                </small><small>{{ $key['publication_year'] }}</small></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <span><small class="text-primary">Cited:
                                </small><small>{{ $key['citing_paper_count'] }}</small></span>
                        </div>
                    </div>
                </div>
                <hr>
                @if ($exist->contains($key['title']))
                    <div class="text-center">
                        <p><strong><i>Data Sudah Ditambahkan</i></strong> </p>
                    </div>
                @else
                    <div class="text-center">
                        <a data-bs-toggle="modal" title="Tambahkan Data Scraping ke Database" onclick="addData()"
                            data-bs-placement="bottom" data-bs-target="#modalCreate-{{ $key['article_number'] }}"
                            class="c-data text-center mb-3 review-go text-white btn btn-sm btn-outline-dark btn-success">
                            <i class="fa fa-plus-circle"></i> Tambahkan ke Database
                        </a>
                    </div>
                    <a data-bs-toggle="modal" onclick="addData()" href="#create"
                        data-bs-target="#modalCreate-{{ $key['article_number'] }}"
                        title="Tambahkan Data Scraping ke Database" class="c-data float">+</a>
                @endif
            </div>
        </div>
    </div>
</div>
