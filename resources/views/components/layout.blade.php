<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>DB Studio</title>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    @Vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-castom_white text-black font-montserrat pb-20">
    <div class="px-10">
        <nav class="flex justify-between items-center py-4 border-b border-black/10">
            <div>
                <a href="/">
                    <img src="{{ Vite::asset('resources/images/db_logo.svg')}}" alt="">
                </a>
            </div>
            <div class="space-x-6">
                <a href="/theory">Курс</a>
                <a href="/laboratory">Лаборатория</a>
                <a href="/progress">Мое обучение</a>
            </div>
            
            @auth
                <div class="space-x-6 flex">
                    <a href="#">Профиль</a>

                    <form method="POST" action="/logout">
                        @csrf
                        @method('DELETE')

                        <button>Выйти</button>
                    </form>
                </div>
            @endauth

            @guest
                <div class="space-x-6">
                    <a href="/register">Регистрация</a>
                    <a href="/login">Войти</a>
                </div>
            @endguest
        </nav>

        <main class="mt-10 max-w-[986px] mx-auto">
            {{ $slot }}
        </main>
    </div>
</body>
</html>