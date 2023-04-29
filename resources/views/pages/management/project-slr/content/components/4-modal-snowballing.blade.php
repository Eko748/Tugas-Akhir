<div class="card">
    <div class="card-body">
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
    <div class="card-footer">
        @if (Auth::user()->role_id == 1)
            <a href="{{ route('review.ieee.index') }}?slr_id={{ $views->uuid_project_slr }}&slr_code={{ $views->code }}"
                class="pull-right button btn-info review-go hovering">IEEE</a>
            <a href="{{ route('review.springer.index') }}?slr_id={{ $views->uuid_project_slr }}&slr_code={{ encrypt($views->code) }}"
                class="pull-right button btn-warning review-go hovering">Springer</a>
        @elseif (Auth::user()->role_id == 2)
            <a href="{{ route('ieee.index') }}?slr_id={{ $views->uuid_project_slr }}&slr_code={{ encrypt($views->code) }}"
                class="pull-right button btn-info review-go hovering">IEEE</a>
        @endif
    </div>
</div>
