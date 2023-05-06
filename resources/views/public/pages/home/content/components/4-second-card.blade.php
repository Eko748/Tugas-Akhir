<div class="col-xl-6 col-sm-6 xl-6">
    <div class="card">
        <div class="product-box">
            <div class="product-details">
                @if (isset($key['keywords']))
                    <div class="product-price">
                        <div class="col-xl-4 col-sm-4 xl-4 mb-1">
                            <span>
                                <b class="text-primary">Keywords:</b>
                            </span>
                        </div>
                        <div class="row mb-3">
                            @if ($key['keywords'] == null)
                                <span>Tidak Ada</span>
                            @else
                                @foreach ($key['keywords'] as $keyword)
                                    <div class="col-xl-4 col-sm-7 xl-5 mb-2">
                                        <span class="btn btn-xs btn-outline-primary">
                                            <span>
                                                {{ $keyword }}
                                            </span>
                                        </span>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                    <hr>
                @endif
                @if (isset($key['references']))
                    <div class="rating">
                        <div class="product-view row mb-3">
                            <div class="">
                                <span><b class="text-primary">References:</b></span>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <span>
                                        <small>
                                            @php
                                                $counter = 0;
                                                $limited_items = '';
                                                $remaining_items = '';
                                                $show_all_items = false;
                                            @endphp
                                            @foreach ($key['references'] as $references)
                                                @php
                                                    $ref = preg_replace('/\d+[\.\s]+/', '', $references);
                                                @endphp
                                                @if ($counter < 5)
                                                    <div class="row">
                                                        <div class="col-md-2 col-xl-2 col-lg-2 col-sm-2 text-justify"
                                                            style="text-align: center;">
                                                            <p class="text-justify">
                                                                {{ ++$counter }}.
                                                            </p>
                                                        </div>
                                                        <div class="col-md-10 col-xl-10 col-lg-10 col-sm-10">
                                                            <p class="text-justify">
                                                                {{ $ref }}<br>
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
                                                            ++$counter .
                                                            '</p>' .
                                                            '</div>
                                                        ' .
                                                            '<div class="col-md-10 col-xl-10 col-lg-10 col-sm-10">' .
                                                            '<p class="text-justify">' .
                                                            $ref .
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
                @endif
            </div>
        </div>
    </div>
</div>
