<x-app-layout>
    <div class="p-16">
        <div class="p-8 bg-white shadow mt-24">
            <div class="grid grid-cols-1 md:grid-cols-3">
                <div class="grid grid-cols-3 text-center order-last md:order-first mt-20 md:mt-0">
                    <div>
                        <p class="font-bold text-gray-700 text-xl">{{$user->student->course->name}}</p>
                        <p class="text-gray-400">Курс</p>
                    </div>
                    <div>
                        <p class="font-bold text-gray-700 text-xl">{{$user->student->specialty->education->name}}</p>
                        <p class="text-gray-400">Обучение</p>
                    </div>
                    <div>
                        <p class="font-bold text-gray-700 text-xl">{{$user->student->success}}</p>
                        <p class="text-gray-400">Успех</p>
                    </div>
                </div>
                <div class="relative">
                    <div class="w-48 h-48 bg-indigo-100 mx-auto rounded-full shadow-2xl absolute inset-x-0 top-0 -mt-24 flex items-center justify-center text-indigo-500">
                        <img src="{{ $user->profile_picture }}" alt="{{ $user->name }}" class="rounded-full h-48 w-48 object-cover" />
                        </svg>
                    </div>
                </div>
                <div class="space-x-8 flex justify-between mt-32 md:mt-0 md:justify-center"><button class="text-white py-2 px-4 uppercase rounded bg-blue-400 hover:bg-blue-500 shadow hover:shadow-lg font-medium transition transform hover:-translate-y-0.5"> Connect</button> <button class="text-white py-2 px-4 uppercase rounded bg-gray-700 hover:bg-gray-800 shadow hover:shadow-lg font-medium transition transform hover:-translate-y-0.5"> Message</button> </div>
            </div>
            <div class="mt-20 text-center border-b pb-12">
                <h1 class="text-4xl font-medium text-gray-700">{{$user->name}}, <span class="font-light text-gray-500">27</span></h1>
                <p class="font-light text-gray-600 mt-3">Bucharest, Romania</p>
                <p class="mt-8 text-gray-500">Solution Manager - Creative Tim Officer</p>
                <p class="mt-2 text-gray-500">University of Computer Science</p>
            </div>
            <div class="mt-12 flex flex-col justify-center">
                <p class="text-gray-600 text-center font-light lg:px-16">An artist of considerable range, Ryan — the name taken by Melbourne-raised, Brooklyn-based Nick Murphy — writes, performs and records all of his own music, giving it a warm, intimate feel with a solid groove structure. An artist of considerable range.</p> <button class="text-indigo-500 py-2 px-4  font-medium mt-4"> Show more</button>
            </div>
        </div>
    </div>
</x-app-layout>