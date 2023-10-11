<div class="flex flex-col flex-1 w-0 overflow-hidden">
    <main class="relative flex-1 overflow-y-auto focus:outline-none">
        <div class="py-6">
            <div class="px-4 mx-auto 2xl:max-w-7xl sm:px-6 md:px-8">
                <!-- Content-->
                <div class="py-4">
                    <div class="h-screen border border-gray-200 border-dashed rounded-lg">
                        <article class="mt-4 bg-white p-8 shadow-xl rounded-xl max-w-max prose dark:bg-gray-800 dark:text-white">
                            <h2 class="mb-4 text-2xl tracking-tight font-bold text-gray-900 dark:text-white">
                                {!! $page->title !!}
                            </h2>
                            <p class="max-w-xl mt-4 text-base tracking-tight text-gray-600">
                                {!! $page->text_field ?? ''!!}
                            </p>

                        {!! $page->content !!}

                        <!--Page author-->
                            <div class="text-gray-600 text-sm bg-white p-3 rounded-md leading-none dark:bg-gray-800 dark:text-white">
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
