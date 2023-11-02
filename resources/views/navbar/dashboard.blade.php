<div class="flex flex-wrap justify-between items-center">
    <div class="flex items-center">
        <!-- Notifications -->
        @if($flag->contains('unread') )
            <span class="hidden md:block relative flex h-3 w-3 -mt-3 -mr-3">
              <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-blue-400 opacity-75"></span>
              <span class="relative inline-flex rounded-full h-3 w-3 bg-blue-500"></span>
            </span>
        @endif
        <!-- Desktop -->
        <button data-tooltip-target="workflow-notification-tooltip" type="button" data-dropdown-toggle="notification-dropdown"
                class="hidden md:block p-2 mr-1 text-gray-500 rounded-lg hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-700 focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600">
            <span class="sr-only">View notifications</span>
            <!-- Bell icon -->
            <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 21">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                      d="M8 3.464V1.1m0 2.365a5.338 5.338 0 0 1 5.133 5.368v1.8c0 2.386 1.867 2.982 1.867 4.175C15 15.4 15 16 14.462 16H1.538C1 16 1 15.4 1 14.807c0-1.193 1.867-1.789 1.867-4.175v-1.8A5.338 5.338 0 0 1 8 3.464ZM4.54 16a3.48 3.48 0 0 0 6.92 0H4.54Z"/>
            </svg>
        </button>

        <!-- Dropdown menu -->
        <div class="hidden overflow-hidden z-50 my-4 w-full md:max-w-md text-base list-none bg-white rounded divide-y divide-gray-100 shadow-lg dark:divide-gray-600 dark:bg-gray-700" id="notification-dropdown">
            <div class="block py-2 px-4 text-base font-medium text-center text-white bg-blue-600 dark:bg-gray-700 dark:text-white">
                @if(!(count($requests) > 0 or count($returned) > 0))
                    {{__("No notifications")}}
                @else
                    {{__("Notifications")}}
                @endif
            </div>
            <div>
                <!-- Notifications for user role -->
                @foreach($requests as $request)
                    <a href="#" class="flex py-3 px-4 border-b hover:bg-gray-100 dark:hover:bg-gray-600 dark:border-gray-600">
                        <div class="flex-shrink-0 mt-4">
                            <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M5 4a4 4 0 0 1 4 4v6M5 4a4 4 0 0 0-4 4v6h8M5 4h9M9 14h10V8a3.999 3.999 0 0 0-2.066-3.5M9 14v5m0-5h4v5m-9-8h2m8-4V1h2"/>
                            </svg>
                        </div>
                        <div class="pl-3 w-full">
                            <div class="text-gray-900 dark:text-white font-semibold text-sm mb-1.5 ">{{$request->name}}</div>
                            <div class="text-xs font-medium text-primary-700 dark:text-white">
                              @if($request->status == 'unread')
                                <span class="bg-green-100 text-green-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-green-400 border border-green-400">
                              @else
                                <span class="bg-gray-100 text-gray-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-gray-400 border border-gray-500">
                              @endif
                                    {{__("Sent")}}
                                </span>
                                {{Carbon\Carbon::createFromTimestamp($request->created)->toDateString()}}
                                | Status:
                              @if($request->state == 'manager_denied' or $request->state == 'fo_denied' or $request->state == 'head_denied')
                                <span class="bg-red-100 text-red-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-red-400 border border-red-400">
                              @else
                                <span class="bg-yellow-100 text-yellow-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-yellow-300 border border-yellow-300">
                              @endif
                                    @switch($request->state)
                                        @case('submitted')
                                            {{__("Submitted")}}
                                            @break
                                    @case('manager_approved')
                                            {{__("Approved by manager")}}
                                            @break
                                    @case('fo_approved')
                                            {{__("Approved by FO")}}
                                            @break
                                    @case('head_approved')
                                            {{__("Approved by Unit head")}}
                                            @break
                                    @endswitch
                                </span>

                            </div>
                        </div>
                    </a>
                @endforeach
                <!-- Returned Notifications -->
                @foreach($returned as $return)
                    <a href="#" class="flex bg-red-200 py-3 px-4 border-b hover:bg-gray-100 dark:hover:bg-gray-600 dark:border-gray-600">
                        <div class="flex-shrink-0 mt-4">
                            <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M5 4a4 4 0 0 1 4 4v6M5 4a4 4 0 0 0-4 4v6h8M5 4h9M9 14h10V8a3.999 3.999 0 0 0-2.066-3.5M9 14v5m0-5h4v5m-9-8h2m8-4V1h2"/>
                            </svg>
                        </div>
                        <div class="pl-3 w-full">
                            <div class="text-gray-900 dark:text-white font-semibold text-sm mb-1.5 ">{{$return->name}}</div>
                            <div class="text-xs font-medium text-primary-700 dark:text-white">
                              @if($return->status == 'unread')
                                    <span class="bg-green-100 text-green-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-green-400 border border-green-400">
                              @else
                                    <span class="bg-gray-100 text-gray-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-gray-400 border border-gray-500">
                              @endif
                                    {{__("Sent")}}
                                    </span>
                                    {{Carbon\Carbon::createFromTimestamp($return->created)->toDateString()}}
                                    | Status:
                              <span class="bg-red-100 text-red-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-red-400 border border-red-400">
                                @switch($return->state)
                                    @case('manager_returned')
                                    {{__("Returned by manager")}}
                                    @break
                                    @case('fo_returned')
                                    {{__("Returned by FO")}}
                                    @break
                                    @case('head_returned')
                                    {{__("Returned by Unit head")}}
                                    @break
                                @endswitch
                              </span>

                            </div>
                        </div>
                    </a>
                @endforeach

            </div>
            <!-- Users request -->
            <div class="block py-2 px-4 text-base font-medium text-center text-white bg-blue-600 dark:bg-gray-700 dark:text-gray-400">
                @if(!count($user_requests) > 0)
                    {{__("No submitted requests")}}
                @else
                    {{__("Your submitted requests")}}
                @endif
            </div>
            <div>
                @foreach($user_requests as $user_request)
                    <a href="#" class="flex py-3 px-4 border-b hover:bg-gray-100 dark:hover:bg-gray-600 dark:border-gray-600">
                        <div class="flex-shrink-0 mt-4">
                            <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                <path stroke="currentColor" stroke-linejoin="round" stroke-width="1" d="M8 8v1h4V8m4 7H4a1 1 0 0 1-1-1V5h14v9a1 1 0 0 1-1 1ZM2 1h16a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1Z"/>
                            </svg>
                        </div>
                        <div class="pl-3 w-full">

                            <div class="text-gray-900 dark:text-white font-semibold text-sm mb-1.5 ">{{$user_request->name}}</div>
                            <div class="text-xs font-medium text-primary-700 dark:text-white">
                              @if($user_request->status == 'unread')
                                  <span class="bg-green-100 text-green-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-green-400 border border-green-400">
                              @else
                                  <span class="bg-gray-100 text-gray-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-gray-400 border border-gray-500">
                              @endif
                                  {{__("Sent")}}
                                  </span>
                                  {{Carbon\Carbon::createFromTimestamp($user_request->created)->toDateString()}}
                                  | Status:
                              @if($user_request->state == 'manager_denied' or $user_request->state == 'fo_denied' or $user_request->state == 'head_denied')
                                   <span class="bg-red-100 text-red-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-red-400 border border-red-400">
                              @elseif ($user_request->state == 'manager_returned' or $user_request->state == 'fo_returned' or $user_request->state == 'head_returned')
                                   <span class="bg-blue-100 text-blue-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-blue-400 border border-blue-400">
                              @else
                                   <span class="bg-yellow-100 text-yellow-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-yellow-300 border border-yellow-300">
                              @endif
                                      @switch($user_request->state)
                                          @case('submitted')
                                            {{__("Submitted")}}
                                          @break
                                          @case('manager_approved')
                                            {{__("Approved by manager")}}
                                          @break
                                          @case('manager_denied')
                                            {{__("Denied by manager")}}
                                          @break
                                          @case('manager_returned')
                                            {{__("Returned by manager")}}
                                          @break
                                          @case('fo_approved')
                                            {{__("Approved by FO")}}
                                          @break
                                          @case('fo_denied')
                                            {{__("Denied by FO")}}
                                          @break
                                          @case('fo_returned')
                                            {{__("Returned by FO")}}
                                          @break
                                          @case('head_approved')
                                            {{__("Approved by Unit head")}}
                                          @break
                                          @case('head_denied')
                                            {{__("Denied by Unit head")}}
                                          @break
                                          @case('head_returned')
                                             {{__("Returned by Unit head")}}
                                          @break
                                      @endswitch
                                </span>

                            </div>
                        </div>
                    </a>
                @endforeach

            </div>
            <!--end Archive -->
        </div>
        <!-- Requestforms -->
        <button data-tooltip-target="workflow-requests-tooltip" type="button" data-dropdown-toggle="apps-dropdown"
                class="hidden md:block p-2 text-gray-500 rounded-lg hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-700 focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600">
            <span class="sr-only">View notifications</span>
            <!-- Icon -->
            <svg style="fill:gray" class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 18">
                <path d="M6.143 0H1.857A1.857 1.857 0 0 0 0 1.857v4.286C0 7.169.831 8 1.857 8h4.286A1.857 1.857 0 0 0 8 6.143V1.857A1.857 1.857 0 0 0 6.143 0Zm10 0h-4.286A1.857 1.857 0 0 0 10 1.857v4.286C10 7.169 10.831 8 11.857 8h4.286A1.857 1.857 0 0 0 18 6.143V1.857A1.857 1.857 0 0 0 16.143 0Zm-10 10H1.857A1.857 1.857 0 0 0 0 11.857v4.286C0 17.169.831 18 1.857 18h4.286A1.857 1.857 0 0 0 8 16.143v-4.286A1.857 1.857 0 0 0 6.143 10Zm10 0h-4.286A1.857 1.857 0 0 0 10 11.857v4.286c0 1.026.831 1.857 1.857 1.857h4.286A1.857 1.857 0 0 0 18 16.143v-4.286A1.857 1.857 0 0 0 16.143 10Z"/>
            </svg>
        </button>
        <!-- Dropdown menu -->
        <div class="hidden overflow-hidden z-50 my-4 max-w-sm text-base list-none bg-white rounded divide-y divide-gray-100 shadow-lg dark:bg-gray-700 dark:divide-gray-600" id="apps-dropdown">
            <div class="block py-2 px-4 text-base font-medium text-center text-gray-700 bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                {{__("Available requests")}}
            </div>
            <div class="grid grid-cols-3 gap-4 p-4">

                <a href="{{route('travel-request-create')}}" class="block p-4 text-center rounded-lg hover:bg-gray-100 dark:hover:bg-gray-600 group">
                    <svg class="mx-auto mb-2 w-5 h-5 text-blue-600 group-hover:text-gray-500 dark:text-gray-400 dark:group-hover:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M12 9V4a3 3 0 0 0-6 0v5m9.92 10H2.08a1 1 0 0 1-1-1.077L2 6h14l.917 11.923A1 1 0 0 1 15.92 19Z"/>
                    </svg>
                    <div class="text-sm font-medium text-blue-600 dark:text-white">Travel Request</div>
                </a>
                <a href="#" class="block p-4 text-center rounded-lg hover:bg-gray-100 dark:hover:bg-gray-600 group">
                    <svg class="mx-auto mb-2 w-5 h-5 text-gray-900 group-hover:text-gray-500 dark:text-gray-400 dark:group-hover:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M1 17V2a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H3a2 2 0 0 0-2 2Zm0 0a2 2 0 0 0 2 2h12M5 15V1m8 18v-4"/>
                    </svg>
                    <div class="text-sm font-medium text-gray-900 dark:text-white">Book Request</div>
                </a>
                <a href="#" class="block p-4 text-center rounded-lg hover:bg-gray-100 dark:hover:bg-gray-600 group">
                    <svg class="mx-auto mb-2 w-5 h-5 text-gray-900 group-hover:text-gray-500 dark:text-gray-400 dark:group-hover:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M6 14H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h16a1 1 0 0 1 1 1v1M5 19h5m-9-9h5m4-4h8a1 1 0 0 1 1 1v12H9V7a1 1 0 0 1 1-1Zm6 8a2 2 0 1 1-4 0 2 2 0 0 1 4 0Z"/>
                    </svg>
                    <div class="text-sm font-medium text-gray-900 dark:text-white">Computer Request</div>
                </a>

            </div>
        </div>
    </div>
</div>
<!-- Tooltips -->
<div id="workflow-notification-tooltip" role="tooltip"
     class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700"
     style="position: absolute; inset: auto auto 0px 0px; margin: 0px; transform: translate(1443px, 692px);"
     data-popper-placement="top">Workflow notifications
    <div class="tooltip-arrow" data-popper-arrow></div>
</div>
<div id="workflow-requests-tooltip" role="tooltip"
     class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700"
     style="position: absolute; inset: auto auto 0px 0px; margin: 0px; transform: translate(1443px, 692px);"
     data-popper-placement="top">Workflow requests
    <div class="tooltip-arrow" data-popper-arrow></div>
</div>
