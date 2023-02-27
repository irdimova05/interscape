<x-app-layout>
    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex mb-2">
            <button class=" text-white bg-gradient-to-r from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
                {{ __('Създай') }}
            </button>
            <div class="flex">
                <x-input-label for="search" :value="__('Търси по име:')" />
                <x-text-input id="search" class="" type="text" name="search" :value="old('search')"/>
            </div>
        </div>

        @foreach($users as $user)
        <div class="mb-4">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4 flex">
                    <div class="grow">
                        <h2 class="mb-3 text-3xl font-extrabold tracking-tight text-gray-900">{{ $user->name }}</h2>

                    </div>

                </div>
            </div>
        </div>
        @endforeach
    </div>
</x-app-layout>