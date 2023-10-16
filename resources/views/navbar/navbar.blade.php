
<div class="w-full mx-auto bg-white border-b 2xl:max-w-7xl">
    <div x-data="{ open: false }" class="relative flex flex-col w-full p-5 mx-auto bg-white md:items-center md:justify-between md:flex-row md:px-6 lg:px-8 dark:border-gray-600 dark:bg-gray-900">
        <div class="flex flex-row items-center justify-between lg:justify-start">
            <a class="text-lg tracking-tight text-black focus:outline-none focus:ring lg:text-2xl dark:text-white" href="/">
                <span class="lg:text-lg focus:ring-0">
                    {{__('DSVIntranet')}}
                </span>
            </a>
            <button @click="open = !open" class="inline-flex items-center justify-center p-2 text-gray-400 hover:text-black focus:outline-none focus:text-black md:hidden dark:text-white">
                <svg class="w-6 h-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                    <path :class="{'hidden': open, 'inline-flex': !open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    <path :class="{'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        <nav :class="{'flex': open, 'hidden': !open}" class="flex-col items-center flex-grow hidden md:pb-0 md:flex md:justify-end md:flex-row">
        <!-- nav:collection:pages -->
        @foreach (\Statamic\Statamic::tag('nav:main')->sort('order')->fetch() as $entry)
            @if(!$entry['children'])
                    <a class="px-2 py-2 text-normal text-gray-900 lg:px-6 md:px-3 hover:text-blue-600 dark:text-white @if ($entry['is_parent'] || $entry['is_current']) font-semibold text-blue-500  @endif"
                       href="{{ $entry['url']->value() }}">
                        {{ $entry['title']->value() }}
                    </a>
            @else
                <div class="order-last md:order-none" x-data="{ openMobileMenu: false }" x-on:click.away="openMobileMenu = false">
                    <div class="relative">
                        <nav class="relative flex items-center justify-around w-full sm:h-10">
                            <div class="flex items-center justify-between flex-1">
                                <div class="flex items-center -mr-2" x-on:click="openMobileMenu = !openMobileMenu">
                                    <button type="button" class="flex flex-row items-center w-full px-4 py-2 mt-2 text-normal text-left
                                    text-gray-900 md:w-auto md:inline md:mt-0 hover:text-blue-600
                                    focus:outline-none focus:shadow-outline dark:text-white"
                                            id="main-menu" aria-label="Main menu" aria-haspopup="true">
                                    <span>
                                      {{__($entry['title']->value())}}
                                    </span>
                                        <svg style="fill:gray" viewBox="0 0 20 20" :class="{'rotate-180': open, 'rotate-0': !open}" class="inline w-4 h-4 mt-1 ml-1 transition-transform duration-200 transform rotate-0 md:-mt-1">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </nav>
                    </div>
                    <div x-on:click="openMobileMenu = false" x-transition:enter="transition ease-out duration-150" x-transition:enter-start="opacity-0 transform scale-95" x-transition:enter-end="opacity-100 transform scale-100" x-transition:leave="transition ease-in duration-100" x-transition:leave-start="opacity-100 transform scale-100" x-transition:leave-end="opacity-0 transform scale-95" :class="{'translate-y-0 shadow-md duration-150': openMobileMenu, '-translate-y-full': ! openMobileMenu}" class="fixed inset-0 top-0 z-40 h-screen overflow-y-auto transition origin-top transform -translate-y-full">
                        <div class="relative overflow-hidden bg-white shadow-xl lg:bg-transparent" role="menu" aria-orientation="vertical" aria-labelledby="main-menu">
                            <div class="bg-white dark:bg-gray-900 border-y">
                                <div class="grid px-4 py-6 mx-auto sm:grid-cols-2 2xl:max-w-7xl gap-y-6 sm:gap-8 sm:px-6 sm:py-8 lg:grid-cols-3 lg:px-8 lg:py-12 xl:py-16">
                                    @foreach(collect($entry['children'])->chunk(5) as $chunk)
                                        <div class="grid grid-cols-1 gap-3 p-2 lg:p-0">
                                            @foreach($chunk as $child)
                                                <a href="{{$child['url']}}" class="flex flex-col justify-between p-3 -m-3 transition duration-500 ease-in-out transform bg-transparent hover:bg-blue-100">
                                                    <div class="relative">
                                                        <div>
                                                            {{--}}
                                                            <div class="absolute flex items-center justify-center w-12 h-12 text-blue-500 rounded-xl bg-gray-50">
                                                                {!! $child['icon_field'] !!}
                                                            </div>
                                                            {{--}}
                                                            <p class="mt-4 ml-16 text-base font-medium text-blue-700">
                                                                {!! $child['title'] !!}
                                                                <svg class="w-2.5 h-2.5 inline-flex" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                                                    <path d="M5.27921 2L10.9257 7.64645C11.1209 7.84171 11.1209 8.15829 10.9257 8.35355L5.27921 14" stroke="currentColor" stroke-width="2" stroke-linecap="round"></path>
                                                                </svg>
                                                            </p>

                                                        </div>
                                                        <div class="mt-2 ml-16 text-sm text-gray-500 dark:text-white">
                                                            {!! $child['text_field'] !!}
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
                <!--menu-->
            @endif
        @endforeach
        <livewire:search />
        </nav>
    </div>
</div>
