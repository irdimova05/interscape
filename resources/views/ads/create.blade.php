<x-app-layout>
    <section class="bg-white rounded-xl">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-8 lg:py-12">
            <h2 class="mb-4 text-xl font-bold text-gray-900 ">Добавете нова обява</h2>

            {!! Form::open(['route' => 'ads.store', 'method' => 'POST']) !!}
            <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                <div class="sm:col-span-2">
                    <x-input-label for="title" class="block mb-2 text-sm font-medium text-gray-900 " required>Име на обявата:</x-input-label>
                    {!! Form::text('title', null, ['class'=>"bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5", 'placeholder'=>"Въведете име на обявата" ]) !!}
                    <x-input-error :messages="$errors->get('title')" class="mt-2" />
                </div>
                <div class="w-full">
                    <x-input-label for="jobType" class="block mb-2 text-sm font-medium text-gray-900 " required>Вид:</x-input-label>
                    {!! Form::select('jobType', $jobTypes, null, ['class' => "bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5"]) !!}
                </div>
                <div class="w-full">
                    <x-input-label for="salary" class="block mb-2 text-sm font-medium text-gray-900 ">Заплащане:</x-input-label>
                    {!! Form::number('salary', 0, ['class'=>"bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"]) !!}
                    <x-input-error :messages="$errors->get('salary')" class="mt-2" />
                </div>
                <div class="sm:col-span-2">
                    <x-input-label for="category" class="block mb-2 text-sm font-medium text-gray-900 " required>Категория:</x-input-label>
                    {!! Form::select('category', $categories, null, ['class' => "bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5"]) !!}
                </div>
                <div class="sm:col-span-2">
                    <x-input-label for="description" class="block mb-2 text-sm font-medium text-gray-900 " required>Описание:</x-input-label>
                    {!! Form::textarea('description', null, ["class" => "block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500", "placeholder"=>"Описание на обявата"]) !!}
                    <x-input-error :messages="$errors->get('description')" class="mt-2" />
                </div>
                <div class=" sm:col-span-2 flex justify-end">
                    <button type="submit" class=" text-white bg-gradient-to-r from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
                        {{ __('Създай') }}
                    </button>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </section>
</x-app-layout>