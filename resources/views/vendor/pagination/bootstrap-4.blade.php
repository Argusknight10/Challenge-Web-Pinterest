<!-- resources/views/vendor/pagination/bootstrap-4.blade.php -->
<div class="flex justify-center mt-4">
    <ul class="pagination">
        @if ($paginator->onFirstPage())
            <li class="disabled"><span class="px-4 py-2 bg-gray-300 text-gray-500">&laquo;</span></li>
        @else
            <li><a href="{{ $paginator->previousPageUrl() }}" class="px-4 py-2" style="background-color: #3B70AD; color: white;">&laquo;</a></li>
        @endif

        @foreach ($elements as $element)
            @if (is_string($element))
                <li class="disabled"><span class="px-4 py-2 bg-gray-300 text-gray-500">{{ $element }}</span></li>
            @endif

            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="active"><span class="px-4 py-2 bg-gray-400 text-white">{{ $page }}</span></li>
                    @else
                        <li><a href="{{ $url }}" class="px-4 py-2" style="background-color: #3B70AD; color: white;">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach

        @if ($paginator->hasMorePages())
            <li><a href="{{ $paginator->nextPageUrl() }}" class="px-4 py-2" style="background-color: #3B70AD; color: white;">&raquo;</a></li>
        @else
            <li class="disabled"><span class="px-4 py-2 bg-gray-300 text-gray-500">&raquo;</span></li>
        @endif
    </ul>
</div>