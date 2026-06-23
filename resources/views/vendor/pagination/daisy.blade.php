@if ($paginator->hasPages())
<nav aria-label="Pagination">
    <div class="join">

        {{-- Previous --}}
        @if ($paginator->onFirstPage())
            <button class="join-item btn btn-sm btn-disabled" aria-disabled="true">«</button>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" class="join-item btn btn-sm" rel="prev">«</a>
        @endif

        {{-- Page links --}}
        @foreach ($elements as $element)
            @if (is_string($element))
                <button class="join-item btn btn-sm btn-disabled">{{ $element }}</button>
            @endif
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <button class="join-item btn btn-sm btn-primary" aria-current="page">{{ $page }}</button>
                    @else
                        <a href="{{ $url }}" class="join-item btn btn-sm">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="join-item btn btn-sm" rel="next">»</a>
        @else
            <button class="join-item btn btn-sm btn-disabled" aria-disabled="true">»</button>
        @endif

    </div>
</nav>
@endif
