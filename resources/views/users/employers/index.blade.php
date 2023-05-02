<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Работодатели') }}
        </h2>
    </x-slot>
    <section class="bg-white rounded-xl">
        <div class="py-8 px-4 mx-auto max-w-screen-xl lg:px-6 ">
            <div class="grid gap-8 md:grid-cols-2">
                @foreach ($employers as $employer)
                <div class="items-center bg-gray-50 rounded-lg shadow sm:flex ">
                    <a style="width: 200px" href=" {{ route('users.show', $employer->user->id) }}">
                        <img class="h-full w-full object-cover object-center" src="{{ $employer->logo }}" alt="{{ $employer->name }}" />
                    </a>
                    <div class="p-5">
                        <h3 class="text-xl font-bold tracking-tight text-gray-900 ">
                            <a href="{{ route('users.show', $employer->user->id) }}">{{ $employer->name }}</a>
                        </h3>
                        <span class="text-gray-500">{{ $employer->employeeRange->name }}</span>
                        <p class="mt-3 font-light text-gray-500 ">{{ $employer->email }}</p>
                        <p class="font-light text-gray-500 ">{{ $employer->phone }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    <div class="mt-2">
        {{ $employers->links() }}
    </div>
</x-app-layout>