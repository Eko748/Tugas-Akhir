<div class="product-wrapper-grid">
    <div class="row">
        @if (isset($search))
            @foreach ($path as $key)
                <div class="col-xl-3 col-sm-6 xl-4">
                    <div class="card">
                        <div class="product-box">
                            <div class="product-img">
                                <div class="text-start">
                                    <img class="img-fluid" style="width: 100px;"
                                        src="https://brand-experience.ieee.org/favicon-32x32.png" alt="">
                                </div>
                                <p><small>No. {{ $key['article_number'] }}</small></p>
                                <div class="product-hover">
                                    <ul>
                                        <li><a data-bs-toggle="modal" onclick="addData()"
                                                data-bs-target="#modalCreate-{{ $key['article_number'] }}"><i
                                                    class="icon-plus"></i></a></li>
                                        <li><a data-bs-toggle="modal"
                                                data-bs-target="#modalView-{{ $key['article_number'] }}"><i
                                                    class="icon-eye"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            @include('pages.review.category.ieee.content.components.3-modal-create')
                            @include('pages.review.category.ieee.content.components.4-modal-view')
                            <div class="product-details">
                                <div class="product-price">
                                    {{ $key['title'] }}
                                </div>
                                <hr>
                                <div class="rating">
                                    <b>
                                        Publisher: {{ $key['publisher'] }}
                                    </b>
                                    <strong>
                                        <p>{{ $key['publication_title'] }}</p>
                                    </strong>
                                </div>
                                <span>
                                    @php
                                        $cek = [];
                                        foreach ($key['authors'] as $author) {
                                            foreach ($author as $a) {
                                                $cek[] = $a;
                                            }
                                        }
                                    @endphp
                                    <b>Authors:</b>
                                </span>
                                @foreach ($cek as $name => $value)
                                    @if ($value['full_name'] == [])
                                        <p>
                                            <b>Tidak tercatat!</b>
                                        </p>
                                    @else
                                        <p>
                                            - {{ $value['full_name'] }}
                                        </p>
                                    @endif
                                @endforeach
                                <hr>
                                <div class="product-price mb-2">
                                    {{ $key['content_type'] }}: {{ $key['publication_year'] }}
                                    <p class="pull-right">Cited: {{ $key['citing_paper_count'] }}</p>
                                </div>
                                <a href="{{ $key['pdf_url'] }}" class="btn btn-sm btn-outline-dark btn-danger">
                                    <i class="fa fa-file-pdf-o"></i>
                                </a>
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
