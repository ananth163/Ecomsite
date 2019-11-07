@if ($paginator->hasPages())
<nav aria-label="Pagination">
    <ul class="pagination text-center" role="navigation" aria-label="Pagination">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="pagination-previous disabled">Previous</li>
        @else
            <li class="pagination-previous">
                <a href="{{ $paginator->previousPageUrl() }}" aria-label="Previous page">Previous</a>
            </li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li class="disabled"><span>{{ $element }}</span></li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="current"><span class="show-for-sr">{{ $page }}</span>{{ $page }}</li>
                    @else
                        <li><a href="{{ $url }}">
                        {{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach
        
        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li class="pagination-next"><a href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="Next page">Next</a></li>
        @else
            <li class="pagination-next disabled"><span>Next</span></li>
        @endif
    </ul>
</nav>
@else
@endif