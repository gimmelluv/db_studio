<x-layout>
    <div class="space-y-10 pt-20">
        <section class="text-center">
            <h1 class="font-bold text-6xl">Интерактивный онлайн курс по проектированию баз данных</h1>
            <h2 class="mt-10">Освойте проектирование баз данных, обучаясь на нашей платформе</h2>
        </section>

        <section class="pt-1">
            <div class="grid lg:grid-cols-3 gap-8 mt-6">
                <x-section-1 title="Перейти к изучению теории" description="Прочти теорию перед тем, как перейти в Лабораторию"/>
                <x-section-1 title="Лаборатория" description="Здесь ты найдешь практические задания"/>
                <x-section-1 title="Прогресс" description="Посмотреть свои достижения"/>
            </div>
        </section>
    
        <!-- Новая секция "Для кого подойдет этот курс" -->
        <section class="mt-12">
           <div class="bg-white rounded-xl shadow-lg p-10">
            <div class="text-2xl font-bold text-left mb-12 mt-4 pl-10">
                <h2>Для кого подойдет курс</h2>
            </div>
             <!-- 4 колонки -->
             <div class="grid lg:grid-cols-4 gap-2">
                <x-section-2 title="Для аналитиков" description="Углубите знания в своей области и получите необходимый навык для продуктивной работы" logo="{{ Vite::asset('resources/images/sec_2(1).svg') }}"/>
                <x-section-2 title="Для разработчиков" description="Научитесь оптимально работать с реляционными базами данных" logo="{{ Vite::asset('resources/images/sec_2(2).svg') }}"/>
                <x-section-2 title="Для тестировщиков" description="Повысьте качество тестирования системы и научитесь автоматизировать процессы тестирования" logo="{{ Vite::asset('resources/images/sec_2(3).svg') }}"/>
                <x-section-2 title="Для студентов" description="Освойте основы работы с базами данных и получите практические навыки, которые пригодятся в дальнейшей карьере" logo="{{ Vite::asset('resources/images/sec_2(4).svg') }}"/>
            </div>
           </div>
        </section>
    </div>
</x-layout>