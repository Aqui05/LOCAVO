<!-- resources/views/vendor/custom.blade.php -->

@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="pagination">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <span class="pagination__item pagination__item--disabled" aria-disabled="true" aria-label="{{ __('pagination.previous') }}">
                <span aria-hidden="true">&lsaquo;</span>
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="pagination__item" aria-label="{{ __('pagination.previous') }}">&lsaquo;</a>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <span class="pagination__item pagination__item--disabled" aria-disabled="true">{{ $element }}</span>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span class="pagination__item pagination__item--current" aria-current="page">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}" class="pagination__item" aria-label="{{ __('Go to page :page', ['page' => $page]) }}">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="pagination__item" aria-label="{{ __('pagination.next') }}">&rsaquo;</a>
        @else
            <span class="pagination__item pagination__item--disabled" aria-disabled="true" aria-label="{{ __('pagination.next') }}">
                <span aria-hidden="true">&rsaquo;</span>
            </span>
        @endif
    </nav>
@endif
