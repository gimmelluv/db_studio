<x-layout>
    <div class="min-h-screen bg-gray-100 py-8">
        <div class="max-w-2xl mx-auto bg-white shadow-lg rounded-lg p-6">
            <h1 class="text-3xl font-bold text-gray-800 mb-6">Редактирование профиля</h1>
            <form action="{{ route('profile.update') }}" method="POST">
                @csrf
                @method('PATCH')

                <div class="space-y-4">
                    <div class="flex items-center">
                        <span class="text-gray-700 font-medium w-24">Имя:</span>
                        <input type="text" name="name" id="name" class="form-control border-gray-300 rounded-md" value="{{ old('name', $user->name) }}" required>
                        @error('name')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="flex items-center">
                        <span class="text-gray-700 font-medium w-24">Email:</span>
                        <input type="email" name="email" id="email" class="form-control border-gray-300 rounded-md" value="{{ old('email', $user->email) }}" required>
                        @error('email')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="flex items-center">
                        <span class="text-gray-700 font-medium w-24">Новый пароль:</span>
                        <input type="password" name="password" id="password" class="form-control border-gray-300 rounded-md">
                        @error('password')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="flex items-center">
                        <span class="text-gray-700 font-medium w-24">Повторите пароль:</span>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control border-gray-300 rounded-md">
                    </div>
                </div>

                <div class="flex justify-between mt-6">
                    <div class="flex items-center">
                        <a href="{{ route('profile.show') }}" class="bg-castom_blue/60 text-white px-4 py-2 rounded-full hover:bg-castom_blue/50 transition duration-300">
                            Назад
                        </a>
                    </div>

                    <div class="flex items-center gap-x-6">
                        <button form="delete-form" class="text-red-500 text-sm">Удалить</button>
                        <button type="submit" class="bg-castom_blue/60 text-white px-4 py-2 rounded-full hover:bg-castom_blue/50 transition duration-300">
                            Сохранить изменения
                        </button>
                    </div>
                </div>
            </form>

            <form method="POST" action="{{ route('profile.destroy') }}" id="delete-form" class="hidden">
                @csrf
                @method('DELETE')
            </form>
        </div>
    </div>
</x-layout>