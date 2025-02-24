<a href="{{ route('laboratory.show', $diagram->id) }}" class="p-4 bg-black/5 rounded-xl flex flex-col text-center min-h-[220px] hover:bg-black/10 transition-colors">
    <div class="text-sm">{{ $type }}</div>

    <div class="py-4 font-bold">
        <h3>{{ $title }}</h3>
    </div>
    <p>{{ $description }}</p>

    <div class="mt-auto">
        <span class="bg-castom_blue/50 px-2 py-1 rounded-xl text-xs text-white">Статус</span>
    </div>
</a>