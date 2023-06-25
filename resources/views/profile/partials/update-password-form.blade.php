<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Смяна на парола') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Уверете се, че акаунтът Ви използва дълга парола, която съдържа различни символи, за да сте защитени.') }}
        </p>
    </header>

    {!! Form::open(['route'=>['profile.password.update'], 'method'=>'put'] ) !!}
    <div>
        <x-input-label class="mt-6 space-y-6" for="current_password" :value="__('Настояща парола:')" />
        <x-text-input id="current_password" name="current_password" type="password" class="mt-1 block w-full" autocomplete="current-password" />
        <x-input-error :messages="$errors->get('current_password')" class="mt-2" />
    </div>

    <div>
        <x-input-label class="mt-6 space-y-6" for="password" :value="__('Нова парола:')" />
        <x-text-input id="password" name="password" type="password" class="mt-1 block w-full" autocomplete="new-password" />
        <x-input-error :messages="$errors->get('password')" class="mt-2" />
    </div>

    <div>
        <x-input-label class="mt-6 space-y-6" for="password_confirmation" :value="__('Повторете паролата:')" />
        <x-text-input id="password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full" autocomplete="new-password" />
        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
    </div>

    <div class="flex items-center gap-4">
        <x-primary-button class="mt-6 space-y-6 text-white bg-gradient-to-r from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">{{ __('Запази') }}</x-primary-button>

        @if (session('status') === 'password-updated')
        <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm text-gray-600">{{ __('Паролата е променена успешно.') }}</p>
        @endif
    </div>
    {!! Form::close() !!}
</section>