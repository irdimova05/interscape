<x-app-layout>
    <div class="py-8">
        <div class="mb-4">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4 flex">
                <article class="md:gap-8 md:grid md:grid-cols-3">
                    <div>
                        <div class="items-center space-x-4">
                            <a href="{{ route('users.show', $ad->employer->user->id) }}">
                                <img src=" {{ $ad->employer->logo }}" alt=" {{ $ad->employer->logo }} ">
                            </a>
                        </div>
                    </div>
                    <div class="col-span-2 mt-6 md:mt-0">
                        <div>
                            <div class="flex justify-between">
                                <div class="pr-4">
                                    <div class="flex">
                                        <h4 class=" text-xl font-bold text-gray-900">{{ $ad->title }}</h4>
                                        @unlessrole('student')
                                        @php
                                        $textColor = '';
                                        $textBgColor = '';
                                        $bgColor = '';

                                        $adStatusSlug = $ad->adStatus->slug;

                                        if ($adStatusSlug == \App\Models\AdStatus::ACTIVE) {
                                        $textColor = 'text-green-600';
                                        $textBgColor = 'bg-green-50';
                                        $bgColor = 'bg-green-600';
                                        } elseif ($adStatusSlug == \App\Models\AdStatus::INACTIVE) {
                                        $textColor = 'text-red-600';
                                        $textBgColor = 'bg-red-50';
                                        $bgColor = 'bg-red-600';
                                        } elseif ($adStatusSlug == \App\Models\AdStatus::BLOCKED) {
                                        $textColor = 'text-purple-600';
                                        $textBgColor = 'bg-purple-50';
                                        $bgColor = 'bg-purple-600';
                                        }
                                        @endphp
                                        <div class="py-1 justify-center mb-3 ml-3">
                                            <span class="inline-flex items-center gap-1 rounded-full px-2 py-1 text-xs font-semibold {{ $textBgColor }} {{ $textColor }}">
                                                <span class="h-1.5 w-1.5 rounded-full {{ $bgColor }}"></span>
                                                {{ $ad->adStatus->name }}
                                            </span>
                                        </div>
                                    </div>
                                    @endunlessrole
                                    <div class="mb-5 text-gray-500">
                                        <a href="{{ route('users.show', $ad->employer->user->id) }}">
                                            <p>{{ $ad->employer->name }}</p>
                                        </a>
                                    </div>
                                </div>
                                <div class="flex items-center">
                                    @if($ad->employer->user->id == Auth::user()->id)
                                    <a href="{{route('ads.edit', $ad->id)}}" type="button" class="flex items-center text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
                                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke-width="1.5" stroke="currentColor" class="h-6 w-6 mr-1" x-tooltip="tooltip">
                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                            <g id="SVGRepo_iconCarrier">
                                                <path d="M18 9.99982L14 5.99982M2.5 21.4998L5.88437 21.1238C6.29786 21.0778 6.5046 21.0549 6.69785 20.9923C6.86929 20.9368 7.03245 20.8584 7.18289 20.7592C7.35245 20.6474 7.49955 20.5003 7.79373 20.2061L21 6.99982C22.1046 5.89525 22.1046 4.10438 21 2.99981C19.8955 1.89525 18.1046 1.89524 17 2.99981L3.79373 16.2061C3.49955 16.5003 3.35246 16.6474 3.24064 16.8169C3.14143 16.9674 3.06301 17.1305 3.00751 17.302C2.94496 17.4952 2.92198 17.702 2.87604 18.1155L2.5 21.4998Z" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                            </g>
                                        </svg>
                                        <span>Редактирай</span>
                                    </a>
                                    @if($ad->adStatus->slug == \App\Models\AdStatus::ACTIVE)
                                    {!! Form::open(['route' => ['ads.status', $ad->id], 'method' => 'put']) !!}
                                    {!! Form::hidden('status', \App\Models\AdStatus::INACTIVE) !!}
                                    <button type="sumbit" class="text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 flex items-center">
                                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke-width="1.5" stroke="currentColor" class="h-6 w-6 mr-1" x-tooltip="tooltip">
                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                            <g id="SVGRepo_iconCarrier">
                                                <path d="M15 9L9 15M9 9L15 15M22 12C22 17.5228 17.5228 22 12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12Z" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                            </g>
                                        </svg>
                                        <span>Деактивирай</span>
                                    </button>
                                    {!! Form::close() !!}

                                    @elseif($ad->adStatus->slug == \App\Models\AdStatus::INACTIVE)
                                    {!! Form::open(['route' => ['ads.status', $ad->id], 'method' => 'put']) !!}
                                    {!! Form::hidden('status', \App\Models\AdStatus::ACTIVE) !!}
                                    <button type="submit" class="text-white bg-gradient-to-r from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 flex items-center">
                                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke-width="1.5" stroke="currentColor" class="h-6 w-6 mr-1" x-tooltip="tooltip">
                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                            <g id="SVGRepo_iconCarrier">
                                                <path d="M22 11.0857V12.0057C21.9988 14.1621 21.3005 16.2604 20.0093 17.9875C18.7182 19.7147 16.9033 20.9782 14.8354 21.5896C12.7674 22.201 10.5573 22.1276 8.53447 21.3803C6.51168 20.633 4.78465 19.2518 3.61096 17.4428C2.43727 15.6338 1.87979 13.4938 2.02168 11.342C2.16356 9.19029 2.99721 7.14205 4.39828 5.5028C5.79935 3.86354 7.69279 2.72111 9.79619 2.24587C11.8996 1.77063 14.1003 1.98806 16.07 2.86572M22 4L12 14.01L9 11.01" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                            </g>
                                        </svg>
                                        <span>Активирай</span>
                                    </button>
                                    {!! Form::close() !!}
                                    @endif
                                    @endif

                                    @role('admin')
                                    {!! Form::open(['route' => ['ads.status', $ad->id], 'method' => 'put']) !!}
                                    {!! Form::hidden('status', \App\Models\AdStatus::BLOCKED) !!}
                                    <button type="submit" class="text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 flex items-center">
                                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke-width="1.5" stroke="currentColor" class="h-6 w-6 mr-1" x-tooltip="tooltip">
                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                            <g id="SVGRepo_iconCarrier">
                                                <path d="M12 8V12M12 16H12.01M22 12C22 17.5228 17.5228 22 12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12Z" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                            </g>
                                        </svg>
                                        <span>Блокирай</span>
                                    </button>
                                    {!! Form::close() !!}
                                    @endrole

                                    @role('student')
                                    <button type="button" class="text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 flex items-center">
                                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke-width="1.5" stroke="currentColor" class="h-6 w-6 mr-1" x-tooltip="tooltip">
                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                            <g id="SVGRepo_iconCarrier">
                                                <path d="M12 8V12M12 16H12.01M22 12C22 17.5228 17.5228 22 12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12Z" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                            </g>
                                        </svg>
                                        <span>Докладвай</span>
                                    </button>
                                    @endrole

                                </div>
                            </div>
                        </div>

                        @if($ad->salary !== null)
                        <p class=" text-gray-500">Заплата:
                            {{ $ad->salary }} лв.
                        </p>
                        @endif
                        <p class="mb-5 text-gray-500">Вид:
                            {{ $ad->jobType->name }}
                        <p class=" mb-2 font-light text-gray-500 ">
                            {{ $ad->description}}
                        </p>
                    </div>
                    @role('student')
                    <div class=" flex justify-center col-span-3">
                        <a href="{{route('ads.apply', $ad->id)}}" class="text-white bg-gradient-to-r from-blue-400 via-blue-500 to-blue-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center flex items-center">
                            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke-width="1.5" stroke="currentColor" class="h-6 w-6 mr-1" x-tooltip="tooltip">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <path d="M9 3.5V2M5.06066 5.06066L4 4M5.06066 13L4 14.0607M13 5.06066L14.0607 4M3.5 9H2M8.5 8.5L12.6111 21.2778L15.5 18.3889L19.1111 22L22 19.1111L18.3889 15.5L21.2778 12.6111L8.5 8.5Z" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                </g>
                            </svg>
                            <span>Кандидатствай</span>
                        </a>
                    </div>
                    @endrole
            </div>
            </article>
        </div>
    </div>
    </div>
</x-app-layout>