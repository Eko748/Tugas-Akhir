<div class="container-fluid modal fade modalView" data-key="{{ $key['article_number'] }}"
    id="modalView-{{ $key['article_number'] }}">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="product-box row">
                    <div class="product-img col-lg-1">
                        <img class="img-fluid" style="width: 90px; height: 60px"
                            src="{{ asset('assets/images/logo/ieee.png') }}" alt="">
                    </div>
                    <div class="product-details col-lg-10 text-justify"><a href="product-page.html">
                            <h4>Publisher: {{ $key['publisher'] }}</h4>
                        </a>
                        <div class="product-price">
                            <span>Type: {{ $key['content_type'] }}</span>
                            <p class="pull-right">
                                Cited: {{ $key['citing_paper_count'] }}
                            </p>
                        </div>
                        <div class="product-price">
                            <span>Publication Title: {{ $key['publication_title'] }}</span>
                        </div>
                        <div class="product-price">
                            @if (array_key_exists('publication_date', $key))
                                <span>Publication Date: {{ $key['publication_date'] }}</span>
                            @else
                                <span>Tidak ada</span>
                            @endif
                        </div>
                        <hr>
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
                        @php
                            $a = [];
                            foreach ($key['index_terms'] as $keyword) {
                                $a = $keyword['terms'];
                            }
                        @endphp
                        <div class="col-xl-4 col-sm-4 xl-4 mb-1">
                            <b>
                                <span>Keywords:</span>
                            </b>
                        </div>
                        <div class="row mb-3">
                            @if ($a == null)
                                <span>Tidak Ada</span>
                            @else
                                @foreach ($a as $keywords)
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
                        <div class="product-view row mb-3">
                            <div class="">
                                <span><b>References:</b></span>
                            </div>
                            @php
                                $crawler = $client->request('GET', $references . $key['article_number']);
                                $text = $crawler->filter('body')->text();
                                $items = preg_split('/\s+\d+\.\s(?=[a-zA-Z])/u', $text);
                                foreach ($items as $key => $value) {
                                    $value = trim($value);
                                    if (empty($value)) {
                                        unset($items[$key]);
                                    } else {
                                        $items[$key] = $value;
                                    }
                                }
                            @endphp
                            <div class="row">
                                <div class="col-12">
                                    <span>
                                        <small>
                                            @php
                                                $counter = 0;
                                            @endphp
                                            @foreach ($items as $key => $item)
                                                <div class="row">
                                                    @if ($key == 0)
                                                        <div class="col-md-1 text-justify" style="text-align: center;">
                                                            <p class="text-justify pull-right">
                                                                {{ ++$counter }}.
                                                            </p>
                                                        </div>
                                                        <div class="col-md-11">
                                                            <p class="text-justify">
                                                                {{ preg_replace('/\d+\.\s/', '', $item) }}<br>
                                                            </p>
                                                        </div>
                                                    @else
                                                        <div class="col-md-1" style="text-align: center;">
                                                            <p class="text-justify pull-right">
                                                                {{ ++$counter }}.
                                                            </p>
                                                        </div>
                                                        <div class="col-md-11">
                                                            <p class="text-justify">
                                                                {{ preg_replace('/\s+(\d+\.\s)(?=[a-zA-Z])/', "<br class='mb-2'>\$1", trim(preg_replace('/1\. /', '', $item))) }}<br>
                                                            </p>
                                                        </div>
                                                    @endif
                                                </div>
                                            @endforeach
                                        </small>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-1">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>
