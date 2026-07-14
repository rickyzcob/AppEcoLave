<div>
    <div class="login-card">
        <div class="flex flex-col w-full justify-center items-center gap-4">
            <div class="text-4xl">🚗</div>
            <h2 class="font-bold text-2xl">Esqueceu a Senha ?</h2>
            <p class="text-center text-md">Digite seu e-mail para receber um email com o link para redefinir sua senha</p>
        </div>

        <x-loading loading="sendPasswordResetLink" />

        <form wire:submit="sendPasswordResetLink">

            <input type="email" wire:model="email" placeholder="Seu e-mail" >
            @error('email')
            <p class="text-red-800">{{ $message }}</p>
            @enderror

            <button type="submit">Enviar Link para redefinir senha por e-mail</button>
        </form>

        <div class="pt-4 text-center">
            <a  href="{{route('login')}}" class="text-gray-600 font-medium hover:underline" >Clique aqui para voltar</a>
        </div>

    </div>
</div>
