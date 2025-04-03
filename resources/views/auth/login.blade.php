<x-layout>
    <x-page-heading>Вход</x-page-heading>
    
    <x-forms.form-reg method="POST" action="/login">
        <x-forms.input-reg label="Email" name="email" type="email"/>
        <x-forms.input-reg label="Пароль" name="password" type="password"/>

        <div class="flex justify-center mt-5">
            <x-forms.button>Войти</x-forms.button>
        </div>

        <div class="mt-4 text-center">
            <a href="{{ route('password.request') }}" class="text-blue-600 hover:text-blue-800">
                Забыли пароль?
            </a>
        </div>
    </x-forms.form-reg>
</x-layout>