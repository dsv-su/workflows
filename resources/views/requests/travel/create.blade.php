@extends('layouts.app')
@include('dsvheader')
@include('navbar.navbar')
<section class="bg-white dark:bg-gray-900">
    <div class="max-w-2xl px-4 py-8 mx-auto lg:py-16">
        <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">{{ __("Duty Travel Request") }}</h2>
        <form method="post" action="{{route('travel-submit')}}">
            @csrf
            <div class="grid gap-4 mb-4 sm:grid-cols-2 sm:gap-6 sm:mb-5">
                <!--Name-->
                <div class="w-full">
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __("Name") }}<span class="text-red-600"> *</span></label>
                    <input type="text" name="name" id="project" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                           value="{{ old('name') ? old('name'): $name ?? '' }}" placeholder="Name" required="">
                </div>
                <!-- Purpose-->
                <div class="sm:col-span-2">
                    <label for="purpose" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __("Purpose of the mission with the web address of the conference") }}</label>
                    <textarea id="purpose" rows="4" name="purpose"
                              class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Write a product description here...">
                    {{ old('purpose') ? old('purpose'): $purpose ?? '' }}
                    </textarea>

                </div>
                <!-- Project -->
                <div class="w-full">
                    <label for="project" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __("Project") }}<span class="text-red-600"> *</span></label>
                    <input type="text" name="project" id="project" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" value="{{ old('project') ? old('project'): $project ?? '' }}" placeholder="Project name" required="">
                </div>
                <!--Country-->
                <div>
                    <label for="country" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __("Country") }}<span class="text-red-600"> *</span></label>
                    <select id="country" name="country"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                        @foreach($countries as $country)
                            <option selected="" value="{{$country->country}}">{{$country->country}}
                            </option>
                        @endforeach
                    </select>
                </div>
                <!-- Projectleader -->
                <div>
                    <label for="project_leader" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __("Project leader") }}<span class="text-red-600"> *</span></label>
                    <select id="project_leader" name="project_leader"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                        @foreach($projectleaders as $projectleader)
                            <option value="{{$projectleader->id}}">{{$projectleader->name}}</option>
                        @endforeach
                    </select>
                </div>
                <!--Unithead-->
                <div>
                    <label for="unit_head" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __("Unit head") }}<span class="text-red-600"> *</span></label>
                    <select id="unit_head" name="unit_head"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                        @foreach($unitheads as $unithead)
                            <option value="{{$unithead->id}}">{{$unithead->name}}</option>
                        @endforeach
                    </select>
                </div>
                <!--Paper accepted -->
                <div>
                    <label for="paper" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __("Paper accepted") }}</label>
                    <select id="paper" name="paper"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                        <option selected="" value="0">No</option>
                        <option value="1">Yes</option>
                    </select>
                </div>
                <!--Contribution -->
                <div class="w-full">
                    <label for="brand" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __("I have requested contribution from") }}</label>
                    <input type="text" id="contribution" name="contribution"
                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                           value="{{ old('contribution') ? old('contribution'): $contribution ?? '' }}"
                           placeholder="{{ __("Contribution") }}">
                </div>
                <!--Other reason-->
                <div class="sm:col-span-2">
                    <label for="purpose" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __("Other reason. Justify") }}</label>
                    <textarea id="reason" rows="2"  name="reason"
                              class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Write a product description here...">
                    {{ old('reason') ? old('reason'): $reason ?? '' }}
                    </textarea>
                </div>

                <!--Departure return-->
                <div date-rangepicker datepicker-format="dd/mm/yyyy" class="sm:col-span-2 inline-flex items-center">
                    <span class="mx-4 text-gray-500">{{__("From")}}</span>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg style="fill:blue" class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                            </svg>
                        </div>
                        <input name="start" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Select date start">
                    </div>
                    <span class="mx-4 text-gray-500">{{__("To")}}</span>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg style="fill:blue" class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                            </svg>
                        </div>
                        <input name="end" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Select date end">
                    </div>
                </div>


            </div>
            <div class="mt-6 flex items-center justify-end gap-x-6">
                <button type="button" class="text-sm font-semibold leading-6 text-gray-900">Cancel</button>
                <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Send request</button>
            </div>
        </form>
    </div>
</section>
@include('layouts.darktoggler')
