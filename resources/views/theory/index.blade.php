<x-layout>
    <div class="flex">
        <div>
            <h2 class="font-bold text-lg mb-2">Навигация</h2>
            <ul class="list-disc pl-5">
                @foreach ($theories as $theory)
                    <x-theory-head-nav sectionId="section{{ $theory->id }}" sectionTitle="{{ $theory->title }}"/>
                @endforeach
            </ul>
        </div>

        <div class="ml-20">
            @foreach ($theories as $theory)
                <x-theory-head sectionId="section{{ $theory->id }}" sectionTitle="{{ $theory->title }}"/>
                <p class="mt-10 mb-10">{{ $theory->content }}</p>

                <form action="{{ route('theory.markAsPassed', $theory) }}" method="POST">
                    @csrf
                    <button type="submit" class="bg-castom_blue/60 text-white px-4 py-2 rounded-full hover:bg-castom_blue/50 transition duration-300">
                        Отметить пройденным
                    </button>
                </form>

                <!-- Добавьте дополнительный элемент для отступа -->
                <div class="mt-10"></div> <!-- Это создаст дополнительное пространство -->
            @endforeach
        </div>
    </div>

</x-layout>