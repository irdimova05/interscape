<x-app-layout>
    <div class="py-8">
        <div class="mb-4">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4 flex">
                <article class="md:gap-8 md:grid md:grid-cols-3">
                    <div>
                        <div class="items-center mb-6 space-x-4">
                            <img class="w-25 h-25" img src=" {{ $ad->employer->logo }}" alt="">
                            <div class="space-y-1 font-bold mt-6">
                            </div>
                        </div>
                    </div>
                    <div class="col-span-2 mt-6 md:mt-0">
                        <div class="flex justify-between">
                            <div class="pr-4">
                                <h4 class="text-xl font-bold text-gray-900 ">{{ $ad->title }}</h4>
                            </div>
                            <div>
                                <button type="button" class="text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 flex">
                                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke-width="1.5" stroke="currentColor" class="h-6 w-6 mr-1" x-tooltip="tooltip">
                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                        <g id="SVGRepo_iconCarrier">
                                            <path d="M12 8V12M12 16H12.01M22 12C22 17.5228 17.5228 22 12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12Z" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                        </g>
                                    </svg>
                                    <div class="mt-0.5">
                                        <p>Докладвай обявата</p>
                                    </div>
                                </button>
                            </div>
                        </div>
                        <div class="mb-5">
                            <p>{{ $ad->employer->name }}</p>
                        </div>
                        <p class="mb-2 font-light text-gray-500 ">{{ $ad->description}}</p>
                    </div>
                </article>
            </div>
        </div>
    </div>
</x-app-layout>