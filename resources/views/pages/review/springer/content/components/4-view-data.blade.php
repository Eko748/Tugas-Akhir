<div class="container-fluid modal fade" id="modalView-{{ $key['article_number'] }}">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <div class="product-box row">
                    <div class="product-img col-lg-1"><img class="img-fluid"
                            src="https://brand-experience.ieee.org/favicon-32x32.png" alt=""></div>
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
                            <span>Publication: {{ $key['publication_date'] }}</span>
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
                                $text = $crawler->filterXPath('//body/text()[1]')->text();
                                $text = $crawler->filter('body')->text();
                                
                                // menghapus karakter \n dan \r
                                $text = str_replace(["\r", "\n"], '', $text);
                                
                                // memisahkan teks ke dalam array yang terpisah per item
                                $items = preg_split('/(?<=\d\.)/', $text);
                                
                                // membersihkan setiap item dari spasi di awal dan akhir, dan menghapus baris kosong
                                foreach ($items as $key => $value) {
                                    $value = trim($value);
                                    if (empty($value)) {
                                        unset($items[$key]);
                                    } else {
                                        $items[$key] = $value;
                                    }
                                }
                            @endphp
                            <span>
                                <small>
                                    @foreach($items as $item)
                                        {{ $item }}
                                    @endforeach
                                </small>
                            </span>
                        </div>
                    </div>
                    <div class="col-lg-1">

                    </div>
                </div>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
        </div>
    </div>
</div>
