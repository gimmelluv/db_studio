<x-layout>
    <section>
        <div class="grid lg:grid-cols-3 gap-8">
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

</x-layout>