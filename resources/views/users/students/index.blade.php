<x-app-layout>
    <section class="bg-white rounded-xl">
        <div class="py-8 px-4 mx-auto max-w-screen-xl lg:px-6 ">
            <div class="grid gap-8 md:grid-cols-2">
                @foreach ($students as $student)
                <div class="items-center bg-gray-50 rounded-lg shadow sm:flex ">
                    <a style="width: 200px" href=" {{ route('users.show', $student->user->id) }}">
                        <img class="h-full w-full object-cover object-center" src="{{ $student->user->profile_picture }}" alt="{{ $student->user->name }}" />
                    </a>
                    <div class="p-5">
                        <h3 class="text-xl font-bold tracking-tight text-gray-900 ">
                            <a href="#">{{ $student->user->name }}</a>
                        </h3>
                        <span class="text-gray-500 ">{{ $student->course->name_formatted }}, {{ $student->specialty->education->name }}</span>
                        <p class="mt-3 font-light text-gray-500 ">{{ $student->specialty->name }}</p>
                        <p class="font-light text-gray-500 ">{{ $student->specialty->faculty->university->name }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    <div class="mt-2">
        {{ $students->links() }}
    </div>
</x-app-layout>