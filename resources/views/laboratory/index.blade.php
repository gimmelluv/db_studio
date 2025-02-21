<x-layout>
    <section>
        <div class="mx-auto sm:flex sm:items-center sm:justify-between">
            <h3 class="mb-6">Мои работы</h3>
            {{-- <x-forms.button class="mt-2 mb-6">Создать диаграмму</x-forms.button> --}}
            <a href="/laboratory/create" class="bg-castom_blue/60 text-white hover:bg-castom_blue/50 px-4 py-2 rounded-full mt-2 mb-6">Создать диаграмму</a>
        </div>

        <div class="grid lg:grid-cols-3 gap-8">
            <x-lab-card />
            <x-lab-card />
            <x-lab-card />
        </div>
    </section>
</x-layout>