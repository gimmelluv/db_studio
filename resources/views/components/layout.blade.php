<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>DB Studio</title>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    @Vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-castom_white text-black font-montserrat">
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
                <a href="/training">Тренажер</a>
                <a href="/progress">Мое обучение</a>
            </div>
            
            @auth
                <div class="space-x-6 flex">
                    <a href="{{ route('profile.show') }}">Профиль</a>

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

    <!-- Подвал -->
    <footer class="py-8 mt-16">
        <div class="max-w-6xl mx-auto px-10 text-sm">
            <div class="grid md:grid-cols-5 gap-8">

                <div>
                    <h3 class="font-bold text-lg mb-4">Для пользователей</h3>
                    <ul class="space-y-2">
                        <li><a href="/user-agreement" class="hover:text-pink-400 transition">Пользовательское соглашение</a></li>
                        <li><a href="/faq" class="hover:text-pink-400 transition">Частые вопросы</a></li>
                        <li><a href="/support" class="hover:text-pink-400 transition">Техническая поддержка</a></li>
                    </ul>
                </div>

                <div>
                    <h3 class="font-bold text-lg mb-4">Для бизнеса</h3>
                    <ul class="space-y-2">
                        <li><a href="/corporate" class="hover:text-pink-400 transition">Корпоративное обучение</a></li>
                        <li><a href="/legal-payment" class="hover:text-pink-400 transition">Оплата от юридического лица</a></li>
                        <li><a href="/partnership" class="hover:text-pink-400 transition">Партнерская программа</a></li>
                    </ul>
                </div>
                
                <div>
                    <h3 class="font-bold text-lg mb-4">Навигация</h3>
                    <ul class="space-y-2">
                        <li><a href="/theory" class="hover:text-white transition">Курс</a></li>
                        <li><a href="/laboratory" class="hover:text-white transition">Лаборатория</a></li>
                        <li><a href="/training" class="hover:text-white transition">Тренажер</a></li>
                        <li><a href="/progress" class="hover:text-white transition">Мое обучение</a></li>
                    </ul>
                </div>
                
                <div>
                    <h3 class="font-bold text-lg mb-4">Контакты</h3>
                    <ul class="space-y-2">
                        <li>Email: info@dbstudio.ru</li>
                        <li>Телефон: +7 (123) 456-78-90</li>
                        <li class="mt-4">
                            <div class="flex space-x-4">
                                <a href="#" class="hover:text-white transition">Telegram</a>
                                <a href="#" class="hover:text-white transition">VK</a>
                            </div>
                        </li>
                    </ul>
                </div>
                
                <div>
                    <h3 class="font-bold text-lg mb-4">Подписка</h3>
                    <p class="mb-4">Подпишитесь на новости о курсе</p>
                    <form class="flex">
                        <input type="email" placeholder="Ваш email" class="px-4 py-2 rounded-l text-gray-800 w-full">
                        <button type="submit" class="bg-gray-300 hover:bg-gray-200 px-4 py-2 rounded-r transition">
                            →
                        </button>
                    </form>
                </div>
            </div>
            
            <div class="border-t border-white-700 mt-8 pt-6 text-center">
                <p class="text-xs">© 2025 DB Studio. Все права защищены.</p>
            </div>
        </div>
    </footer>
</body>
</html>