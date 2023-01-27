@if ($paginator->hasPages())
    <ul class="pagination justify-content-center">

        @if ($paginator->onFirstPage())
            <li class="page-item">
                <button disabled class="page-link">
                    <i class="ph-arrow-left"></i>
                </button>
            </li>
        @else
            <li class="page-item">
                <a class="page-link" href="{{ $paginator->previousPageUrl() }}">
                    <i class="ph-arrow-left"></i>
                </a>
            </li>
        @endif

        @foreach ($elements as $element)

            @if (is_string($element))
                <li class="disabled"><span>{{ $element }}</span></li>
            @endif

            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="page-item active"><button class="page-link" type="button">{{ $page }}</button></li>
                    @else
                        <li class="page-item "><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach

        @if ($paginator->hasMorePages())
            <li class="page-item">
                <a class="page-link" href="{{ $paginator->nextPageUrl() }}">
                    <i class="ph-arrow-right"></i>
                </a>
            </li>
        @else
            <li class="page-item">
                <button disabled class="page-link">
                    <i class="ph-arrow-right"></i>
                </button>
            </li>
        @endif
    </ul>
@endif
