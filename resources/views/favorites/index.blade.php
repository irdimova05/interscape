<x-app-layout>
    @foreach($favorites as $favorite)
    <div class="mb-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4 flex">
                <div class="grow">
                    <div class="flex">
                        <h2 class="mb-3 text-3xl font-extrabold tracking-tight text-gray-900">{{ $favorite->ad->title }}</h2>
                    </div>
                    <p class="mb-3 text-gray-500">{{ $favorite->ad->employer->name }}</p>
                    <a href="{{ route('ads.show', $favorite->ad->id) }}" class="inline-flex items-center font-medium text-blue-600 hover:text-blue-800">
                        Разгледай обявата
                        <svg class="w-6 h-6 ml-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                    </a>
                </div>
                <div class="w-40 flex">
                    <img src=" {{ $favorite->ad->employer->logo }}" alt="{{ $favorite->ad->employer->name }}" />
                </div>
            </div>
        </div>
    </div>
    @endforeach
</x-app-layout>