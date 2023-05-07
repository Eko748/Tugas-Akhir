<div class="col-xl-6 col-sm-6 xl-6">
    <div class="card">
        <div class="product-box">
            <div class="product-img mb-2">
                <div class="text-start">
                    <div class="row">
                        <div class="col-md-2 col-sm-2 col-xs-1">
                            <img class="img-fluid" style="width: 100px;"
                                src="https://brand-experience.ieee.org/favicon-32x32.png" alt="">
                        </div>
                        <div class="col-md-8 ms-2 me-1 col-sm-9 col-xs-4">
                            <div class="product-price mt-2">
                                <span>
                                    No. {{ $key['article_number'] }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="product-hover">
                    <ul>
                        <li>
                            <a data-bs-toggle="modal" title="Lihat Detail"
                                data-bs-target="#modalView-{{ $key['article_number'] }}">
                                <i class="icon-eye"></i>
                            </a>
                        </li>
                        <li>
                            <a data-bs-toggle="modal" title="Tambahkan Data Review ke Project" onclick="addData()"
                                data-bs-placement="bottom" data-bs-target="#modalCreate-{{ $key['article_number'] }}">
                                <i class="icon-plus"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            @include('pages.review.category.ieee.content.components.5-modal-create')
            @include('pages.review.category.ieee.content.components.6-modal-view')
            <div class="product-details">
                <div class="product-price">
                    {{ $key['title'] }}
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
                    <b class="text-primary">Authors:</b>
                </span>
                @if (isset($cek))
                    @foreach ($cek as $name => $value)
                        @if ($value['full_name'] == [])
                            <p>
                                <span>Tidak tercatat!</span>
                            </p>
                        @else
                            <p>
                                - {{ $value['full_name'] }}
                            </p>
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
                    <a href="javascript:void(0)" class="read-more" onclick="showFullAbstract()">
                        <small><i class="fa fa-chevron-circle-right"></i></small></a>
                    <a href="javascript:void(0)" class="read-less" onclick="hideFullAbstract()"
                        style="display:none;"><small><i class="fa fa-chevron-circle-left"></i></small></a>
                    <br>
                </div>
                <hr>
                <div class="product-price mb-2">
                    {{ $key['content_type'] }}: {{ $key['publication_year'] }}
                    <p class="pull-right text-primary">Cited: {{ $key['citing_paper_count'] }}</p>
                </div>
                <a href="{{ $key['pdf_url'] }}" target="_blank" title="Lihat tautan asli"
                    class="cool text-white btn btn-sm btn-outline-dark btn-danger">
                    <i class="fa fa-paper-plane"></i>
                </a>
                <a data-bs-toggle="modal" title="Tambahkan Data Review ke Project" onclick="addData()"
                    data-bs-placement="bottom" data-bs-target="#modalCreate-{{ $key['article_number'] }}"
                    class="pull-right cool text-white btn btn-sm btn-outline-dark btn-success">
                    <i class="fa fa-plus-circle"></i>
                </a>
            </div>
        </div>
    </div>
</div>
