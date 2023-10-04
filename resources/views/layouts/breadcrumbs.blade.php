<section>
    <div class=" items-center px-6 py-2 mx-auto max-w-7xl lg:px-16 md:px-6 lg:py-4">
        <div class="justify-center w-full mx-auto">
            <nav class="flex justify-center mx-auto " aria-label="Breadcrumb">
                <ol role="list" class="flex items-center space-x-4">
                    @foreach(Statamic::tag('nav:breadcrumbs') as $p)
                    <li>
                        <div class="flex items-center">
                            @if(!$loop->first)
                                <svg class="w-3 h-3 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="m1 9 4-4-4-4"/>
                                </svg>
                            @endif
                                <a href="{{ $p->url }}" class="ml-3 text-sm font-medium @if($p->is_current) text-blue-500 @else text-gray-500 @endif hover:scale-95 hover:text-gray-700">{{ $p->title }}</a>
                        </div>
                    </li>
                    @endforeach
                </ol>
            </nav>
        </div>
    </div>
</section>
