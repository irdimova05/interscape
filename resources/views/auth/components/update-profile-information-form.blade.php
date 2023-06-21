<section>
    <header>
        <h3 class="text-lg font-medium text-gray-900 mb-2">
            {{ __('За да можете да използвате платформата, е необходимо да довършите вашия профил.') }}
        </h3>
        <h2 class="text-lg font-medium text-gray-900 mb-2">
            {{ __('Информация за профила') }}
        </h2>

        @role('employer')
        <p class="text-sm text-gray-600 mb-8">
            {{ __('Всички данни са видими за потребителите, с изключение на вашите лични имена и имейл.') }}
        </p>
        @endrole
    </header>

    {!! Form::open(['route'=>'profile.update', 'method'=>'post', 'files'=>true], ['class'=>"mt-6 space-y-6"]) !!}

    <div class="grid grid-cols-2">

        <div>
            @unlessrole('employer')
            <div class="justify-center items-center">
                <div>
                    <x-input-label for="name" :value="__('Име:')" required />
                    <x-text-input id="name" name="name" type="text" class="mt-1 block w-full mb-3 " :value=" old('name', null)" required autofocus autocomplete="off" />
                    <x-input-error class="mt-2" :messages="$errors->get('name')" />
                </div>

                <div>
                    <x-input-label for="email" :value="__('Имейл:')" required />
                    <x-text-input id="email" name="email" type="email" class="mt-1 block w-full mb-3 " :value="old('email', $user->email)" required autofocus autocomplete="off" />
                    <x-input-error class="mt-2" :messages="$errors->get('email')" />
                </div>
            </div>
            @endunlessrole

            @role('employer')
            <div>
                <x-input-label for="name" :value="__('Име:')" required />
                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full mb-3 " :value="old('name', null)" required autofocus autocomplete="off" />
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
            </div>

            <div>
                <x-input-label for="email" :value="__('Имейл:')" required />
                <x-text-input id="email" name="email" type="email" class="mt-1 block w-full mb-3 " :value="old('email', $user->email)" required autofocus autocomplete="off" />
                <x-input-error class="mt-2" :messages="$errors->get('email')" />
            </div>
            @endrole

            @role('student')
            <x-input-label for="university" :value="__('Университет:')" required />
            {!! Form::select('university', $universities, null,["class" => "mb-3 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5"]) !!}
            <x-input-error class="mt-2" :messages="$errors->get('university')" />

            <x-input-label for="specialty" :value="__('Специалност:')" required />
            {!! Form::select('specialty', $specialties, null,["class" => "mb-3 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5"]) !!}
            <x-input-error class="mt-2" :messages="$errors->get('specialty')" />

            <x-input-label for="course" :value="__('Курс:')" required />
            {!! Form::select('course', $courses, null,["class" => "mb-3 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5"]) !!}
            <x-input-error class="mt-2" :messages="$errors->get('course')" />

            <x-input-label for="success" :value="__('Среден успех до момента:')" required />
            {!! Form::number('success', null, ["step"=>".01", "class"=>"mb-3 block p-2.5 w-full text-sm text-gray-900 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 mb-4 "]) !!}
            <x-input-error class="mt-2" :messages="$errors->get('success')" />

            <x-input-label for="description" :value="__('За мен:')" required />
            {!! Form::textarea('description', null, ["rows"=>"4", "class"=>"mb-3 block p-2.5 w-full text-sm text-gray-900 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 mb-4 "]) !!}
            <x-input-error class="mt-2" :messages="$errors->get('description')" />
            @endrole

            @role('employer')
            <x-input-label for="firmName" :value="__('Име на фирмата:')" required />
            {!! Form::text('firmName', null, ["class"=>"block p-2.5 w-full text-sm text-gray-900 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 mb-4 "]) !!}
            <x-input-error class="mt-2" :messages="$errors->get('firmName')" />

            <x-input-label for="firmEmail" :value="__('Имейл на фирмата:')" required />
            {!! Form::text('firmEmail', null, ["class"=>"block p-2.5 w-full text-sm text-gray-900 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 mb-4 "]) !!}
            <x-input-error class="mt-2" :messages="$errors->get('firmEmail')" />

            <x-input-label for="phone" :value="__('Тел. номер:')" required />
            {!! Form::text('phone', null, ["class"=>"block p-2.5 w-full text-sm text-gray-900 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 mb-4 "]) !!}
            <x-input-error class="mt-2" :messages="$errors->get('phone')" />

            <x-input-label for="address" :value="__('Адрес:')" required />
            {!! Form::text('address', null, ["class"=>"block p-2.5 w-full text-sm text-gray-900 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 mb-4 "]) !!}
            <x-input-error class="mt-2" :messages="$errors->get('address')" />

            <x-input-label for="website" :value="__('Уеб сайт:')" required />
            {!! Form::text('website', null, ["class"=>"block p-2.5 w-full text-sm text-gray-900 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 mb-4 "]) !!}
            <x-input-error class="mt-2" :messages="$errors->get('website')" />

            <x-input-label for="employee_range" :value="__('Брой служители:')" required />
            {!! Form::select('employee_range', $employeeRanges, null, ['class' => "border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5"]) !!}
            <x-input-error class="mt-2" :messages="$errors->get('employee_range')" />

            <x-input-label for="description" class="mt-4" :value="__('За фирмата:')" required />
            {!! Form::textarea('description', null, ["rows"=>"4", "class"=>"block p-2.5 w-full text-sm text-gray-900 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 mb-4 "]) !!}
            <x-input-error class="mt-2" :messages="$errors->get('description')" required />
            @endrole

            <h2 class="text-lg font-medium text-gray-900">
                {{ __('Смяна на парола') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600 mb-4">
                {{ __('Уверете се, че акаунтът Ви използва дълга парола, която съдържа различни символи, за да сте защитени.') }}
            </p>

            <div>
                <x-input-label for="current_password" class="m-1" :value="__('Настояща парола:')" required />
                <x-text-input id="current_password" name="current_password" type="password" class="p-2.5 block w-full" autocomplete="current-password" />
                <x-input-error :messages="$errors->get('current_password')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="password" class="m-1" :value="__('Нова парола:')" required />
                <x-text-input id="password" name="password" type="password" class="p-2.5 block w-full" autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="password_confirmation" class="m-1" :value="__('Повторете паролата:')" required />
                <x-text-input id="password_confirmation" name="password_confirmation" type="password" class="p-2.5 block w-full" autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>


        </div>

        <div class="items-center">

            <div x-data="{photoName: null, photoPreview: null}" class=" col-span-6 ml-2 sm:col-span-4 md:mr-3">
                <!-- Photo File Input -->
                <input name="photo" type="file" class="hidden" x-ref="photo" x-on:change="
                        photoName = $refs.photo.files[0].name;
                        const reader = new FileReader();
                        reader.onload = (e) => {
                            photoPreview = e.target.result;
                        };
                        reader.readAsDataURL($refs.photo.files[0]);">

                @unlessrole('employer')
                <label class="block text-gray-700 text-sm font-bold mb-2 text-center" for="photo">
                    Профилна снимка <span class="text-red-600"> * </span>
                </label>
                @endunlessrole

                @role('employer')
                <label class="block text-gray-700 text-sm font-bold mb-2 text-center" for="photo">
                    Лого на фирмата <span class="text-red-600"> * </span>
                </label>
                @endrole
                <div class="text-center">
                    <!-- Current Profile Photo -->
                    <div class="mt-2" x-show="! photoPreview">
                        <img src="{{url('images/default-profile-picture.svg')}}" class="w-40 h-40 m-auto rounded-full shadow" alt="">
                    </div>
                    <!-- New Profile Photo Preview -->
                    <div class="mt-2" x-show="photoPreview" style="display: none;">
                        <span class="block w-40 h-40 rounded-full m-auto shadow" x-bind:style="'background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url(\'' + photoPreview + '\');'" style="background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url('null');">
                        </span>
                    </div>
                    <button type="button" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-400 focus:shadow-outline-blue active:text-gray-800 active:bg-gray-50 transition ease-in-out duration-150 mt-2 ml-3" x-on:click.prevent="$refs.photo.click()">
                        Изберете снимка
                    </button>
                    <x-input-error class="mt-2" :messages="$errors->get('photo')" />
                </div>

            </div>
        </div>
        <div>
            <label class="flex items-center mt-4">
                <input type="checkbox" class="form-checkbox">
                <span class="ml-2 text-sm">Съгласен съм с <a href="" class="text-blue-600 underline">общите условия</a> и <a href="" class="text-blue-600 underline">обработката на лични данни</a></span>
            </label>

            <div class="inline-flex">
                <div class="flex items-center gap-4">
                    <x-primary-button class="text-white bg-gradient-to-r mt-3 from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">{{ __('Запази') }}</x-primary-button>

                    @if (session('status') === 'password-updated')
                    <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm text-gray-600">{{ __('Паролата е променена успешно.') }}</p>
                    @endif
                </div>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-secondary-button onclick="event.preventDefault();
                                                this.closest('form').submit();" class="text-white bg-gradient-to-r mt-3 from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2" formnovalidate>
                        {{ __('Отказ') }}
                    </x-secondary-button>
                </form>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
</section>