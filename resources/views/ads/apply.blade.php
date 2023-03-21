<x-app-layout>
    <section class="bg-white rounded-xl">
        <div class="max-w-2xl px-4 py-8 mx-auto lg:py-16">
            <h2 class="mb-4 text-xl font-bold text-gray-900 ">Подаване на кандидатура</h2>
            {!! Form::open(['route' => ['applies.store', $ad->id], 'method' => 'POST', 'files' => true]) !!}
            {!! Form::hidden('ad_id', $ad->id) !!}
            <div class="grid gap-4 mb-4 sm:grid-cols-2 sm:gap-6 sm:mb-5">
                <div class="sm:col-span-2">
                    <label class="block mb-2 text-sm font-medium text-gray-900 " for="file_input">Прикачете своята автобиография:</label>
                    {!! Form::file('file', ['class' => "block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none"]) !!}
                    <label for="description" class="block mb-2 text-sm font-medium text-gray-900 mt-5">Мотивационно писмо:</label>
                    {!! Form::textarea('description', null, ["class" => "block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 ", "placeholder"=>"Напишете защо според вас сте подходящи за тази позиция..."]) !!}
                </div>
            </div>
            <div class="flex items-center space-x-4">
                <button type="submit" class=" text-white bg-gradient-to-r from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
                    Изпращане
                </button>
            </div>
            {!! Form::close() !!}
        </div>
    </section>
</x-app-layout>