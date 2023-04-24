<div class="card">
    <div class="card-body">
        <h3>
            {{ $views->title }}
        </h3>
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
                                            {{ ++$counter }}.
                                        </p>
                                    </div>
                                </td>
                                <td>
                                    <div class="col-md-11 col-sm-11 col-xs-11">
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
