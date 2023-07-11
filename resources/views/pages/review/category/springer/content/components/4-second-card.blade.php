<div class="col-xl-6 col-sm-6 xl-6">
    <div class="card">
        <div class="product-box">
            <div class="product-details">
                <div class="product-price">
                    <div class="col-xl-4 col-sm-4 xl-4 mb-1">
                        <span>
                            <b class="text-primary">Keywords:</b>
                        </span>
                    </div>
                    <div class="row mb-3">
                        @if ($key['keyword'] == null)
                            <span>Tidak Ada</span>
                        @else
                            @foreach ($key['keyword'] as $keywords)
                                <div class="col-xl-4 col-sm-7 xl-5 mb-2">
                                    <span class="btn text-left btn-xs btn-outline-primary">
                                        <span>
                                            {{ $keywords }}
                                        </span>
                                    </span>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
                <hr>
                <div class="rating">
                    <div class="product-view row mb-3">
                        <div class="">
                            <span><b class="text-primary">References:</b></span>
                        </div>
                        @php
                            use Symfony\Component\DomCrawler\Crawler;
                            
                            $ref = $key['url'][0]['value'];
                            $response = $client->request('GET', $ref);
                            $html = (string) $response->getBody();
                            $crawler = new Crawler($html);
                            $counter = 0;
                            $items = $crawler->evaluate('//p[@class="c-article-references__text"]')->each(function ($node) use (&$counter) {
                                return $node->text();
                            });
                        @endphp
                        <div class="row">
                            <div class="col-12">
                                <span>
                                    <small>
                                        @php
                                            $limited_items = '';
                                            $remaining_items = '';
                                            $show_all_items = false;
                                        @endphp
                                        @foreach ($items as $key => $item)
                                            @if ($counter < 5)
                                                <div class="row">
                                                    <div class="col-md-2 col-xl-2 col-lg-2 col-sm-2 text-justify" style="text-align: center;">
                                                        <p class="text-justify">
                                                            {{ ++$counter }}.
                                                        </p>
                                                    </div>
                                                    <div class="col-md-10 col-xl-10 col-lg-10 col-sm-10">
                                                        <p class="text-justify">
                                                            {{ $item }}<br>
                                                        </p>
                                                    </div>
                                                </div>
                                            @else
                                                @php
                                                    $remaining_items .=
                                                        '<div class="row">' .
                                                        '<div class="col-md-2 col-xl-2 col-lg-2 col-sm-2" style="text-align: center;">
                                                        ' .
                                                        '<p class="text-justify">' .
                                                        ++$counter . '.' .
                                                        '</p>' .
                                                        '</div>
                                                        ' .
                                                        '<div class="col-md-10 col-xl-10 col-lg-10 col-sm-10">' .
                                                        '<p class="text-justify">' .
                                                        $item .
                                                        '</p>' .
                                                        '</div>' .
                                                        '</div>';
                                                @endphp
                                            @endif
                                        @endforeach
                                        @if ($remaining_items != '')
                                            <a class="ms-3" onclick="toggleItems()" id="read-more"><i
                                                    class="fa fa-chevron-circle-right"></i></a>
                                        @endif

                                        <div class="all-items d-none">
                                            {!! $limited_items !!}
                                            {!! $remaining_items !!}
                                        </div>
                                        <a class="ms-3 d-none" onclick="toggleItems()" id="read-less"><i
                                                class="fa fa-chevron-circle-left"></i></a>

                                    </small>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
