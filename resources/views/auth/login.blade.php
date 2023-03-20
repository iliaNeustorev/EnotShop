<x-layouts.main title="Форма входа">
   
    <div class="columns mt-2 is-centered">
        <div class="column is-5">
            <article class="panel is-primary container box">
                <p class="panel-heading">
                    Вход на сайт
                </p>
                
                <x-form action="{{ route('login') }}">
                    <x-forms.custom-input name="email" type="email" placeholder="Введите почту" label="Email" icon="fas fa-envelope"/>
                    <x-forms.custom-input name="password" type="password" placeholder="Введите пароль" label="Пароль" icon="fas fa-lock"/>
                    <div class="field mt-2">
                        <x-form-checkbox name="remember" label="Запомнить пользователя" checked/>
                    </div>
                    <button type="submit" class="button is-success">Войти</button>
                </x-form>
                <a href="{{route('register')}}"><button class="button is-info mt-2">Регистрация</button></a>
                <div class="mt-2"><a href="{{ route('password.request') }}">Забыли пароль?</a></div>
          </article>
        </div>
    </div>
    <x-on-home/>
</x-layouts.main>