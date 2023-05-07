<div class="product-box row">
    <div class="product-img col-lg-1">
        @if ($views['category_id'] == 1)
            <img style="width: 90px; height: 60px" src="{{ asset('assets/images/logo/ieee.png') }}" alt="">
        @elseif ($views['category_id'] == 2)
            <img style="width: 70px; height: 70px" src="{{ asset('assets/images/logo/acm.png') }}" alt="">
        @elseif ($views['category_id'] == 3)
            <img style="width: 80px; height: 30px" src="{{ asset('assets/images/logo/springer.png') }}" alt="">
        @endif
    </div>
    <div class="product-details col-lg-10 text-justify"><a href="product-page.html">
            <h4>Publisher: {{ $views['publisher'] }}</h4>
        </a>
        <div class="product-price">
            <span>Type: {{ $views['type'] }}</span>
            <p class="pull-right">
                Cited: {{ $views['cited'] }}
            </p>
        </div>
        <div class="product-price">
            <span>Publication Title: {{ $views['publication'] }}</span>
        </div>
        <div class="product-price">
            <span>Publication Date: {{ $views['year'] }}</span>
        </div>
        <hr>
        <div class="product-view mb-2">
            <div class="product-price">
                <h2>{{ $views['title'] }}</h2>
            </div>
            <span>
                <b class="f-w-600">Abstract:</b>
            </span>
            <p class="mb-0">
                {{ $views['abstracts'] }}
            </p>
        </div>
        <div class="col-xl-4 col-sm-4 xl-4 mb-1">
            <b>
                <span>Authors:</span>
            </b>
        </div>
        <div class="row mb-3">
            <span>{{ $views['authors'] }}</span>
        </div>
        <div class="col-xl-4 col-sm-4 xl-4 mb-1">
            <b>
                <span>Keywords:</span>
            </b>
        </div>
        <div class="row mb-3">
            <span>{{ $views['keywords'] }}</span>
        </div>
        <div class="product-view row mb-3">
            <div class="">
                <span><b>References:</b></span>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <span>
                        <small>
                            @php
                                $counter = 0;
                                $text = $views->references;
                                $items = preg_split('/\s+(\d{1,3}\.)\s+(?=[a-zA-Z])/u', $text);
                                foreach ($items as $key => $value) {
                                    $value = trim($value);
                                    if (empty($value)) {
                                        unset($items[$key]);
                                    } else {
                                        $items[$key] = $value;
                                    }
                                }
                            @endphp
                            @foreach ($items as $key => $item)
                                <div class="row">
                                    <td>
                                        <div class="col-md-2 col-sm-2 col-xs-2" style="text-align: center;">
                                            <p class="text-justify" style="text-align: center; vertical-align: middle;">
                                                {{ ++$counter }}.
                                            </p>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="col-md-10 col-sm-10 col-xs-10">
                                            <p class="text-justify">
                                                @if (preg_match('/^\d\.\s/', $item))
                                                    {{ preg_replace('/^\d\.\s/', '', $item) }}
                                                @else
                                                    {{ $item }}
                                                @endif
                                            </p>
                                        </div>
                                    </td>
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