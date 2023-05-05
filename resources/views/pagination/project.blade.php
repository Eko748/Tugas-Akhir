@if ($projects->lastPage() > 1)
    <ul class="pagination mb-4">
        @if ($projects->currentPage() > 1)
            <li class="page-item"><a href="{{ $projects->previousPageUrl() }}" class="page-link"><i
                        class="fa fa-angle-double-left"></i></a></li>
        @endif
        @php
            $maxPages = 3;
            $halfMaxPages = intval($maxPages / 2);
            
            $startPage = max($projects->currentPage() - $halfMaxPages, 1);
            $endPage = min($startPage + $maxPages - 1, $projects->lastPage());
            
            if ($endPage - $startPage < $maxPages - 1) {
                $startPage = max($endPage - $maxPages + 1, 1);
            } elseif ($endPage == $projects->lastPage() && $endPage - $startPage < $maxPages - 2) {
                $startPage = max($endPage - $maxPages + 2, 1);
            }
            
            if ($projects->lastPage() == 3 && $startPage == 1) {
                $endPage = 3;
            }
        @endphp

        @if ($projects->currentPage() > $maxPages)
            <li class="page-item"><a href="{{ $projects->url(1) }}" class="page-link">1</a></li>
            <li class="page-item disabled"><span class="page-link">...</span></li>
        @endif

        @for ($i = $startPage; $i <= $endPage; $i++)
            <li class="page-item {{ $projects->currentPage() == $i ? ' active' : '' }}">
                <a class="page-link" href="{{ $projects->url($i) }}">{{ $i }}</a>
            </li>
        @endfor

        @if ($projects->currentPage() < $projects->lastPage() - $halfMaxPages)
            <li class="page-item disabled"><span class="page-link">...</span></li>

            @if ($projects->lastPage() != 3)
                <li class="page-item"><a href="{{ $projects->url($projects->lastPage()) }}"
                        class="page-link">{{ $projects->lastPage() }}</a></li>
            @endif
        @endif

        @if ($projects->currentPage() < $projects->lastPage())
            <li class="page-item"><a href="{{ $projects->nextPageUrl() }}" class="page-link"><i
                        class="fa fa-angle-double-right"></i></a></li>
        @endif
    </ul>
@endif
