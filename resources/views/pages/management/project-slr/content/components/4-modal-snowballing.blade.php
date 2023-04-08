<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <span>
                    <small>
                        @php
                            $counter = 0;
                            $text = $views->references;
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
                        @foreach ($items as $key => $item)
                            <div class="row">
                                <td>
                                    <div class="col-md-1 col-sm-1 col-xs-1" style="text-align: center;">
                                        <p class="text-justify pull-right">
                                            {{ ++$counter }}.
                                        </p>
                                    </div>
                                </td>
                                <td>
                                    <div class="col-md-11 col-sm-11 col-xs-11">
                                        <p class="text-justify">
                                            {{ preg_replace('/\d+\.\s/', '', $item) }}<br>
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
            <a href="{{ route('review.ieee.index') }}?slr_id={{ $views->uuid_project_slr }}&slr_code={{ encrypt($views->code) }}"
                class="pull-right button btn-info review-go hovering">IEEE</a>
        @elseif (Auth::user()->role_id == 2)
            <a href="{{ route('ieee.index') }}?slr_id={{ $views->uuid_project_slr }}&slr_code={{ encrypt($views->code) }}"
                class="pull-right button btn-info review-go hovering">IEEE</a>
        @endif
    </div>
</div>
