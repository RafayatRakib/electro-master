@if ($paginator->hasPages())
    <div class="mt-5 d-flex justify-content-center">
        <nav aria-label="Page navigation">
            <ul class="pagination">
                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                    <li class="page-item prev disabled" aria-disabled="true">
                        <a class="page-link" href="javascript:void(0);"><i class="tf-icon bx bx-chevrons-left">Pre</i></a>
                    </li>
                @else
                    <li class="page-item prev">
                        <a class="page-link" href="{{ $paginator->previousPageUrl() }}"><i class="tf-icon bx bx-chevrons-left"></i>Pre</a>
                    </li>
                @endif

                {{-- Pagination Elements --}}
                @foreach ($elements as $element)
                    {{-- "Three Dots" Separator --}}
                    @if (is_string($element))
                        <li class="page-item disabled" aria-disabled="true"><span class="page-link">{{ $element }}</span></li>
                    @endif

                    {{-- Array Of Links --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <li class="page-item active" aria-current="page">
                                    <span class="page-link">{{ $page }}</span>
                                </li>
                            @else
                                <li class="page-item">
                                    <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                </li>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    <li class="page-item next">
                        <a class="page-link" href="{{ $paginator->nextPageUrl() }}"><i class="tf-icon bx bx-chevrons-right"></i> Next </a>
                    </li> 
                @else
                    <li class="page-item next disabled" aria-disabled="true">
                        <a class="page-link" href="javascript:void(0);"><i class="tf-icon bx bx-chevrons-right">Next</i></a>
                    </li>
                @endif
            </ul>
        </nav>
    </div>
@endif
