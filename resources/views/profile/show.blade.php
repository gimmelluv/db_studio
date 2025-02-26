<x-layout>
    <div class="min-h-screen bg-gray-100 py-8">
        <div class="max-w-2xl mx-auto bg-white shadow-lg rounded-lg p-6">
            <h1 class="text-3xl font-bold text-gray-800 mb-6">Профиль пользователя</h1>
            <div class="space-y-4">
                <div class="flex items-center">
                    <span class="text-gray-700 font-medium w-24">Имя:</span>
                    <span class="text-gray-900">{{ $user->name }}</span>
                </div>
                <div class="flex items-center">
                    <span class="text-gray-700 font-medium w-24">Email:</span>
                    <span class="text-gray-900">{{ $user->email }}</span>
                </div>
            </div>
            <div class="mt-6">
                <a href="{{ route('profile.edit') }}" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition duration-200">
                    Редактировать профиль
                </a>
            </div>
        </div>
    </div>
</x-layout>
