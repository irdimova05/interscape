<x-app-layout>
    <div class="flex justify-between mb-8">
        <div>
            <button class=" text-white bg-gradient-to-r from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
                {{ __('Създай') }}
            </button>
        </div>
        <div class="items-stretch">
            <div class="relative">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none ">
                    <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path>
                    </svg>
                </div>
                <input name="search" type="search" id="search" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-80 pl-10 p-2.5 " placeholder="Търси по име">
            </div>
        </div>
    </div>
    <div class="table w-full">
        @include('users.components.table')
    </div>

    @push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var searchInput = document.getElementById("search");
            searchInput.addEventListener("input", function() {
                var value = this.value;
                var xhr = new XMLHttpRequest();
                xhr.open("GET", "{{ route('users.search') }}?q=" + value, true);
                xhr.onload = function() {
                    if (xhr.status === 200) {
                        var response = xhr.responseText;
                        document.querySelector(".table").innerHTML = response;
                    }
                };
                xhr.send();
            });
        }, false);
    </script>
    @endpush
</x-app-layout>