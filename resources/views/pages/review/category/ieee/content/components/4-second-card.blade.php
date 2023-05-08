<div class="col-xl-6 col-sm-6 xl-6">
    <div class="card">
        <div class="product-box">
            <div class="product-details">
                <div class="product-price">
                    @php
                        $b = [];
                        foreach ($key['index_terms'] as $keyword) {
                            $b = $keyword['terms'];
                        }
                    @endphp
                    <div class="col-xl-4 col-sm-4 xl-4 mb-1">
                        <span>
                            <b class="text-primary">Keywords:</b>
                        </span>
                    </div>
                    <div class="row mb-3">
                        @if ($b == null)
                            <span>Tidak Ada</span>
                        @else
                            @foreach ($b as $keywords)
                                <div class="col-xl-4 col-sm-7 xl-5 mb-2">
                                    <span class="btn btn-xs btn-outline-primary">
                                        <small>
                                            {{ $keywords }}
                                        </small>
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
                                            $limited_items = '';
                                            $remaining_items = '';
                                            $show_all_items = false;
                                            $i = 6;
                                        @endphp
                                        @foreach ($items as $key => $item)
                                            @if ($counter < 5)
                                                <div class="row">
                                                    @if ($key == 0)
                                                        <div class="col-md-2 col-sm-2 text-justify" style="text-align: center;">
                                                            <p class="text-justify">
                                                                {{ ++$counter }}.
                                                            </p>
                                                        </div>
                                                        <div class="col-md-10 col-sm-10">
                                                            <p class="text-justify">
                                                                {{ preg_replace('/\d+\.\s/', '', $item) }}<br>
                                                            </p>
                                                        </div>
                                                    @else
                                                        <div class="col-md-2 col-sm-2" style="text-align: center;">
                                                            <p class="text-justify">
                                                                {{ ++$counter }}.
                                                            </p>
                                                        </div>
                                                        <div class="col-md-10 col-sm-10">
                                                            <p class="text-justify">
                                                                {{ preg_replace('/\s+(\d+\.\s)(?=[a-zA-Z])/', "<br class='mb-2'>\$1", trim(preg_replace('/1\. /', '', $item))) }}<br>
                                                            </p>
                                                        </div>
                                                    @endif
                                                </div>
                                            @else
                                                @php
                                                    $remaining_items .=
                                                        '<div class="row">' .
                                                        '<div class="col-md-2 col-sm-2" style="text-align: center;">
                                                        ' .
                                                        '<p class="text-justify">' .
                                                        ++$counter . '.' .
                                                        '</p>' .
                                                        '</div>
                                                        ' .
                                                        '<div class="col-md-10 col-sm-10">' .
                                                        '<p class="text-justify">' .
                                                        $item .
                                                        '</p>' .
                                                        '</div>' .
                                                        '</div>';
                                                @endphp
                                            @endif
                                        @endforeach
                                        @if ($remaining_items != '')
                                            <a onclick="toggleItems()" id="read-more"><i
                                                    class="fa fa-chevron-circle-right"></i></a>
                                        @endif

                                        <div class="all-items d-none">
                                            {!! $limited_items !!}
                                            {!! $remaining_items !!}
                                        </div>
                                        <a class="d-none" onclick="toggleItems()" id="read-less"><i
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
