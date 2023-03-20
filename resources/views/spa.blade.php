<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Главная</title>
    @vite(['resources/css/app.scss'])
</head>
<body>
    <x-notifications/>
    <div id="app"></div>
    <div id="portal-notification"></div>
    <script >
        window.appContext = {{ Js::from($context) }}
    </script>
    @vite(['resources/js/main.js'])
</body>
</html>