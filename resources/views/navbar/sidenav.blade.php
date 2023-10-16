<div class="flex h-screen overflow-hidden bg-white dark:bg-gray-800 dark:text-white">
    <!-- nav:collection:pages -->
    @foreach (\Statamic\Statamic::tag('nav:main')->sort('order')->fetch() as $entry)
        @if($entry['children'])
            @foreach(collect($entry['children']) as $child)
                @if($child['is_current'])
                    @foreach(collect($child['children']) as $sec_child)
                        @if(!$sec_child['children'])
                            @if($loop->first)
                                <div class="hidden md:flex md:flex-shrink-0">
                                    <div class="flex flex-col w-64">
                                        <div class="flex flex-col flex-grow pt-3 overflow-y-auto bg-white border-r dark:bg-gray-800 dark:text-white">
                                            <div class="flex flex-col flex-grow px-3 mt-3">
                                                <nav class="flex-1 space-y-1 bg-white dark:bg-gray-800 dark:text-white">
                                                    <ul>
                                                        @foreach (\Statamic\Statamic::tag('nav:main')->sort('order')->fetch() as $entry)
                                                            @if($entry['children'])
                                                                @foreach(collect($entry['children']) as $child)
                                                                    @if($child['is_current'])
                                                                        @foreach(collect($child['children']) as $sec_child)
                                                                            @if(!$sec_child['children'])
                                                                                <li>
                                                                                    <a class="inline-flex items-center w-full px-4 py-2 mt-1 text-sm text-gray-900 transition duration-200 ease-in-out
                                                                                            transform rounded-lg focus:shadow-outline hover:bg-gray-100 hover:scale-95 hover:text-blue-500 dark:text-white"
                                                                                            href="{{ $sec_child['url'] }}">
                                                                                            <span class="ml-4">
                                                                                                {{ $sec_child['title'] }}
                                                                                            </span>
                                                                                    </a>
                                                                                </li>
                                                                            @else
                                                                                <li>
                                                                                    <div x-data="{ open: false }">
                                                                                        <button class="inline-flex items-start justify-between w-full px-4 py-2 mt-1 text-sm text-gray-900 transition duration-200 ease-in-out transform rounded-lg
                                                                                                focus:shadow-outline hover:bg-gray-100 hover:scale-95 hover:text-blue-500 group dark:text-white hover:dark:text-blue-500" @click="open = ! open">
                                                                                            <span class="ml-2 text-sm">
                                                                                              {{ $sec_child['title'] }}
                                                                                            </span>
                                                                                            <svg style="fill:gray" viewBox="0 0 20 20" :class="{'rotate-180': open, 'rotate-0': !open}" class="inline w-5 h-5 ml-auto transition-transform duration-200 transform group-hover:text-accent rotate-0">
                                                                                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                                                                            </svg>
                                                                                        </button>
                                                                                        <div class="p-2 pl-6 -px-px" x-show="open" @click.outside="open = false" style="display: none;">
                                                                                            <ul>
                                                                                                @foreach(collect($sec_child['children']) as $third_child)
                                                                                                    <li>
                                                                                                        <a href="{{ $third_child['url'] }}" title="#" class="inline-flex items-center w-full p-2 pl-3 text-sm
                                                                                                                text-gray-500 rounded-lg hover:text-blue-500 group hover:bg-gray-50 dark:text-white hover:dark:text-blue-500">
                                                                                                            <span class="inline-flex items-center w-full">
                                                                                                                <ion-icon class="w-4 h-4 md hydrated" name="document-outline" role="img" aria-label="document outline"></ion-icon>
                                                                                                                <span class="ml-4">
                                                                                                                    {{ $third_child['title'] }}
                                                                                                                </span>
                                                                                                            </span>
                                                                                                        </a>
                                                                                                    </li>
                                                                                                @endforeach
                                                                                            </ul>
                                                                                        </div>
                                                                                    </div>
                                                                                </li>
                                                                            @endif
                                                                        @endforeach
                                                                    @endif
                                                                @endforeach
                                                            @endif
                                                        @endforeach
                                                    </ul>
                                                </nav>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            @endif
                        @endif
                    @endforeach
                @endif
            @endforeach
        @endif
    @endforeach
    @include('partials.page')
</div>
