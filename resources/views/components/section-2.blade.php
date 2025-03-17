@props(['title' => '', 'description' => '', 'logo' => ''])

<div class="p-10 flex flex-col text-black">
    <div class="flex items-center mb-4 space-x-3">
        <h3 class="text-xl font-bold">{{ $title }}</h3>
        <img src={{ $logo }} alt="Логотип 1" class="h-8 w-8 mr-4">
    </div>
    <p class="text-left">{{ $description }}</p>
</div>