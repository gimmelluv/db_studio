<x-layout>
    <div class="flex">
        <div>
            <h2 class="font-bold text-lg mb-2">Навигация</h2>
            <ul class="list-disc pl-5">
                @foreach ($theories as $theory)
                    <x-theory-head-nav sectionId="section{{ $theory->id }}" sectionTitle="{{ $theory->title }}"/>
                @endforeach
                {{-- <x-theory-head-nav sectionId="section1" sectionTitle="Раздел 1"/>
                <x-theory-head-nav sectionId="section2" sectionTitle="Раздел 2"/>
                <x-theory-head-nav sectionId="section3" sectionTitle="Раздел 3"/>
                <x-theory-head-nav sectionId="section4" sectionTitle="Раздел 4"/> --}}
            </ul>
        </div>

        <div class="ml-20">
            @foreach ($theories as $theory)
                <x-theory-head sectionId="section{{ $theory->id }}" sectionTitle="{{ $theory->title }}"/>
                <p class="mt-5">{{ $theory->content }}</p>
            @endforeach
            {{-- <x-theory-head sectionId="section1" sectionTitle="Раздел 1"/>
            <p class="mt-5">Содержание раздела 1...</p>
    
            <x-theory-head sectionId="section2" sectionTitle="Раздел 2" class="mt-6"/>
            <p>Содержание раздела 2...</p>
    
            <x-theory-head sectionId="section3" sectionTitle="Раздел 3" class="mt-6"/>
            <p>Содержание раздела 3...</p>
    
            <x-theory-head sectionId="section4" sectionTitle="Раздел 4" class="mt-6"/>
            <p>Содержание раздела 4...</p> --}}
        </div>
    </div>

</x-layout>