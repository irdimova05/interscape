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

    {!! Form::open(['route'=>'profile.update', 'method'=>'patch'], ['class'=>"mt-6 space-y-6"]) !!}

    <div class="grid grid-cols-2">

        <div>
            @unlessrole('employer')
            <div class="justify-center items-center">
                <div>
                    <x-input-label for="name" :value="__('Име:')" />
                    <x-text-input id="name" name="name" type="text" class="mt-1 block w-full mb-3 " :value=" old('name', null)" required autofocus autocomplete="name" />
                    <x-input-error class="mt-2" :messages="$errors->get('name')" />
                </div>

                <div>
                    <x-input-label for="email" :value="__('Имейл:')" />
                    <x-text-input id="email" name="email" type="email" class="mt-1 block w-full mb-3 " :value="old('email', null)" required autofocus autocomplete="name" />
                    <x-input-error class="mt-2" :messages="$errors->get('email')" />
                </div>
            </div>
            @endunlessrole

            @role('employer')
            <div>
                <x-input-label for="name" :value="__('Име:')" />
                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full mb-3 " :value="old('name', null)" required autofocus autocomplete="name" />
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
            </div>

            <div>
                <x-input-label for="email" :value="__('Имейл:')" />
                <x-text-input id="email" name="email" type="email" class="mt-1 block w-full mb-3 " :value="old('email', null)" required autofocus autocomplete="name" />
                <x-input-error class="mt-2" :messages="$errors->get('email')" />
            </div>
            @endrole

            @role('student')
            <x-input-label for="description" :value="__('За мен:')" />
            {!! Form::textarea('description', null, ["rows"=>"4", "class"=>"block p-2.5 w-full text-sm text-gray-900 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 mb-4 "]) !!}
            <x-input-error class="mt-2" :messages="$errors->get('email')" />
            @endrole

            @role('employer')
            <x-input-label for="firmName" :value="__('Име на фирмата:')" />
            {!! Form::text('firmName', null, ["class"=>"block p-2.5 w-full text-sm text-gray-900 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 mb-4 "]) !!}

            <x-input-label for="firmEmail" :value="__('Имейл на фирмата:')" />
            {!! Form::text('firmEmail', null, ["class"=>"block p-2.5 w-full text-sm text-gray-900 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 mb-4 "]) !!}

            <x-input-label for="phone" :value="__('Тел. номер:')" />
            {!! Form::text('phone', null, ["class"=>"block p-2.5 w-full text-sm text-gray-900 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 mb-4 "]) !!}

            <x-input-label for="address" :value="__('Адрес:')" />
            {!! Form::text('address', null, ["class"=>"block p-2.5 w-full text-sm text-gray-900 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 mb-4 "]) !!}

            <x-input-label for="website" :value="__('Уеб сайт:')" />
            {!! Form::text('website', null, ["class"=>"block p-2.5 w-full text-sm text-gray-900 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 mb-4 "]) !!}

            <x-input-label for="employeeRange" :value="__('Брой служители:')" />
            {!! Form::select('employeeRange', $employeeRanges, null, ['class' => "border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5"]) !!}

            <x-input-label for="description" class="mt-4" :value="__('За фирмата:')" />
            {!! Form::textarea('description', null, ["rows"=>"4", "class"=>"block p-2.5 w-full text-sm text-gray-900 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 mb-4 "]) !!}
            <x-input-error class="mt-2" :messages="$errors->get('email')" />
            @endrole

            <h2 class="text-lg font-medium text-gray-900">
                {{ __('Смяна на парола') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600 mb-4">
                {{ __('Уверете се, че акаунтът Ви използва дълга парола, която съдържа различни символи, за да сте защитени.') }}
            </p>

            <div>
                <x-input-label for="current_password" class="m-1" :value="__('Настояща парола:')" />
                <x-text-input id="current_password" name="current_password" type="password" class="p-2.5 block w-full" autocomplete="current-password" />
                <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="password" class="m-1" :value="__('Нова парола:')" />
                <x-text-input id="password" name="password" type="password" class="p-2.5 block w-full" autocomplete="new-password" />
                <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="password_confirmation" class="m-1" :value="__('Повторете паролата:')" />
                <x-text-input id="password_confirmation" name="password_confirmation" type="password" class="p-2.5 block w-full" autocomplete="new-password" />
                <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
            </div>


        </div>

        <div class="items-center">

            <div x-data="{photoName: null, photoPreview: null}" class=" col-span-6 ml-2 sm:col-span-4 md:mr-3">
                <!-- Photo File Input -->
                <input type="file" class="hidden" x-ref="photo" x-on:change="
                        photoName = $refs.photo.files[0].name;
                        const reader = new FileReader();
                        reader.onload = (e) => {
                            photoPreview = e.target.result;
                        };
                        reader.readAsDataURL($refs.photo.files[0]);">

                @unlessrole('employer')
                <label class="block text-gray-700 text-sm font-bold mb-2 text-center" for="photo">
                    Профилна снимка <span class="text-red-600"> </span>
                </label>

                <div class="text-center">
                    <!-- Current Profile Photo -->
                    <div class="mt-2" x-show="! photoPreview">
                        <img src="url('images/default-profile-picture.svg')" class="w-40 h-40 m-auto rounded-full shadow" alt="$user->name">
                    </div>
                    <!-- New Profile Photo Preview -->
                    <div class="mt-2" x-show="photoPreview" style="display: none;">
                        <span class="block w-40 h-40 rounded-full m-auto shadow" x-bind:style="'background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url(\'' + photoPreview + '\');'" style="background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url('null');">
                        </span>
                    </div>
                    <button type="button" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-400 focus:shadow-outline-blue active:text-gray-800 active:bg-gray-50 transition ease-in-out duration-150 mt-2 ml-3" x-on:click.prevent="$refs.photo.click()">
                        Изберете снимка
                    </button>
                </div>
                @endunlessrole

                @role('employer')
                <label class="block text-gray-700 text-sm font-bold mb-2 text-center" for="photo">
                    Лого на фирмата <span class="text-red-600"> </span>
                </label>

                <div class="text-center">
                    <!-- Current Profile Photo -->
                    <div class="mt-2" x-show="! photoPreview">
                        <img src="url('images/default-profile-picture.svg')" class="w-40 h-40 m-auto rounded-full shadow" alt="">
                    </div>
                    <!-- New Profile Photo Preview -->
                    <div class="mt-2" x-show="photoPreview" style="display: none;">
                        <span class="block w-40 h-40 rounded-full m-auto shadow" x-bind:style="'background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url(\'' + photoPreview + '\');'" style="background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url('null');">
                        </span>
                    </div>
                    <button type="button" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-400 focus:shadow-outline-blue active:text-gray-800 active:bg-gray-50 transition ease-in-out duration-150 mt-2 ml-3" x-on:click.prevent="$refs.photo.click()">
                        Изберете снимка
                    </button>
                </div>
                @endrole
            </div>
        </div>
        <div x-data="{ cookiesAccepted: false, personalDataAccepted: false }">
            <label class="flex mt-4 items-center">
                <input type="checkbox" class="form-checkbox" x-model="cookiesAccepted">
                <span class="ml-2 text-sm">Приемам <a href=route() class="text-blue-600 underline">бисквитките</a></span>
            </label>

            <label class="flex items-center mt-4">
                <input type="checkbox" class="form-checkbox" x-model="personalDataAccepted">
                <span class="ml-2 text-sm">Съгласен съм с <a href=route() class="text-blue-600 underline">общите условия</a> и <a href=route() class="text-blue-600 underline">обработката на лични данни</a></span>
            </label>


            <div class="inline-flex">
                <div class="flex items-center gap-4">
                    <x-primary-button x-show="cookiesAccepted && personalDataAccepted" class="text-white bg-gradient-to-r mt-3 from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">{{ __('Запази') }}</x-primary-button>

                    @if (session('status') === 'password-updated')
                    <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm text-gray-600">{{ __('Паролата е променена успешно.') }}</p>
                    @endif
                </div>
                {!! Form::close() !!}
                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-secondary-button onclick="event.preventDefault();
                                                this.closest('form').submit();" class="text-white bg-gradient-to-r mt-3 from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2" formnovalidate>
                        {{ __('Отказ') }}
                    </x-secondary-button>
                </form>
            </div>
</section>