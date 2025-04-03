<x-layout>
    <x-page-heading>Восстановление пароля</x-page-heading>
    
    <x-forms.form-reg method="POST" action="{{ route('password.email') }}">
        @csrf
        
        <x-forms.input-reg label="Email" name="email" type="email" required autofocus/>
        
        <div class="flex justify-center mt-5">
            <x-forms.button>Отправить ссылку для сброса</x-forms.button>
        </div>
        
        <div class="mt-4 text-center">
            <a href="{{ route('login') }}" class="text-blue-600 hover:text-blue-800">
                Вернуться к входу
            </a>
        </div>
    </x-forms.form-reg>
</x-layout>