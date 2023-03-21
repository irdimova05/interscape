<x-app-layout>
    <div class="items-stretch">
        <div class="relative mb-4 flex justify-end">
            {!! Form::select('ads', $ads, null, [
            'class' => "w-80 p-2.5 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block",
            'placeholder' => "Търси по обява"
            ]) !!}
        </div>
    </div>
    <section class="bg-white rounded-xl">
        <div class="py-8 px-4 mx-auto max-w-screen-xl lg:px-6 ">
            <div class="grid gap-8">
                @foreach ($applies as $apply)
                <div class="items-center bg-gray-50 rounded-lg shadow sm:flex flex grid-cols-2">
                    <a style="width: 200px" href=" {{ route('applies.show', $apply->id) }}">
                        <img class="h-full w-full object-cover object-center" src="{{ $apply->user->profile_picture }}" alt="{{ $apply->user->name }}" />
                    </a>
                    <div class="p-5">
                        <h3 class="text-xl font-bold tracking-tight text-gray-900 ">
                            <a href="{{ route('applies.show', $apply->id) }}">{{ $apply->user->name }}</a>
                        </h3>
                        <span class="text-gray-500 ">{{ $apply->user->student->course->name_formatted, $apply->user->student->specialty->education->name }}</span>
                        <p class="mt-3 font-light text-gray-500 ">{{ $apply->user->student->specialty->name }}</p>
                        <p class="font-light text-gray-500 ">{{ $apply->user->student->specialty->faculty->university->name }}</p>
                    </div>
                </div>

                @endforeach
            </div>
        </div>
    </section>
    <div class="mt-2">
        {{ $applies->links() }}
    </div>
</x-app-layout>