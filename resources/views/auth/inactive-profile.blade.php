@if($user->is_profile_completed == 1 && $user->Status->slug == \App\Models\Status::INACTIVE)
<div x-data="{ showContactForm: false }">
    <div class="p-8">
        <h1 class="text-3xl font-bold mb-4">Неактивен потребител</h1>
        <p class="mb-4">Вашият профил е неактивен. Моля, свържете се с администратора за повече информация.</p>
        <button class="bg-blue-500 text-white px-4 py-2 rounded-md" @click="showContactForm = true">Свържете се с администратора</button>
    </div>

    <div x-show="showContactForm" class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-75">
        <div class="bg-white rounded-lg p-8 w-1/2">
            <h2 class="text-2xl font-bold mb-4">Свържете се с администратора</h2>
            <form>
                <div class="mb-4">
                    <label class="block font-bold">Име</label>
                    <input type="text" class="border border-gray-300 rounded-md w-full py-2 px-3">
                </div>
                <div class="mb-4">
                    <label class="block font-bold">Имейл</label>
                    <input type="email" class="border border-gray-300 rounded-md w-full py-2 px-3">
                </div>
                <div class="mb-4">
                    <label class="block font-bold">Съобщение</label>
                    <textarea class="border border-gray-300 rounded-md w-full py-2 px-3"></textarea>
                </div>
                <button class="bg-blue-500 text-white px-4 py-2 rounded-md">Изпрати съобщението</button>
            </form>
        </div>
    </div>
</div>
@endif