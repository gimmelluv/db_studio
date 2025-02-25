<x-layout>
    <div class="container mx-auto">
        <div class="mb-4">
            <h2 class="text-lg font-semibold text-center">Прогресс по курсу</h2>
            <div class="relative pt-1">
                <div class="flex mb-2 items-center justify-between">
                    <div>
                        <span class="text-xs inline-block py-1 px-2 uppercase rounded-full text-white bg-castom_blue">
                            Прогресс: {{ round($progress) }}%
                        </span>
                    </div>
                    <div class="text-right">
                        <span class="text-xs font-semibold inline-block text-castom_blue">
                            100%
                        </span>
                    </div>
                </div>
                <div class="flex h-2 mb-2 bg-gray-200 rounded">
                    <div class="bg-castom_blue h-full" style="width: {{ $progress }}%;"></div>
                </div>
            </div>
        </div>

        <h2 class="text-lg font-semibold mb-4">Пройденные разделы:</h2>
        <ul>
            @foreach ($theories as $theory)
                <li>
                    <div class="flex items-center">
                        <!-- Иконка статуса -->
                        <div class="w-6 h-6 rounded-full flex items-center justify-center mr-4 {{ $user->theories->contains($theory->id) && $user->theories()->where('theory_id', $theory->id)->first()->pivot->is_passed ? 'bg-green-500' : 'bg-gray-300' }}">
                            @if ($user->theories->contains($theory->id) && $user->theories()->where('theory_id', $theory->id)->first()->pivot->is_passed)
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                            @endif
                        </div>
                        <!-- Название раздела -->
                        <div>
                            <h3 class="font-bold">{{ $theory->title }}</h3>
                            <p class="text-sm text-gray-600">Теория</p>
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
</x-layout>