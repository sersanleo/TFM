<div class="d-inline-block">
    <div class="input-group">
        @if ($paginator->currentPage() > 1)
            <a class="input-group-text" title="Primera página" href="{{ $paginator->url(1) }}">
                <i class="fas fa-angle-double-left" aria-hidden="true"></i>
            </a>
            <a class="input-group-text" title="Página anterior" href="{{ $paginator->previousPageUrl() }}">
                <i class="fas fa-angle-left" aria-hidden="true"></i>
            </a>
        @endif

        <span class="input-group-text">Página {{ $paginator->currentPage() }} de
            {{ $paginator->lastPage() }}</span>

        @if ($paginator->hasMorePages())
            <a class="input-group-text" title="Página siguiente" href="{{ $paginator->nextPageUrl() }}">
                <i class="fas fa-angle-right" aria-hidden="true"></i>
            </a>
            <a class="input-group-text" title="Última página" href="{{ $paginator->url($paginator->lastPage()) }}">
                <i class="fas fa-angle-double-right" aria-hidden="true"></i>
            </a>
        @endif
    </div>
</div>
