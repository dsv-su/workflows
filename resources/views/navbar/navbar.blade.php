<div class="w-full mx-auto bg-white border-b 2xl:max-w-7xl {{--}}2xl:max-w-screen-2xl{{--}}">
    <div x-data="{ open: false }" class="relative flex flex-col w-full p-5 mx-auto bg-white md:items-center md:justify-between md:flex-row md:px-6 lg:px-8 dark:border-gray-600 dark:bg-gray-900">
        <div class="flex flex-row items-center justify-between lg:justify-start">
            <a href="{{ config('app.url') }}" class="flex items-center">
                <span class="self-center text-2xl font-normal whitespace-nowrap dark:text-white">{{__('DSVIntranet')}}</span>
            </a>
            <button @click="open = !open" class="inline-flex items-center justify-center p-2 text-gray-400 hover:text-black focus:outline-none focus:text-black md:hidden">
                <svg class="w-6 h-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                    <path :class="{'hidden': open, 'inline-flex': !open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    <path :class="{'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        <nav :class="{'flex': open, 'hidden': !open}" class="flex-col items-center flex-grow hidden md:ml-16 md:pb-0 md:flex sm:justify-end md:flex-row">
            @foreach (\Statamic\Statamic::tag('nav:collection:pages')->sort('order')->fetch() as $entry)
                @if(!$entry['children'])
                    <a class="px-1 py-2 font-medium text-gray-900 dark:text-white lg:px-4 md:px-3 hover:text-blue-600 @if ($entry['is_parent'] || $entry['is_current']) font-semibold text-blue-500  @endif"
                       href="{{ $entry['url']->value() }}">
                        {{ $entry['title']->value() }}
                    </a>
                @else
                    <div class="order-last md:order-none" x-data="{ openMobileMenu: false }" x-on:click.away="openMobileMenu = false">
                        <div class="relative">
                            <nav class="relative flex items-center justify-around w-full sm:h-10">
                                <div class="flex items-center justify-between flex-1">
                                    <div class="flex items-center -mr-2" x-on:click="openMobileMenu = !openMobileMenu">
                                        <button type="button" class="flex flex-row items-center w-full px-4 py-2 mt-2 mr-2 font-medium text-left text-gray-900 dark:text-white md:w-auto md:inline md:mt-0 hover:text-blue-600 focus:outline-none focus:shadow-outline"
                                                id="main-menu" aria-label="Main menu" aria-haspopup="true">
                                            <span>
                                              {{__($entry['title']->value())}}
                                            </span>
                                            <svg class="inline w-2 h-2 mt-1 transition-transform duration-200 transform rotate-0 md:-mt-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" style="fill:gray" viewBox="0 0 10 6">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="m1 1 4 4 4-4"/>
                                            </svg>

                                        </button>
                                    </div>
                                </div>
                            </nav>
                        </div>

                        <div x-on:click="openMobileMenu = false" x-transition:enter="transition ease-out duration-150" x-transition:enter-start="opacity-0 transform scale-95" x-transition:enter-end="opacity-100 transform scale-100" x-transition:leave="transition ease-in duration-100" x-transition:leave-start="opacity-100 transform scale-100" x-transition:leave-end="opacity-0 transform scale-95" :class="{'translate-y-0 shadow-md duration-150': openMobileMenu, '-translate-y-full': ! openMobileMenu}" class="fixed inset-0 top-0 z-40 h-screen overflow-y-auto transition origin-top transform -translate-y-full">
                            <div class="relative overflow-hidden bg-white shadow-xl lg:bg-transparent" role="menu" aria-orientation="vertical" aria-labelledby="main-menu">
                                <div class="bg-white border-y dark:border-gray-600 dark:bg-gray-900">
                                    <div class="grid px-4 py-6 mx-auto sm:grid-cols-2 2xl:max-w-7xl gap-y-6 sm:gap-8 sm:px-6 sm:py-8 lg:grid-cols-3 lg:px-8 lg:py-12 xl:py-16">
                                        @foreach(collect($entry['children'])->chunk(3) as $chunk)
                                        <div class="grid grid-cols-1 gap-3 p-2 lg:p-0">
                                            @foreach($chunk as $child)
                                            <a href="{{$child['url']}}" class="flex flex-col justify-between p-6 -m-3 transition duration-500 ease-in-out transform bg-transparent hover:bg-gray-50">
                                                <div class="relative">
                                                    <div>
                                                        <div class="absolute flex items-center justify-center w-12 h-12 text-blue-500 rounded-xl bg-gray-50">
                                                            <ion-icon class="w-6 h-6 md hydrated" name="document-outline" role="img" aria-label="document outline">
                                                                {!! $child['icon_field'] !!}
                                                            </ion-icon>
                                                        </div>
                                                        <p class="mt-4 ml-16 text-base font-medium text-black dark:text-white">
                                                            {{$child['title']}}
                                                        </p>
                                                    </div>
                                                    <div class="mt-2 ml-16 text-sm text-gray-500">
                                                        {{ $child['text_field'] }}
                                                    </div>
                                                </div>
                                            </a>
                                            @endforeach
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
            <!-- Search form -->
            <livewire:search />
            {{--}}
            <div class="hidden mx-10 md:block lg:ml-auto">
                <form action="{{route('search')}}" class="relative m-0">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                      <svg class="w-5 h-5 text-gray-400" viewBox="0 0 24 24" fill="none">
                        <path d="M21 21L15 15M17 10C17 13.866 13.866 17 10 17C6.13401 17 3 13.866 3 10C3 6.13401 6.13401 3 10 3C13.866 3 17 6.13401 17 10Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                      </svg>
                    </span>
                    <input name="q" type="text" class="w-full py-2 pl-10 pr-4 text-black bg-white border border-gray-200 focus:outline-none focus:ring focus:ring-opacity-40 focus:ring-blue-500
                    sm:text-sm rounded-xl placeholder:text-gray-400 focus:border-blue-500 dark:bg-gray-900 dark:text-white" placeholder="Search">
                </form>
            </div>
            {{--}}
            <!-- Workflow start -->
            {{--}}
            <div class="inline-flex items-center gap-2 list-none lg:ml-auto">
                <a href="#" id="workflow" data-tooltip-target="navbar-workflow-tooltip" data-tooltip-placement="bottom"
                   class="block py-2 pl-3 pr-4 text-gray-900 border-b border-gray-100 hover:bg-blue-200 md:hover:bg-transparent
                    md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700
                    dark:hover:text-blue-500 md:dark:hover:bg-transparent dark:border-gray-700">
                    <svg class="w-5 h-5 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 18">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M8 1v11m0 0 4-4m-4 4L4 8m11 4v3a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-3"/>
                    </svg>
                </a>
            </div>
            {{--}}
        </nav>
    </div>
</div>
<!-- Tooltips -->
<div id="navbar-workflow-tooltip" role="tooltip"
     class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700"
     style="position: absolute; inset: auto auto 0px 0px; margin: 0; transform: translate(1443px, 692px);"
     data-popper-placement="top">Workflow
    <div class="tooltip-arrow" data-popper-arrow></div>
</div>
