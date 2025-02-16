<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>DB Studio</title>
    @Vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-castom_white text-black">
    <div class="px-10">
        <nav class="flex justify-between items-center py-4 border-b border-black/10">
            <div>
                <a href="">
                    <img src="{{ Vite::asset('resources/images/db_logo.svg')}}" alt="">
                </a>
            </div>
            <div class="space-x-6">
                <a href="#">Курс</a>
                <a href="#">Лаборатория</a>
                <a href="#">Мое обучение</a>
                <a href="#">Контакты</a>
            </div>
            <div>post a job</div>
        </nav>

        <main class="mt-10">
            {{ $slot }}
        </main>
    </div>
</body>
</html>