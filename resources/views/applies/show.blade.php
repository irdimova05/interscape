<x-app-layout>
    <section class="bg-white flex rounded-xl py-4 px-4 lg:py-8">
        <div>
            <img class="max-w-xs" src="{{ $apply->user->profile_picture }}" alt="{{$apply->user->name}}" />
        </div>
        <div class="ml-6 grow">
            <div class="flex justify-between">
                <h2 class="mb-2 text-xl font-semibold leading-none text-gray-900 md:text-2xl">{{$apply->user->name}}</h2>
                <a href="{{route('users.show', $apply->user->id)}}" class="inline-flex text-white bg-gradient-to-r from-blue-400 via-blue-500 to-blue-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">Виж профила</a>
            </div>
            <p class=" text-sm leading-none text-gray-500 md:text-base ">{{ $apply->user->student->course->name_formatted }}, {{ $apply->user->student->specialty->education->name }}</p>
            <p class=" text-sm leading-none text-gray-500 md:text-base ">{{ $apply->user->student->specialty->name}}</p>
            <p class="mb-4 text-sm leading-none text-gray-500 md:text-base ">{{ $apply->user->student->specialty->faculty->university->name }}</p>
            <p class="mb-2 font-semibold leading-none text-gray-900 ">Автобиография:</p>
            <p class="mb-4 font-light text-gray-500 sm:mb-5"><a href="{{$apply->file->path}}" download="{{$apply->file->name}}">{{$apply->file->name}}</a></p>
            <p class="mb-2 font-semibold leading-none text-gray-900 ">Мотивационно писмо:</p>
            <p class="mb-4 font-light text-gray-500 sm:mb-5 text-justify">{{ $apply->description }}</p>
            @if($apply->apply_status_id == 3)
            <div class="flex items-center space-x-4">
                <button type="button" class="inline-flex text-white bg-gradient-to-r from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 ">
                    <svg aria-hidden="true" class="mr-1 -ml-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z"></path>
                        <path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd"></path>
                    </svg>
                    Одобри
                </button>
                <button type="button" class="inline-flex text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
                    <svg aria-hidden="true" class="w-5 h-5 mr-1.5 -ml-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                    </svg>
                    Отхвърли
                </button>
            </div>
            @endif
        </div>
    </section>
</x-app-layout>