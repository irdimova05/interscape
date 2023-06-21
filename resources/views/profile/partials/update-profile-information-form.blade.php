<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 mb-2">
            {{ __('Информация за профила') }}
        </h2>

        @role('employer')
        <p class="text-sm text-gray-600 mb-8">
            {{ __('Всички данни са видими за потребителите, с изключение на вашите лични имена и имейл.') }}
        </p>
        @endrole
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    {!! Form::open(['route'=>['users.update', $user->id], 'method'=>'put', 'files'=>true], ['class'=>"mt-6 space-y-6"] ) !!}

    <div class="grid grid-cols-2">

        <div>
            @unlessrole('employer')
            <div class="justify-center items-center">
                <div>
                    <x-input-label for="name" :value="__('Име:')" />
                    <x-text-input id="name" name="name" type="text" class="mt-1 block w-full mb-3 " :value="old('name', $user->name)" required autofocus autocomplete="name" />
                    <x-input-error class="mt-2" :messages="$errors->get('name')" />
                </div>

                <div>
                    <x-input-label for="email" :value="__('Имейл:')" />
                    <x-text-input id="email" name="email" type="email" class="mt-1 block w-full mb-3 " :value="old('email', $user->email)" required autofocus autocomplete="name" />
                    <x-input-error class="mt-2" :messages="$errors->get('email')" />
                </div>
            </div>
            @endunlessrole

            @role('employer')
            <div>
                <x-input-label for="name" :value="__('Име:')" />
                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full mb-3 " :value="old('name', $user->name)" required autofocus autocomplete="name" />
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
            </div>

            <div>
                <x-input-label for="email" :value="__('Имейл:')" />
                <x-text-input id="email" name="email" type="email" class="mt-1 block w-full mb-3 " :value="old('email', $user->email)" required autofocus autocomplete="name" />
                <x-input-error class="mt-2" :messages="$errors->get('email')" />
            </div>
            @endrole

            <div>
                @role('student')
                <x-input-label for="specialty" :value="__('Специалност:')" />
                {!! Form::select('specialty', $specialty, $user->student->specialty_id, ["class"=>"block p-2.5 w-full text-sm text-gray-900 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 mb-4 "]) !!}
                <x-input-error class="mt-2" :messages="$errors->get('specialty')" />

                <x-input-label for="course" :value="__('Курс:')" />
                {!! Form::select('course', $course, $user->student->course_id, ["class"=>"block p-2.5 w-full text-sm text-gray-900 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 mb-4 "]) !!}
                <x-input-error class="mt-2" :messages="$errors->get('course')" />

                <x-input-label for="success" :value="__('Успех:')" />
                {!! Form::text('success', $user->student->success, ["step"=>".01", "class"=>"block p-2.5 w-full text-sm text-gray-900 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 mb-4 "]) !!}
                <x-input-error class="mt-2" :messages="$errors->get('success')" />

                <x-input-label for="description" :value="__('За мен:')" />
                {!! Form::textarea('description', $user->student->description, ["rows"=>"4", "class"=>"block p-2.5 w-full text-sm text-gray-900 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 mb-4 "]) !!}
                <x-input-error class="mt-2" :messages="$errors->get('email')" />
                @endrole

                @role('employer')
                <x-input-label for="firmName" :value="__('Име на фирмата:')" />
                {!! Form::text('firmName', $user->employer->name, ["class"=>"block p-2.5 w-full text-sm text-gray-900 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 mb-4 "]) !!}

                <x-input-label for="firmEmail" :value="__('Имейл на фирмата:')" />
                {!! Form::text('firmEmail', $user->employer->email, ["class"=>"block p-2.5 w-full text-sm text-gray-900 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 mb-4 "]) !!}

                <x-input-label for="phone" :value="__('Тел. номер:')" />
                {!! Form::text('phone', $user->employer->phone, ["class"=>"block p-2.5 w-full text-sm text-gray-900 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 mb-4 "]) !!}

                <x-input-label for="address" :value="__('Адрес:')" />
                {!! Form::text('address', $user->employer->address, ["class"=>"block p-2.5 w-full text-sm text-gray-900 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 mb-4 "]) !!}

                <x-input-label for="website" :value="__('Уеб сайт:')" />
                {!! Form::text('website', $user->employer->website, ["class"=>"block p-2.5 w-full text-sm text-gray-900 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 mb-4 "]) !!}

                <x-input-label for="employeeRange" :value="__('Брой служители:')" />
                {!! Form::select('employeeRange', $employeeRanges, $user->employer->employee_range_id, ['class' => "border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5"]) !!}

                <x-input-label for="description" :value="__('За фирмата:')" />
                {!! Form::textarea('description', $user->employer->description, ["rows"=>"4", "class"=>"block p-2.5 w-full text-sm text-gray-900 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 mb-4 "]) !!}
                <x-input-error class="mt-2" :messages="$errors->get('email')" />
                @endrole

                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                    <p class="mt-2 font-medium text-sm text-green-600">
                        {{ __('A new verification link has been sent to your email address.') }}
                    </p>
                    @endif
                </div>
                @endif
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
                        reader.readAsDataURL($refs.photo.files[0]);
    ">

                @unlessrole('employer')
                <label class="block text-gray-700 text-sm font-bold mb-2 text-center" for="photo">
                    Профилна снимка <span class="text-red-600"> </span>
                </label>

                <div class="text-center">
                    <!-- Current Profile Photo -->
                    <div class="mt-2" x-show="! photoPreview">
                        <img src="{{$user->profile_picture}}" class="w-40 h-40 m-auto rounded-full shadow" alt="{{$user->name}}">
                    </div>
                    <!-- New Profile Photo Preview -->
                    <div class="mt-2" x-show="photoPreview" style="display: none;">
                        <span name="profilePicture" class="block w-40 h-40 rounded-full m-auto shadow" x-bind:style="'background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url(\'' + photoPreview + '\');'" style="background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url('null');">
                        </span>
                    </div>
                    <button type="button" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-400 focus:shadow-outline-blue active:text-gray-800 active:bg-gray-50 transition ease-in-out duration-150 mt-2 ml-3" x-on:click.prevent="$refs.photo.click()">
                        Изберете снимка
                    </button>
                    <x-input-error class="mt-2" :messages="$errors->get('photo')" />
                </div>
                @endunlessrole

                @role('employer')
                <label class="block text-gray-700 text-sm font-bold mb-2 text-center" for="photo">
                    Лого на фирмата <span class="text-red-600"> </span>
                </label>

                <div class="text-center">
                    <!-- Current Profile Photo -->
                    <div class="mt-2" x-show="! photoPreview">
                        <img src="{{$user->employer->logo}}" class="w-40 h-40 m-auto rounded-full shadow" alt="{{$user->employer->name}}">
                    </div>
                    <!-- New Profile Photo Preview -->
                    <div class="mt-2" x-show="photoPreview" style="display: none;">
                        <span name="firmLogo" class="block w-40 h-40 rounded-full m-auto shadow" x-bind:style="'background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url(\'' + photoPreview + '\');'" style="background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url('null');">
                        </span>
                    </div>
                    <button type="button" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-400 focus:shadow-outline-blue active:text-gray-800 active:bg-gray-50 transition ease-in-out duration-150 mt-2 ml-3" x-on:click.prevent="$refs.photo.click()">
                        Изберете снимка
                    </button>
                    <x-input-error class="mt-2" :messages="$errors->get('photo')" />
                </div>
                @endrole
            </div>
        </div>

    </div>
    <div class="flex items-center gap-4">
        <x-primary-button class="text-white bg-gradient-to-r from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">{{ __('Запази') }}</x-primary-button>

        @if (session('status') === 'profile-updated')
        <p x-data=" { show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm text-gray-600">{{ __('Вашият профил е обновен.') }}</p>
        @endif
    </div>
    {!! Form::close() !!}
</section>