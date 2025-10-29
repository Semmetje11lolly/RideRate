<section class="pagination">
    @if ($paginator->onFirstPage())
        <span class="button-disabled">
            {!! __('pagination.previous') !!}
        </span>
    @else
        <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="button-primary">
            {!! __('pagination.previous') !!}
        </a>
    @endif

    <div>
        <p>
            {!! __('Showing') !!}
            @if ($paginator->firstItem())
                <span>{{ $paginator->firstItem() }}</span>
                {!! __('to') !!}
                <span>{{ $paginator->lastItem() }}</span>
            @else
                {{ $paginator->count() }}
            @endif
            {!! __('of') !!}
            <span>{{ $paginator->total() }}</span>
            experiences
        </p>
    </div>

    @if ($paginator->hasMorePages())
        <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="button-primary">
            {!! __('pagination.next') !!}
        </a>
    @else
        <span class="button-disabled">
            {!! __('pagination.next') !!}
        </span>
    @endif
</section>
