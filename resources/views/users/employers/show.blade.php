<x-app-layout>
    <div class="p-16">
        <div class="p-8 bg-white shadow mt-24">
            <div class="grid grid-cols-1 md:grid-cols-3">
                <div class="grid grid-cols-2 text-center order-last md:order-first mt-20 md:mt-0">
                    <div>
                        <p class="font-bold text-gray-700 text-xl">{{$user->employer->ads->count()}}</p>
                        <p class="text-gray-400">Обяви</p>
                    </div>
                    <div>
                        <p class="font-bold text-gray-700 text-xl">{{$user->employer->employeeRange->range}}</p>
                        <p class="text-gray-400">Служители</p>
                    </div>
                </div>
                <div class="relative">
                    <div class="w-48 h-48 bg-indigo-100 mx-auto rounded-full shadow-2xl absolute inset-x-0 top-0 -mt-24 flex items-center justify-center text-indigo-500">
                        <img src="{{ $user->employer->logo }}" alt="{{ $user->name }}" class="rounded-full h-48 w-48 object-cover" />
                        </svg>
                    </div>
                </div>
                <div class="space-x-8 flex justify-between mt-32 md:mt-0 md:justify-end">
                    @role('student')
                    <button type="button" class="flex items-center text-white bg-gradient-to-r from-pink-500 via-pink-600 to-pink-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke-width="1.5" stroke="currentColor" class="h-6 w-6 mr-1" x-tooltip="tooltip">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <path d="M9 11L11 13L15.5 8.5M11.9932 5.13581C9.9938 2.7984 6.65975 2.16964 4.15469 4.31001C1.64964 6.45038 1.29697 10.029 3.2642 12.5604C4.75009 14.4724 8.97129 18.311 10.948 20.0749C11.3114 20.3991 11.4931 20.5613 11.7058 20.6251C11.8905 20.6805 12.0958 20.6805 12.2805 20.6251C12.4932 20.5613 12.6749 20.3991 13.0383 20.0749C15.015 18.311 19.2362 14.4724 20.7221 12.5604C22.6893 10.029 22.3797 6.42787 19.8316 4.31001C17.2835 2.19216 13.9925 2.7984 11.9932 5.13581Z" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                            </g>
                        </svg>
                        Имам интерес
                    </button>
                    @endrole

                    @role('employer')
                    <a href="{{route('profile.edit')}}" class="flex items-center text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke-width="1.5" stroke="currentColor" class="h-6 w-6 mr-1" x-tooltip="tooltip">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <path d="M18 9.99982L14 5.99982M2.5 21.4998L5.88437 21.1238C6.29786 21.0778 6.5046 21.0549 6.69785 20.9923C6.86929 20.9368 7.03245 20.8584 7.18289 20.7592C7.35245 20.6474 7.49955 20.5003 7.79373 20.2061L21 6.99982C22.1046 5.89525 22.1046 4.10438 21 2.99981C19.8955 1.89525 18.1046 1.89524 17 2.99981L3.79373 16.2061C3.49955 16.5003 3.35246 16.6474 3.24064 16.8169C3.14143 16.9674 3.06301 17.1305 3.00751 17.302C2.94496 17.4952 2.92198 17.702 2.87604 18.1155L2.5 21.4998Z" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                            </g>
                        </svg>
                        <span>Редактирай</span>
                    </a>
                    @endrole
                </div>
            </div>
            <div class="mt-20 text-center border-b pb-12">
                <h1 class="text-4xl font-medium text-gray-700">{{$user->employer->name}}</h1>
                <p class="font-light text-gray-600 mt-3">
                    {{$user->name}}
                </p>
                <p class="font-light text-gray-600 mt-3">
                    {{$user->email}}
                </p>
                <p class="mt-8 text-gray-500">Solution Manager - Creative Tim Officer</p>
                <p class="mt-2 text-gray-500">University of Computer Science</p>
            </div>
            <div class="mt-12 flex flex-col justify-center">
                <p class="text-gray-600 text-center font-light lg:px-16">
                    {{ $user->employer->description }}
                </p>
            </div>
        </div>
    </div>
</x-app-layout>