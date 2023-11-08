<div wire:poll.keep-alive>
    @if(count($dashboard) > 0)
        <span class="md:hidden relative flex h-2 w-2 -mt-3 ml-32">
            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-blue-400 opacity-75"></span>
            <span class="relative inline-flex rounded-full h-2 w-2 bg-blue-500"></span>
        </span>
    @endif
</div>
