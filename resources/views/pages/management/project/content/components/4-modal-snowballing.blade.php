<div class="card">
    <div class="card-header">
        <div class="row text-center mb-3">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 text-center">
                <a href="{{ Auth::user()->role_id == 1 ? route('review.ieee.index') : route('ieee.index') }}?slr_id={{ $views->uuid_review }}&slr_code={{ $views->code }}"
                    class="button btn-info review-go hovering mb-2"><i class="fa fa-paper-plane"></i> IEEE</a>
                <a href="{{ Auth::user()->role_id == 1 ? route('review.acm.index') : route('acm.index') }}?slr_id={{ $views->uuid_review }}&slr_code={{ $views->code }}"
                    class="button btn-success review-go hovering mb-2"><i class="fa fa-paper-plane"></i> ACM</a>
                <a href="{{ Auth::user()->role_id == 1 ? route('review.springer.index') : route('springer.index') }}?slr_id={{ $views->uuid_review }}&slr_code={{ $views->code }}"
                    class="button btn-warning review-go hovering mb-2"><i class="fa fa-paper-plane"></i>
                    Springer</a>
            </div>
        </div>
    </div>
    <div class="card-body mt-3">
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
                                    <div class="col-md-1 col-sm-1 col-xs-1" style="text-align: center;">
                                        <p class="text-justify" style="text-align: center; vertical-align: middle;">
                                            <small>{{ ++$counter }}.</small>
                                        </p>
                                    </div>
                                </td>
                                <td>
                                    <div class="col-md-11 col-sm-11 col-xs-11">
                                        <p class="text-justify">
                                            @if (preg_match('/^\d\.\s/', $item))
                                                @php
                                                    $modifiedItem = preg_replace('/^\d\.\s/', '', $item);
                                                    $modifiedItemHref = str_replace(' ', '+', $modifiedItem);
                                                    $fullHref = 'https://scholar.google.com/scholar?hl=id&as_sdt=0%2C5&q=' . $modifiedItemHref;
                                                @endphp
                                                <a href="{{ $fullHref }}" target="_blank">{{ $modifiedItem }}</a>
                                            @else
                                                @php
                                                    $modifiedItemHref = str_replace(' ', '+', $item);
                                                    $fullHref = 'https://scholar.google.com/scholar?hl=id&as_sdt=0%2C5&q=' . $modifiedItemHref;
                                                @endphp
                                                <a href="{{ $fullHref }}" target="_blank">{{ $item }}</a>
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
    <div class="card-footer">
        <div class="row text-center">
            <div class="col-sm-2 col-md-2 col-lg-2 col-xl-2">
            </div>
            <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8">
                <a href="{{ Auth::user()->role_id == 1 ? route('review.ieee.index') : route('ieee.index') }}?slr_id={{ $views->uuid_scrape }}&slr_code={{ $views->code }}"
                    class="button btn-info review-go hovering mb-2"><i class="fa fa-paper-plane"></i> IEEE</a>
                <a href="{{ Auth::user()->role_id == 1 ? route('review.acm.index') : route('acm.index') }}?slr_id={{ $views->uuid_scrape }}&slr_code={{ $views->code }}"
                    class="button btn-success review-go hovering mb-2"><i class="fa fa-paper-plane"></i> ACM</a>
                <a href="{{ Auth::user()->role_id == 1 ? route('review.springer.index') : route('springer.index') }}?slr_id={{ $views->uuid_scrape }}&slr_code={{ $views->code }}"
                    class="button btn-warning review-go hovering mb-2"><i class="fa fa-paper-plane"></i>
                    Springer</a>
            </div>
            <div class="col-sm-2 col-md-2 col-lg-2 col-xl-2">
            </div>
        </div>
    </div>
</div>
