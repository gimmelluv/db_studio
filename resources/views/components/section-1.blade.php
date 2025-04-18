@props(['title' => '', 'description' => '', 'href' => '#'])

<a href="{{ $href }}" class="block hover:scale-[1.02] transition-transform duration-300">
    <x-panel class="flex flex-col text-left h-full">
        <!--заголовок "например теория" -->
        <div class="self-start font-bold group-hover:text-castom_blue transition-colors duration-300">{{ $title }}</div>
        <!--текстовое описание -->
        <div class="py-4 text-left flex-grow">
            <p>{{ $description }}</p>
        </div>
        <div class="flex justify-between items-center mt-auto">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-castom-black" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
            </svg>
        </div>
    </x-panel>
</a>
