@if ($paginator->hasPages())
        <nav class="d-flex justify-content-center">
            <ul class="pagination text-center">
                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                    <li class="page-item">
                        <button disabled style="cursor: not-allowed! important;" class="page-link">
                            <i class="ph-arrow-left"></i>
                        </button>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link" href="{{ $paginator->previousPageUrl() }}">
                            <i class="text-primary-500 ph-arrow-left"></i>
                        </a>
                    </li>
                @endif

                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    <li class="page-item">
                        <a class="page-link" href="{{ $paginator->nextPageUrl() }}">
                            <i class="text-primary-500 ph-arrow-right"></i>
                        </a>
                    </li>
                @else
                    <li class="page-item">
                        <button disabled style="cursor: not-allowed! important;" class="page-link">
                            <i class="ph-arrow-right"></i>
                        </button>
                    </li>
                @endif
            </ul>
        </nav>
@endif
