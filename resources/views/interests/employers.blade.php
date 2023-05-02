<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Интереси') }}
        </h2>
    </x-slot>

    <div class="py-8 px-4 mx-auto max-w-screen-xl lg:px-6 ">
        <div class="grid gap-8 md:grid-cols-2">
            @foreach ($interests as $interest)
            <div class="items-center bg-gray-50 rounded-lg shadow sm:flex ">
                <a style="width: 200px" href=" {{ route('users.show', $interest->student->user->id) }}">
                    <img class="h-full w-full object-cover object-center" src="{{ $interest->student->user->profile_picture }}" alt="{{ $interest->student->user->name }}" />
                </a>
                <div class="p-5">
                    <h3 class="text-xl font-bold tracking-tight text-gray-900 ">
                        <a href="{{ route('users.show', $interest->student->user->id) }}">{{ $interest->student->user->name }}</a>
                    </h3>
                    <span class="text-gray-500 ">{{ $interest->student->course->name_formatted }}, {{ $interest->student->specialty->education->name }}</span>
                    <p class="mt-3 font-light text-gray-500 ">{{ $interest->student->specialty->name }}</p>
                    <p class="font-light text-gray-500 ">{{ $interest->student->specialty->faculty->university->name }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <div class="mt-2">
        {{ $interests->links() }}
    </div>
</x-app-layout>