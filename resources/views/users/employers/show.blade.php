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
                <div class="space-x-8 flex justify-between mt-32 md:mt-0 md:justify-center">
                    @role('student')
                    <button class="text-white py-2 px-4 uppercase rounded bg-blue-400 hover:bg-blue-500 shadow hover:shadow-lg font-medium transition transform hover:-translate-y-0.5">
                        Имам интерес
                    </button>
                    @endrole

                    @role('employer')
                    <button class="text-white py-2 px-4 uppercase rounded bg-gray-700 hover:bg-gray-800 shadow hover:shadow-lg font-medium transition transform hover:-translate-y-0.5">
                        Редактирай
                    </button>
                    @endrole
                </div>
            </div>
            <div class="mt-20 text-center border-b pb-12">
                <h1 class="text-4xl font-medium text-gray-700">{{$user->employer->name}}</h1>
                <p class="font-light text-gray-600 mt-3">{{$user->email}}</p>
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