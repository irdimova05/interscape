<x-app-layout>
    <section class="bg-white rounded-xl">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-8 lg:py-12">
            <h2 class="mb-4 text-xl font-bold text-gray-900 ">Редактирай обява</h2>

            {!! Form::open(['route' => ['ads.update', $ad->id], 'method' => 'PUT']) !!}
            <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                <div class="sm:col-span-2">
                    <label for="title" class="block mb-2 text-sm font-medium text-gray-900 ">Име на обявата:</label>
                    {!! Form::text('title', $ad->title, ['class'=>"bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5", 'placeholder'=>"Въведете име на обявата" ]) !!}
                    <x-input-error :messages="$errors->get('title')" class="mt-2" />
                </div>
                <div class="w-full">
                    <label for="jobType" class="block mb-2 text-sm font-medium text-gray-900 ">Вид:</label>
                    {!! Form::select('jobType', $jobTypes, $ad->job_type_id, ['class' => "bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5"]) !!}
                </div>
                <div class="w-full">
                    <label for="salary" class="block mb-2 text-sm font-medium text-gray-900 ">Заплащане:</label>
                    {!! Form::number('salary', $ad->salary, ['class'=>"bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"]) !!}
                    <x-input-error :messages="$errors->get('salary')" class="mt-2" />
                </div>
                <div class="sm:col-span-2">
                    <label for="category" class="block mb-2 text-sm font-medium text-gray-900 ">Категория:</label>
                    {!! Form::select('category', $categories, $ad->ad_category_id, ['class' => "bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5"]) !!}
                </div>
                <div class="sm:col-span-2">
                    <label for="description" class="block mb-2 text-sm font-medium text-gray-900 ">Описание:</label>
                    {!! Form::textarea('description', $ad->description, ["class" => "block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500", "placeholder"=>"Описание на обявата"]) !!}
                    <x-input-error :messages="$errors->get('description')" class="mt-2" />
                </div>
                <div class=" sm:col-span-2 flex justify-end">
                    <button type="submit" class=" text-white bg-gradient-to-r from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
                        {{ __('Запази') }}
                    </button>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </section>
</x-app-layout>