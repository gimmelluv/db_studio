<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>DB Studio</title>
    @Vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div>
        <nav>
            <div>
                <a href="">
                    <img src="{{ Vite::asset('resources/images/logo.svg')}}" alt="">
                </a>
            </div>
            <div>
                <a href="#">Курс</a>
                <a href="#">Лаборатория</a>
                <a href="#">Мое обучение</a>
                <a href="#">Контакты</a>
            </div>
            <div>post a job</div>
        </nav>

        <main>
            {{ $slot }}
        </main>
    </div>
</body>
</html>