@if ($paginator->hasPages())
<nav aria-label="Pagination">
    <div class="join">
        @if ($paginator->onFirstPage())
            <button class="join-item btn btn-sm btn-disabled">«</button>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" class="join-item btn btn-sm" rel="prev">«</a>
        @endif

        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="join-item btn btn-sm" rel="next">»</a>
        @else
            <button class="join-item btn btn-sm btn-disabled">»</button>
        @endif
    </div>
</nav>
@endif
