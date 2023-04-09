<div class="overflow-hidden rounded-lg border border-gray-200 shadow-md">
    <table class="w-full border-collapse bg-white text-left text-sm text-gray-500">
        <thead class="bg-gray-50">
            <tr>
                <th scope="col" class="px-6 py-4 font-medium text-gray-900 text-center">Име</th>
                <th scope="col" class="px-6 py-4 font-medium text-gray-900 text-center">Статус</th>
                <th scope="col" class="px-6 py-4 font-medium text-gray-900 text-center">Роля</th>
                <th scope="col" class="px-6 py-4 font-medium text-gray-900 text-center">Операции</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100 border-t border-gray-100">
            @forelse($users as $user)
            <tr class="hover:bg-gray-50">
                <th class="flex gap-3 px-6 py-4 font-normal text-gray-900">
                    <div class="relative h-10 w-10">
                        <img class="h-full w-full rounded-full object-cover object-center" src="{{ $user->hasRole('employer') ? $user->employer->logo : $user->profile_picture }}" alt="{{ $user->name }}" class="rounded-full h-48 w-48 object-cover" />
                        <!-- <span class="absolute right-0 bottom-0 h-2 w-2 rounded-full bg-green-400 ring ring-white"></span> -->
                    </div>
                    <div class="text-sm">
                        <a href="{{ route('users.show', $user->id) }}">
                            <div class="font-medium text-gray-700">
                                {{ $user->name }}
                            </div>
                            <div class="text-gray-400">{{ $user->email }} </div>
                        </a>
                    </div>
                </th>
                <td class="px-6 py-4 ">
                    <div class="flex justify-center">
                        @if($user->status->slug == \App\Models\Status::ACTIVE)
                        <span class=" inline-flex items-center gap-1 rounded-full bg-green-50 px-2 py-1 text-xs font-semibold text-green-600">
                            <span class="h-1.5 w-1.5 rounded-full bg-green-600"></span>
                            Активен
                        </span>
                        @elseif($user->status->slug == \App\Models\Status::INACTIVE)
                        <span class=" inline-flex items-center gap-1 rounded-full bg-red-50 px-2 py-1 text-xs font-semibold text-red-600">
                            <span class="h-1.5 w-1.5 rounded-full bg-red-600"></span>
                            Неактивен
                        </span>
                        @endif
                    </div>
                </td>
                <td class="px-6 py-4 text-center">{{ $user->role_names }}</td>

                <td class="px-6 py-4 w-1">
                    <div class="flex gap-4">
                        <a x-data="{ tooltip: 'Edit' }" href="{{route('users.edit', $user->id)}}">
                            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6" x-tooltip="tooltip">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <path d="M11 15H8C6.13623 15 5.20435 15 4.46927 15.3045C3.48915 15.7105 2.71046 16.4892 2.30448 17.4693C2 18.2044 2 19.1362 2 21M15.5 3.29076C16.9659 3.88415 18 5.32131 18 7M11.9999 21.5L14.025 21.095C14.2015 21.0597 14.2898 21.042 14.3721 21.0097C14.4452 20.9811 14.5147 20.9439 14.579 20.899C14.6516 20.8484 14.7152 20.7848 14.8426 20.6574L21.5 14C22.0524 13.4477 22.0523 12.5523 21.5 12C20.9477 11.4477 20.0523 11.4477 19.5 12L12.8425 18.6575C12.7152 18.7848 12.6516 18.8484 12.601 18.921C12.5561 18.9853 12.5189 19.0548 12.4902 19.1278C12.458 19.2102 12.4403 19.2984 12.405 19.475L11.9999 21.5ZM13.5 7C13.5 9.20914 11.7091 11 9.5 11C7.29086 11 5.5 9.20914 5.5 7C5.5 4.79086 7.29086 3 9.5 3C11.7091 3 13.5 4.79086 13.5 7Z" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                </g>
                            </svg>
                        </a>
                        @if($user->status->slug == \App\Models\Status::INACTIVE)
                        {!! Form::open(['route' => ['users.status', $user->id], 'method' => 'put']) !!}
                        {!! Form::hidden('status', \App\Models\Status::ACTIVE) !!}
                        <button type="submit" x-data="{ tooltip: 'Activate' }">
                            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6" x-tooltip="tooltip">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <path d="M19 21V15M16 18H22M12 15H8C6.13623 15 5.20435 15 4.46927 15.3045C3.48915 15.7105 2.71046 16.4892 2.30448 17.4693C2 18.2044 2 19.1362 2 21M15.5 3.29076C16.9659 3.88415 18 5.32131 18 7C18 8.67869 16.9659 10.1159 15.5 10.7092M13.5 7C13.5 9.20914 11.7091 11 9.5 11C7.29086 11 5.5 9.20914 5.5 7C5.5 4.79086 7.29086 3 9.5 3C11.7091 3 13.5 4.79086 13.5 7Z" stroke="#298e50" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                </g>
                            </svg>
                        </button>
                        {!! Form::close() !!}

                        @elseif($user->status->slug == \App\Models\Status::ACTIVE)
                        {!! Form::open(['route' => ['users.status', $user->id], 'method' => 'put']) !!}
                        {!! Form::hidden('status', \App\Models\Status::INACTIVE) !!}
                        <button type="submit" x-data="{ tooltip: 'Deactivate' }">
                            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6" x-tooltip="tooltip">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <path d="M16.5 16L21.5 21M21.5 16L16.5 21M15.5 3.29076C16.9659 3.88415 18 5.32131 18 7C18 8.67869 16.9659 10.1159 15.5 10.7092M12 15H8C6.13623 15 5.20435 15 4.46927 15.3045C3.48915 15.7105 2.71046 16.4892 2.30448 17.4693C2 18.2044 2 19.1362 2 21M13.5 7C13.5 9.20914 11.7091 11 9.5 11C7.29086 11 5.5 9.20914 5.5 7C5.5 4.79086 7.29086 3 9.5 3C11.7091 3 13.5 4.79086 13.5 7Z" stroke="#ee1111" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                </g>
                            </svg>
                        </button>
                        {!! Form::close() !!}
                        @endif
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center p-6">{{ __("Няма намерени потребители") }}</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="mt-2">
    {{ $users->links() }}
</div>