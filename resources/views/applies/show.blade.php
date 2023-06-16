<x-app-layout>
    <section class="bg-white flex rounded-xl py-4 px-4 lg:py-8">
        <div>
            <img class="max-w-xs" src="{{ $apply->user->profile_picture }}" alt="{{$apply->user->name}}" />
        </div>
        <div class="ml-6 grow">
            <div class="flex justify-between">
                <h2 class="mb-2 text-xl font-semibold leading-none text-gray-900 md:text-2xl">{{$apply->user->name}}</h2>
                <div class="flex items-center space-x-4">
                    <a href="{{route('users.show', $apply->user->id)}}" class="inline-flex text-white bg-gradient-to-r from-blue-400 via-blue-500 to-blue-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
                        <svg aria-hidden="true" class="inline-flex mr-1 -ml-1 w-5 h-5" fill="none" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <path d="M20 21C20 19.6044 20 18.9067 19.8278 18.3389C19.44 17.0605 18.4395 16.06 17.1611 15.6722C16.5933 15.5 15.8956 15.5 14.5 15.5H9.5C8.10444 15.5 7.40665 15.5 6.83886 15.6722C5.56045 16.06 4.56004 17.0605 4.17224 18.3389C4 18.9067 4 19.6044 4 21M16.5 7.5C16.5 9.98528 14.4853 12 12 12C9.51472 12 7.5 9.98528 7.5 7.5C7.5 5.01472 9.51472 3 12 3C14.4853 3 16.5 5.01472 16.5 7.5Z" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                            </g>
                        </svg>
                        Виж профила
                    </a>
                </div>
            </div>
            <p class=" text-sm leading-none text-gray-500 md:text-base ">{{ $apply->user->student->course->name_formatted }}, {{ $apply->user->student->specialty->education->name }}</p>
            <p class=" text-sm leading-none text-gray-500 md:text-base ">{{ $apply->user->student->specialty->name}}</p>
            <p class="mb-4 text-sm leading-none text-gray-500 md:text-base ">{{ $apply->user->student->specialty->faculty->university->name }}</p>
            <p class="mb-2 font-semibold leading-none text-gray-900 ">Автобиография:</p>
            <p class="mb-4 font-light text-gray-500 sm:mb-5"><a href="{{$apply->file->path}}" download="{{$apply->file->name}}">{{$apply->file->name}}</a></p>
            <p class="mb-2 font-semibold leading-none text-gray-900 ">Мотивационно писмо:</p>
            <p class="mb-4 font-light text-gray-500 sm:mb-5 text-justify">{{ $apply->description }}</p>
            @if($apply->applyStatus->slug == \App\Models\ApplyStatus::AWAITING)
            {!! Form::open(['route'=> ['applies.approve', $apply->id], 'method' => 'put']) !!}
            {!! Form::hidden('status', \App\Models\ApplyStatus::APPROVED) !!}
            <div class="flex items-center space-x-4">
                <button type="submit" class="inline-flex text-white bg-gradient-to-r from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 ">
                    <svg aria-hidden="true" class="mr-1 -ml-1 w-5 h-5" fill="none" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                        <g id="SVGRepo_iconCarrier">
                            <path d="M20 6L9 17L4 12" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                        </g>
                    </svg>
                    Одобри
                </button>
                {!! Form::close() !!}

                {!! Form::open(['route'=> ['applies.reject', $apply->id], 'method' => 'put']) !!}
                {!! Form::hidden('status', \App\Models\ApplyStatus::REJECTED) !!}
                <button type="submit" class="inline-flex text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
                    <svg class=" w-5 h-5 mr-1.5 -ml-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                        <g id="SVGRepo_iconCarrier">
                            <path d="M18 6L6 18M6 6L18 18" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                        </g>
                    </svg>
                    Отхвърли
                </button>
                {!! Form::close() !!}
            </div>
            @endif
        </div>
    </section>
</x-app-layout>