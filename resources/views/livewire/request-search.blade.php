<div>
    <div class="px-4 space-y-4 mt-8">
        <form method="get">
            <input class="border-solid border border-gray-300 p-2 w-full md:w-1/4"
                   type="text" placeholder="Search Requests" wire:model="term"/>
        </form>
        <div wire:loading>Searching...</div>
        <div wire:loading.remove>
            <!--
                notice that $term is available as a public
                variable, even though it's not part of the
                data array
            -->
            @if ($term == "")
                <div class="text-gray-500 text-sm">
                    Enter a term to search.
                </div>
            @else
                @if($trs->isEmpty())
                    <div class="text-gray-500 text-sm">
                        No matching result was found.
                    </div>
                @else
                    @foreach($trs as $tr)
                        <div>
                            <h3 class="text-lg text-gray-900 text-bold">{{$tr->name}}</h3>
                            <p class="text-gray-500 text-sm"></p>
                            <p class="text-gray-500"></p>
                        </div>
                    @endforeach
                @endif
            @endif
        </div>
    </div>
    <div class="px-4 mt-4">

    </div>
</div>
