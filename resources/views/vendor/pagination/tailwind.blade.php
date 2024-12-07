{{-- Create this file at: resources/views/vendor/pagination/tailwind.blade.php --}}
@if ($paginator->hasPages())
    <nav>
        <ul class="flex space-x-5 justify-center font-[sans-serif]">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="flex items-center justify-center shrink-0 bg-gray-100 w-9 h-9 rounded-md cursor-not-allowed">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3 fill-gray-400" viewBox="0 0 55.753 55.753">
                        <path d="M12.745 23.915c.283-.282.59-.52.913-.727L35.266 1.581a5.4 5.4 0 0 1 7.637 7.638L24.294 27.828l18.705 18.706a5.4 5.4 0 0 1-7.636 7.637L13.658 32.464a5.367 5.367 0 0 1-.913-.727 5.367 5.367 0 0 1-1.572-3.911 5.369 5.369 0 0 1 1.572-3.911z"/>
                    </svg>
                </li>
            @else
                <li>
                    <a href="{{ $paginator->previousPageUrl() }}"
                       class="flex items-center justify-center shrink-0 border hover:border-blue-500 w-9 h-9 rounded-md cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3 fill-gray-400" viewBox="0 0 55.753 55.753">
                            <path d="M12.745 23.915c.283-.282.59-.52.913-.727L35.266 1.581a5.4 5.4 0 0 1 7.637 7.638L24.294 27.828l18.705 18.706a5.4 5.4 0 0 1-7.636 7.637L13.658 32.464a5.367 5.367 0 0 1-.913-.727 5.367 5.367 0 0 1-1.572-3.911 5.369 5.369 0 0 1 1.572-3.911z"/>
                        </svg>
                    </a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="flex items-center justify-center shrink-0 border text-base font-bold text-gray-800 px-[13px] h-9 rounded-md">
                        {{ $element }}
                    </li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="flex items-center justify-center shrink-0 bg-blue-500 border hover:border-blue-500 border-blue-500 cursor-pointer text-base font-bold text-white px-[13px] h-9 rounded-md">
                                {{ $page }}
                            </li>
                        @else
                            <li>
                                <a href="{{ $url }}" class="flex items-center justify-center shrink-0 border hover:border-blue-500 cursor-pointer text-base font-bold text-gray-800 px-[13px] h-9 rounded-md">
                                    {{ $page }}
                                </a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li>
                    <a href="{{ $paginator->nextPageUrl() }}"
                       class="flex items-center justify-center shrink-0 border hover:border-blue-500 cursor-pointer w-9 h-9 rounded-md">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3 fill-gray-400 rotate-180" viewBox="0 0 55.753 55.753">
                            <path d="M12.745 23.915c.283-.282.59-.52.913-.727L35.266 1.581a5.4 5.4 0 0 1 7.637 7.638L24.294 27.828l18.705 18.706a5.4 5.4 0 0 1-7.636 7.637L13.658 32.464a5.367 5.367 0 0 1-.913-.727 5.367 5.367 0 0 1-1.572-3.911 5.369 5.369 0 0 1 1.572-3.911z"/>
                        </svg>
                    </a>
                </li>
            @else
                <li class="flex items-center justify-center shrink-0 bg-gray-100 w-9 h-9 rounded-md cursor-not-allowed">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3 fill-gray-400 rotate-180" viewBox="0 0 55.753 55.753">
                        <path d="M12.745 23.915c.283-.282.59-.52.913-.727L35.266 1.581a5.4 5.4 0 0 1 7.637 7.638L24.294 27.828l18.705 18.706a5.4 5.4 0 0 1-7.636 7.637L13.658 32.464a5.367 5.367 0 0 1-.913-.727 5.367 5.367 0 0 1-1.572-3.911 5.369 5.369 0 0 1 1.572-3.911z"/>
                    </svg>
                </li>
            @endif
        </ul>
    </nav>
@endif
