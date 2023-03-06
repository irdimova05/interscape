<x-app-layout>
    <div class="py-8">
        <div class="mb-4">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4 flex">
                <article class="md:gap-8 md:grid md:grid-cols-3">
                    <div>
                        <div class="items-center mb-6 space-x-4">
                            <img a href="{{ route('users.show', $ad->employer->id) }}" class="w-25 h-25" img src=" {{ $ad->employer->logo }}" alt="">
                        </div>
                    </div>
                    <div class="col-span-2 mt-6 md:mt-0">
                        <div>
                            <div class="flex justify-between">
                                <div class="pr-4">
                                    <h4 class="text-xl font-bold text-gray-900 ">{{ $ad->title }}</h4>
                                    <div a href="{{ route('users.show', $ad->employer->id) }}" class="mb-5 text-gray-500">
                                        <p>{{ $ad->employer->name }}</p>
                                    </div>
                                </div>
                                <div class="flex items-center">
                                    <button type="button" class="flex text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
                                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke-width="1.5" stroke="currentColor" class="h-6 w-6 mr-1" x-tooltip="tooltip">
                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                            <g id="SVGRepo_iconCarrier">
                                                <path d="M2 10H22V8.2C22 7.0799 22 6.51984 21.782 6.09202C21.5903 5.7157 21.2843 5.40974 20.908 5.21799C20.4802 5 19.9201 5 18.8 5H5.2C4.0799 5 3.51984 5 3.09202 5.21799C2.7157 5.40973 2.40973 5.71569 2.21799 6.09202C2 6.51984 2 7.0799 2 8.2V15.8C2 16.9201 2 17.4802 2.21799 17.908C2.40973 18.2843 2.71569 18.5903 3.09202 18.782C3.51984 19 4.0799 19 5.2 19H11M14.5 21L16.525 20.595C16.7015 20.5597 16.7898 20.542 16.8721 20.5097C16.9452 20.4811 17.0147 20.4439 17.079 20.399C17.1516 20.3484 17.2152 20.2848 17.3426 20.1574L21.5 16C22.0523 15.4477 22.0523 14.5523 21.5 14C20.9477 13.4477 20.0523 13.4477 19.5 14L15.3426 18.1574C15.2152 18.2848 15.1516 18.3484 15.101 18.421C15.0561 18.4853 15.0189 18.5548 14.9903 18.6279C14.958 18.7102 14.9403 18.7985 14.905 18.975L14.5 21Z" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                            </g>
                                        </svg>
                                        <div class="mt-0.5">
                                            <span>Редактирай</span>
                                        </div>
                                    </button>
                                    <button type="button" class="text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 flex">
                                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke-width="1.5" stroke="currentColor" class="h-6 w-6 mr-1" x-tooltip="tooltip">
                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                            <g id="SVGRepo_iconCarrier">
                                                <path d="M12 8V12M12 16H12.01M22 12C22 17.5228 17.5228 22 12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12Z" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                            </g>
                                        </svg>
                                        <div class="mt-0.5">
                                            <span>Докладвай</span>
                                        </div>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <p class="mb-2 font-light text-gray-500 ">{{ $ad->description}}</p>
                    </div>
                </article>
            </div>
        </div>
    </div>
</x-app-layout>