<x-layout>
    <div class="space-y-10 pt-20">
        <section class="text-center">
            <h1 class="font-bold text-6xl">Интерактивный онлайн курс по проектированию баз данных</h1>
            <h2 class="mt-10">Освойте проектирование баз данных, обучаясь на нашей платформе</h2>
        </section>

        <section class="pt-1">
            <div class="grid lg:grid-cols-3 gap-8 mt-6">
                <x-section-1 title="Перейти к изучению теории" description="Прочти теорию перед тем, как перейти в Лабораторию"/>
                <x-section-1 title="Лаборатория" description="Здесь будут храниться твои работы"/>
                <x-section-1 title="Прогресс" description="Посмотреть свои достижения"/>
            </div>
        </section>
    
        <section class="mt-12">
           <div class="bg-white rounded-xl shadow-lg p-10">
            <div class="text-2xl font-bold text-left mb-12 mt-4 pl-10">
                <h2>Для кого подойдет курс</h2>
            </div>
             <div class="grid lg:grid-cols-4 gap-2">
                <x-section-2 title="Для аналитиков" description="Углубите знания в своей области и получите необходимый навык для продуктивной работы" logo="{{ Vite::asset('resources/images/sec_2(1).svg') }}"/>
                <x-section-2 title="Для разработчиков" description="Научитесь оптимально работать с реляционными базами данных" logo="{{ Vite::asset('resources/images/sec_2(2).svg') }}"/>
                <x-section-2 title="Для тестировщиков" description="Повысьте качество тестирования системы и научитесь автоматизировать процессы тестирования" logo="{{ Vite::asset('resources/images/sec_2(3).svg') }}"/>
                <x-section-2 title="Для студентов" description="Освойте основы работы с базами данных и получите практические навыки, которые пригодятся в дальнейшей карьере" logo="{{ Vite::asset('resources/images/sec_2(4).svg') }}"/>
            </div>
           </div>
        </section>

        <section class="mt-12">
            <div class="p-10">
                <div class="text-2xl font-bold text-center mb-12 mt-4">
                    <h2>Наши преимущества</h2>
                </div>
                <div class="grid lg:grid-cols-3 gap-6">
                    <x-section-3 
                        title="Практико-ориентированный подход" 
                        description="Обучение через решение реальных задач и кейсов"
                        icon="🧠"
                        color="bg-white-100"/>
                    <x-section-3 
                        title="Гибкий график" 
                        description="Занимайтесь в удобное время в своем темпе"
                        icon="⏱️"
                        color="bg-white-100"/>
                    <x-section-3 
                        title="Поддержка" 
                        description="Обратная связь от преподавателей и помощь в сложных моментах"
                        icon="🤝"
                        color="bg-white-100"/>
                    <x-section-3 
                        title="Сертификат" 
                        description="Документ об окончании, подтверждающий ваши навыки"
                        icon="📜"
                        color="bg-white-100"/>
                    <x-section-3 
                        title="Актуальные знания" 
                        description="Программа регулярно обновляется согласно последним трендам"
                        icon="🔄"
                        color="bg-white-100"/>
                    <x-section-3 
                        title="Сообщество" 
                        description="Доступ к закрытому чату с единомышленниками"
                        icon="💬"
                        color="bg-white-100"/>
                </div>
            </div>
        </section>

        <section class="mt-12">
            <div class="p-10">
                <div class="text-2xl font-bold text-center mb-12 mt-4">
                    <h2>FAQ</h2>
                </div>
                
                <div class="max-w-4xl mx-auto space-y-4">
                    <div x-data="{ open: false }" class="border border-gray-200 rounded-lg overflow-hidden">
                        <button 
                            @click="open = !open" 
                            class="w-full px-6 py-4 text-left bg-gray-50 hover:bg-blue-100 transition-colors duration-200 flex justify-between items-center"
                        >
                            <span class="font-bold">Нужны ли специальные знания для начала обучения?</span>
                            <span x-text="open ? '−' : '+'" class="text-xl font-bold"></span>
                        </button>
                        <div x-show="open" x-collapse class="px-6 py-4 bg-white">
                            <p>Курс рассчитан на начинающих, мы начинаем с основ. Главное — желание учиться!</p>
                        </div>
                    </div>

                    <div x-data="{ open: false }" class="border border-gray-200 rounded-lg overflow-hidden">
                        <button 
                            @click="open = !open" 
                            class="w-full px-6 py-4 text-left bg-gray-50 hover:bg-blue-100 transition-colors duration-200 flex justify-between items-center"
                        >
                            <span class="font-bold">Какой срок доступа к курсу?</span>
                            <span x-text="open ? '−' : '+'" class="text-xl font-bold"></span>
                        </button>
                        <div x-show="open" x-collapse class="px-6 py-4 bg-white">
                            <p>Доступ к курсу предоставляется на 1 год с момента покупки, включая все обновления.</p>
                        </div>
                    </div>

                    <div x-data="{ open: false }" class="border border-gray-200 rounded-lg overflow-hidden">
                        <button 
                            @click="open = !open" 
                            class="w-full px-6 py-4 text-left bg-gray-50 hover:bg-blue-100 transition-colors duration-200 flex justify-between items-center"
                        >
                            <span class="font-bold">Есть ли практические задания?</span>
                            <span x-text="open ? '−' : '+'" class="text-xl font-bold"></span>
                        </button>
                        <div x-show="open" x-collapse class="px-6 py-4 bg-white">
                            <p>Да, курс содержит более 50 практических заданий с автоматической проверкой в нашей лаборатории.</p>
                        </div>
                    </div>

                    <div x-data="{ open: false }" class="border border-gray-200 rounded-lg overflow-hidden">
                        <button 
                            @click="open = !open" 
                            class="w-full px-6 py-4 text-left bg-gray-50 hover:bg-blue-100 transition-colors duration-200 flex justify-between items-center"
                        >
                            <span class="font-bold">Можно ли получить сертификат?</span>
                            <span x-text="open ? '−' : '+'" class="text-xl font-bold"></span>
                        </button>
                        <div x-show="open" x-collapse class="px-6 py-4 bg-white">
                            <p>Да, после успешного завершения курса вы получите именной сертификат в электронном формате.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</x-layout>