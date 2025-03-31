<x-layout>
    <section class="max-w-4xl mx-auto p-4">
        <div class="flex justify-between items-center mb-6">
            <h3 class="text-2xl font-bold">Полная информация о диаграмме</h3>
            
            <!-- Бейдж статуса -->
            <span class="px-3 py-1 rounded-full text-sm font-medium 
                @if($diagram->status === 'draft') bg-yellow-100 text-yellow-800
                @elseif($diagram->status === 'review') bg-blue-100 text-blue-800
                @else bg-green-100 text-green-800 @endif">
                @if($diagram->status === 'draft') Черновик
                @elseif($diagram->status === 'review') На проверке
                @else Проверено @endif
            </span>
        </div>

        <div class="bg-black/5 p-6 rounded-xl space-y-4">
            <!-- Информация о диаграмме -->
            <div class="grid md:grid-cols-2 gap-4">
                <div>
                    <h4 class="text-sm font-medium text-gray-700">Задание</h4>
                    <p class="mt-1 text-lg">
                        {{ match($diagram->type) {
                            'type1' => 'Задание 1',
                            'type2' => 'Задание 2',
                            'type3' => 'Задание 3',
                            default => $diagram->type
                        } }}
                    </p>
                </div>

                <div>
                    <h4 class="text-sm font-medium text-gray-700">Дата создания</h4>
                    <p class="mt-1 text-lg">{{ $diagram->created_at->format('d.m.Y H:i') }}</p>
                </div>
            </div>

            <div>
                <h4 class="text-sm font-medium text-gray-700">Название</h4>
                <p class="mt-1 text-lg">{{ $diagram->title }}</p>
            </div>

            <div>
                <h4 class="text-sm font-medium text-gray-700">Описание</h4>
                <p class="mt-1 text-lg whitespace-pre-line">{{ $diagram->description }}</p>
            </div>

            <div>
                <h4 class="text-sm font-medium text-gray-700">Файл диаграммы</h4>
                <div class="mt-1 flex items-center gap-2">
                    <a href="{{ asset('storage/' . $diagram->file_path) }}" download 
                       class="text-blue-600 hover:underline flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                        </svg>
                        {{ basename($diagram->file_path) }}
                    </a>
                    {{-- <span class="text-xs text-gray-500">{{ round(Storage::size('diagrams/' . $diagram->file_path) / 1024) }} KB</span> --}}
                </div>
            </div>

            <!-- Комментарий администратора -->
            @if($diagram->admin_comment)
            <div class="mt-4 pt-4 border-t border-gray-200">
                <h4 class="text-sm font-medium text-gray-700">Комментарий преподавателя</h4>
                <div class="mt-2 p-3 bg-white rounded-lg whitespace-pre-line">{{ $diagram->admin_comment }}</div>
            </div>
            @endif
        </div>

        <div class="mt-6 flex justify-between">
            <a href="{{ route('laboratory.index') }}" 
               class="bg-castom_blue/50 px-4 py-2 rounded-full text-white hover:bg-castom_blue/60 transition-colors flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Назад к списку
            </a>
            
            @if($diagram->status !== 'approved')
            <a href="/laboratory/{{ $diagram->id }}/edit" 
               class="bg-castom_blue/50 px-4 py-2 rounded-full text-white hover:bg-castom_blue/60 transition-colors flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                </svg>
                Редактировать
            </a>
            @endif
        </div>
    </section>
</x-layout>