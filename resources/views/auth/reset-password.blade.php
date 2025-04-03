<x-layout>
    <x-page-heading>Установка нового пароля</x-page-heading>
    
    <x-forms.form-reg method="POST" action="{{ route('password.update') }}">
        @csrf
        
        <input type="hidden" name="token" value="{{ $token }}">
        
        <x-forms.input-reg 
            label="Email" 
            name="email" 
            type="email" 
            value="{{ $email ?? old('email') }}" 
            required 
            autofocus
        />
        
        <x-forms.input-reg 
            label="Новый пароль" 
            name="password" 
            type="password" 
            required 
        />
        
        <x-forms.input-reg 
            label="Подтвердите пароль" 
            name="password_confirmation" 
            type="password" 
            required 
        />
        
        <div class="flex justify-center mt-5">
            <x-forms.button>Обновить пароль</x-forms.button>
        </div>
    </x-forms.form-reg>
</x-layout>