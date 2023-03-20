<x-layouts.main title="Сброс пароля">
    <div class="columns mt-2 is-centered">
        <div class="column is-5">
            <article class="panel is-info container box">
                <p class="panel-heading">
                    Сброс пароля
                </p>
                <x-form action="{{ route('password.update') }}">
                    <x-form-input name="token" value="{{ $token }}" type="hidden"/>
                    <x-forms.custom-input name="email" type="email" placeholder="Введите почту" label="Email" icon="fas fa-envelope"/>
                    <x-forms.custom-input name="password" type="password" placeholder="Введите пароль" label="Пароль" icon="fas fa-lock"/>
                    <x-forms.custom-input name="password_confirmation" type="password" placeholder="Повторите пароль" label="Повтор пароля" icon="fa-solid fa-check-double"/>
                    <div> 
                        <button type="submit" class="button is-info">Сбросить пароль</button>
                    </div>
                </x-form>
            </article>
        </div>
    </div>
</x-layouts.main>