<x-layouts.main title="Сброс пароля">
    <div class="columns mt-2 is-centered">
        <div class="column is-3">
            <article class="panel is-info container box">
                <p class="panel-heading">
                    Сброс пароля
                </p>
                <x-form action="{{ route('password.email') }}">
                    <x-forms.custom-input name="email" type="email" placeholder="Введите почту" icon="fas fa-envelope"/>
                    <div > 
                        <button type="submit" class="button is-info">Отправить</button>
                    </div>
                </x-form>
          </article>
        </div>
    </div>
    <x-on-home/>
</x-layouts.main>