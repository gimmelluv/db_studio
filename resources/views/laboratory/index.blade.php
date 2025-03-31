<x-layout>
    <section>
        <div class="mx-auto sm:flex sm:items-center sm:justify-between">
            <h3 class="mb-6">Мои работы</h3>
            <a href="/laboratory/create" class="bg-castom_blue/60 text-white hover:bg-castom_blue/50 px-4 py-2 rounded-full mt-2 mb-6">
                Создать диаграмму
            </a>
        </div>

        <!-- Фильтры по статусам -->
        <div class="mb-8 flex space-x-2 overflow-x-auto pb-2">
            <a href="{{ route('laboratory.index') }}" 
               class="px-4 py-2 rounded-full {{ !request('status') ? 'bg-castom_blue/60 text-white' : 'bg-gray-200' }}">
                Все работы
            </a>
            <a href="{{ route('laboratory.index', ['status' => 'draft']) }}" 
               class="px-4 py-2 rounded-full {{ request('status') === 'draft' ? 'bg-yellow-500 text-white' : 'bg-gray-200' }}">
                Черновики
            </a>
            <a href="{{ route('laboratory.index', ['status' => 'review']) }}" 
               class="px-4 py-2 rounded-full {{ request('status') === 'review' ? 'bg-blue-500 text-white' : 'bg-gray-200' }}">
                На проверке
            </a>
            <a href="{{ route('laboratory.index', ['status' => 'approved']) }}" 
               class="px-4 py-2 rounded-full {{ request('status') === 'approved' ? 'bg-green-500 text-white' : 'bg-gray-200' }}">
                Проверенные
            </a>
        </div>

        <div class="grid lg:grid-cols-3 gap-8">
            @forelse($diagrams as $diagram)
                <x-lab-card 
                    :type="$diagram->type" 
                    :title="$diagram->title" 
                    :description="$diagram->description" 
                    :diagram="$diagram"
                    :status="$diagram->status"
                    :adminComment="$diagram->admin_comment"
                />
            @empty
                <div class="col-span-3 text-center py-10">
                    <p class="text-gray-500">Нет работ по выбранному фильтру</p>
                    <a href="/laboratory/create" class="mt-4 inline-block bg-castom_blue/60 text-white hover:bg-castom_blue/50 px-4 py-2 rounded-full">
                        Создать первую диаграмму
                    </a>
                </div>
            @endforelse
        </div>

        <!-- Пагинация -->
        @if($diagrams->hasPages())
        <div class="mt-8">
            {{ $diagrams->links() }}
        </div>
        @endif
    </section>

    @if(session('success'))
        <div id="success-alert" class="fixed top-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg z-50">
            {{ session('success') }}
        </div>
    @endif

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Уведомление
            var alert = document.getElementById('success-alert');
            if (alert) {
                setTimeout(function() {
                    alert.style.display = 'none';
                }, 3000);
            }
        });
    </script>
</x-layout>