<div class="flex flex-col flex-1 w-0 overflow-hidden">
    <main class="relative flex-1 overflow-y-auto focus:outline-none">
        <div class="py-6">
            <div class="px-4 mx-auto 2xl:max-w-7xl sm:px-6 md:px-6">
                <!-- Content-->
                <div class="py-4">
                    <div class="h-screen {{--}}border border-blue-600 border-dashed{{--}} rounded-lg">
                        <article class="mt-4 mb-4 bg-white p-8 shadow-xl rounded-xl max-w-full{{--}}max-w-max{{--}} prose dark:bg-gray-800 dark:text-white">
                            <h2 class="mb-4 text-2xl tracking-tight font-bold text-gray-900 dark:text-white">
                                {!! $page->title !!}
                            </h2>
                            <p class="max-w-xl mt-4 text-base tracking-tight text-gray-600">
                                {!! $page->text_field ?? ''!!}
                            </p>
                        @foreach($page->content as $content)
                            @if($content->type == "text")
                                {!! $content->text !!}
                            @elseif($content->type == "fileassets")
                                @foreach($content->file as $file)
                                        <a href="{{$file->url}}" class="inline-flex items-center justify-center p-5 text-base font-medium text-gray-500 rounded-lg bg-gray-50 hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700 dark:hover:text-white">
                                            <svg class="w-[18px] h-[18px] text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 20">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M15 6V2a.97.97 0 0 0-.933-1H5.828a2 2 0 0 0-1.414.586L1.586 4.414A2 2 0 0 0 1 5.828V18a.969.969 0 0 0 .933 1H14a1 1 0 0 0 1-1M6 1v4a1 1 0 0 1-1 1H1m6 6h9m-1.939-2.768L16.828 12l-2.767 2.768"/>
                                            </svg>
                                            <span class="w-full ml-2">{{$file->filename}} ({{$file->size}})</span>
                                        </a>
                                @endforeach
                            @endif
                        @endforeach

                        <!--Page author-->
                            <div class="text-gray-600 text-sm bg-white p-3 rounded-md leading-none dark:bg-gray-800 dark:text-white">
                                <hr>
                                <p><i>{{__("Page editor:")}} {!! $page->author->name !!}</i></p>
                                <p><i>{{__("Last edited:")}} {!! $page->last_modified !!}</i></p>
                            </div>
                        </article>
                    </div>
                </div>
                <!-- end content -->
            </div>
        </div>
    </main>
</div>
