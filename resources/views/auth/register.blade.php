<x-layout>
    <x-page-heading>Регистрация</x-page-heading>
    
    <x-forms.form-reg method="POST" action="/register">
        <x-forms.input-reg label="Имя" name="name"/>
        <x-forms.input-reg label="Email" name="email" type="email"/>
        <x-forms.input-reg label="Пароль" name="password" type="password"/>
        <x-forms.input-reg label="Повторите пароль" name="password_confirmation" type="password"/>

        <div class="flex justify-center mt-5">
            <x-forms.button>Зарегистрироваться</x-forms.button>
        </div>
    </x-forms.form-reg>
</x-layout>