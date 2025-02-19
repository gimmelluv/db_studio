<x-layout>
    <div class="space-y-10 pt-20">
        <section class="text-center">
            <h1 class="font-bold text-6xl">Интерактивный онлайн курс по проектированию баз данных</h1>
            <h2 class="mt-10">Освойте проектирование баз данных, обучаясь на нашей платформе</h2>
        </section>

        <section class="pt-1">
            <div class="grid lg:grid-cols-3 gap-8 mt-6">
                <x-section-1 />
                <x-section-1 />
                <x-section-1 />
            </div>
        </section>
    
        <!-- Новая секция "Для кого подойдет этот курс" -->
        <section class="mt-12">
            <h2 class="text-2xl font-bold text-left mb-8">Для кого подойдет курс</h2>
    
           <div class="bg-castom_blue/50 rounded-xl text-white">
             <!-- 4 колонки -->
             <div class="grid lg:grid-cols-4 gap-8">
                <x-section-2 />
                <x-section-2 />
                <x-section-2 />
                <x-section-2 />
            </div>
           </div>
        </section>
    </div>
</x-layout>