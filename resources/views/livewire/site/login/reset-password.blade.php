<div>
    <div class="login-card">
        <div class="flex flex-col w-full justify-center items-center gap-4">
            <div class="text-4xl">🚗</div>
            <h2 class="font-bold text-2xl">Alterar Senha</h2>
            <p class="text-center text-xl">Insira e confirme sua nova senhas nos campos abaixo </p>
        </div>

        <x-loading loading="resetPassword" />

        <form wire:submit="resetPassword">
            <input type="password" wire:model="password" placeholder="Nova senha" >
            @error('password')
            <p class="text-red-800">{{ $message }}</p>
            @enderror

            <input type="password" wire:model="password_confirmation" placeholder="Confirmar senha" >
            @error('password')
            <p class="text-red-800">{{ $message }}</p>
            @enderror
            <button type="submit">Alterar Senha</button>
        </form>
    </div>
</div>
