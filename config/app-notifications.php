<?php

return [
    'auth.register' => [
        'type' => 'success',
        'text' => 'Регистрация успешно выполнена'
    ],
    'limit.login' => [
        'type' => 'danger',
        'text' => 'Вы превысили количество попыток входа',
    ],
    'password.reset' => [
        'type' => 'info',
        'text' => 'Пароль успешно сброшен'
    ],
    'password.reset.email' => [
        'type' => 'info',
        'text' => 'Ссылка для сброса пароля отправлена на почту'
    ],
    'password.change' => [
        'type' => 'primary',
        'text' => 'Пароль успешно изменен'
    ],
    'auth.verify' => [
        'type' => 'success',
        'text' => 'Аккаунт активирован'
    ],
    'auth.verify-mail' => [
        'type' => 'info',
        'text' => 'Письмо отправлено.Проверьте почту'
    ],
    'profile.delete' => [
        'type' => 'info',
        'text' => 'Профиль удален'
    ]
];