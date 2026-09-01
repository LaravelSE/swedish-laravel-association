@php
if (! isset($scrollTo)) {
    $scrollTo = 'body';
}

$scrollIntoViewJsSnippet = ($scrollTo !== false)
    ? <<<JS
       (\$el.closest('{$scrollTo}') || document.querySelector('{$scrollTo}')).scrollIntoView()
    JS
    : '';
@endphp

@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" class="tm-pagination">
        <p class="tm-pagination-summary">
            // showing {{ $paginator->firstItem() }}&ndash;{{ $paginator->lastItem() }} of {{ $paginator->total() }}
        </p>

        <div class="tm-pagination-controls">
            @if ($paginator->onFirstPage())
                <span class="tm-page-link is-disabled" aria-disabled="true" aria-label="{{ __('pagination.previous') }}">&laquo; prev</span>
            @else
                <button type="button" class="tm-page-link" wire:click="previousPage('{{ $paginator->getPageName() }}')" x-on:click="{{ $scrollIntoViewJsSnippet }}" wire:loading.attr="disabled" aria-label="{{ __('pagination.previous') }}">&laquo; prev</button>
            @endif

            @foreach ($elements as $element)
                @if (is_string($element))
                    <span class="tm-page-ellipsis">{{ $element }}</span>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span class="tm-page-link is-current" aria-current="page">{{ $page }}</span>
                        @else
                            <button type="button" class="tm-page-link" wire:click="gotoPage({{ $page }}, '{{ $paginator->getPageName() }}')" x-on:click="{{ $scrollIntoViewJsSnippet }}" wire:loading.attr="disabled" aria-label="{{ __('Go to page :page', ['page' => $page]) }}">{{ $page }}</button>
                        @endif
                    @endforeach
                @endif
            @endforeach

            @if ($paginator->hasMorePages())
                <button type="button" class="tm-page-link" wire:click="nextPage('{{ $paginator->getPageName() }}')" x-on:click="{{ $scrollIntoViewJsSnippet }}" wire:loading.attr="disabled" aria-label="{{ __('pagination.next') }}">next &raquo;</button>
            @else
                <span class="tm-page-link is-disabled" aria-disabled="true" aria-label="{{ __('pagination.next') }}">next &raquo;</span>
            @endif
        </div>
    </nav>
@endif
