<div>
    <div class="login-card">
        <div class="flex flex-col w-full justify-center items-center gap-4">
            <div class="text-4xl">🚗</div>
            <h2 class="font-bold text-2xl">Entrar</h2>
            <p class="text-center text-xl">Acesse sua conta para visualizar serviços, rotas e atendimentos.</p>
        </div>

        <x-loading loading="login" />

        <form wire:submit="login">

            <input type="email" wire:model="email" placeholder="Seu e-mail" >
            @error('email')
            <p class="text-red-800">{{ $message }}</p>
            @enderror

            <input type="password" wire:model="password" placeholder="Sua senha" >
            @error('password')
            <p class="text-red-800">{{ $message }}</p>
            @enderror
            <x-checkbox wire:model="remember" :label="__('Remember me')" />


            <button type="submit">Acessar</button>
        </form>

        <div class="flex flex-col mt-2 ">
            <button wire:click="loginGoogle" class="text-black"><i class="fa-brands fa-google"></i> Login com Google</button>
        </div>

        <div class="pt-4">
            <a  href="{{route('password.request')}}" class="text-gray-600 font-medium hover:underline" >Esqueceu a Senha ?</a>
{{--            <p class="text-center text-xl">Caso deseja efetuar um cadastro clique <a href="{{route('client')}}"> aqui!</a></p>--}}
        </div>




    </div>
</div>
