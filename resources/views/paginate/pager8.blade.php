@if ($paginator->hasPages())

<style>
    @media screen and (max-width: 400px) {
        li.page-item {
            display: none;
        }
        .page-item:first-child,
        .page-item:nth-child(2),
        .page-item:nth-last-child(2),
        .page-item:last-child,
        .page-item.active,
        .page-item.disabled {
            display: block;
        }
    }
    .page-item.active .page-link {
    z-index: 0;
}
</style>

<nav aria-label="Page navigation example">
    <ul class="pagination nav justify-content-center">
        @if ($paginator->onFirstPage())
        <li class="page-item disabled"><a class="page-link" href="javascript:void(0)">«</a></li>

        @else
        <li class="page-item"><a href="{{ $paginator->previousPageUrl() }}" class="page-link" rel="prev">«</a></li>

        @endif

        @if(!isset($_GET['page']))
        <li class="page-item active"><a class="page-link" href="#">All</a></li>
        @else 
        <li class="page-item"><a class="page-link" href="{{ route('all-products') }}">All</a></li>

        @endif

        @if ($paginator->currentPage() > 3)
        <li class="page-item"><a class="page-link" href="{{ $paginator->url(1) }}">1</a></li>

        @endif
        @if ($paginator->currentPage() > 4)
        <li class="page-item"><a class="page-link" href="javascript:void(0)">...</a></li>
        @endif
        @foreach (range(1, $paginator->lastPage()) as $i)
        @if ($i >= $paginator->currentPage() - 2 && $i <= $paginator->currentPage() + 2)
            @if ($i == $paginator->currentPage())
            
            @if(!isset($_GET['page']))
            <li class="page-item "><a href="?page={{ $i }}" class="page-link">{{ $i }}</a></li>
            @else 
            <li class="page-item active"><a class="page-link">{{ $i }}</a></li>
            @endif
            

            @else
            <li class="page-item"><a class=" page-link" href="{{ $paginator->url($i) }}">{{ $i }}</a></li>

            @endif
            @endif
            @endforeach
            @if ($paginator->currentPage() < $paginator->lastPage() - 3)
                <li class="page-item"><a class="page-link" href="javascript:void(0)">...</a></li>
                @endif
                @if ($paginator->currentPage() < $paginator->lastPage() - 2)
                    <li class="page-item"><a class="page-link" href="{{ $paginator->lastPage() }}">{{ $paginator->lastPage() }}</a></li>

                    @endif
                    @if ($paginator->hasMorePages())
                    <li class="page-item"><a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next">»</a></li>

                    @else
                    <li class="page-item disabled"><a class="page-link" href="javascript:void(0)">»</a></li>
                    @endif
    </ul>

</nav>

@endif