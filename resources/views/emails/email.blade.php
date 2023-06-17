    <x-slot name="title">
        {{ __('Нова регистрация') }}
    </x-slot>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Здравейте,</h1>
                <p>Вашите данни за вписване в Interscape са:
                    <br>
                    <strong>Имейл:</strong> {{ $email }}
                    <br>
                    <strong>Парола:</strong> {{ $password }}
                    <br>
                    За да използвате платформата, е нужно при първото вписване да попълните формата за довършване на регистрация с Вашите данни.
                </p>
            </div>
        </div>
    </div>