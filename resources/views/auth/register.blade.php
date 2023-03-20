<x-layouts.main title="Регистрация">
    <div class="column is-half is-offset-one-quarter">
        <article class="panel is-info container box">
            <p class="panel-heading">
                Регистрация
            </p>
            <x-form action="{{ route('register') }}">
                <x-forms.custom-input name="name" type="text" placeholder="Введите имя" label="Имя" icon="fas fa-user"/>
                <x-forms.custom-input name="email" type="email" placeholder="Введите почту" label="Email" icon="fas fa-envelope"/>
                <x-forms.custom-input name="password" type="password" placeholder="Введите пароль" label="Пароль" icon="fas fa-lock"/>
                <x-forms.custom-input name="password_confirmation" type="password" placeholder="Повторите пароль" label="Повтор пароля" icon="fa-solid fa-check-double"/>
                <div> 
                    <button type="submit" class="button is-info">Зарегистрироваться</button>
                </div>
            </x-form>
            <a href="{{ route('login') }}"><button class="button is-success mt-2">Войти</button></a>
        </article>
    </div>
    <x-on-home/>
</x-layouts.main>