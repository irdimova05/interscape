<x-app-layout>
    <div class="items-stretch">
        <div class="relative mb-4 flex justify-end">
            {!! Form::select('ads', $ads, null, [
            'class' => "w-80 p-2.5 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block",
            'placeholder' => "Търси по обява",
            'id' => 'adsFilter',
            ]) !!}
        </div>
    </div>

    <div class="apply_results">
        @include('applies.components.applies_results')
    </div>

    @push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var adsFilter = document.getElementById("adsFilter");
            adsFilter.addEventListener("change", function() {
                var value = this.value;
                var xhr = new XMLHttpRequest();
                xhr.open("GET", "{{ route('applies.adsFilter') }}?adId=" + value, true);
                xhr.onload = function() {
                    if (xhr.status === 200) {
                        var response = xhr.responseText;
                        document.querySelector(".apply_results").innerHTML = response;
                    }
                };
                xhr.send();
            });
        }, false);
    </script>
    @endpush
</x-app-layout>