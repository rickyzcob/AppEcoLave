<div class="top-buttons">
    @if(auth()->user() && auth()->user()->scope === 'client')
    <a href="{{route('client.dashboard')}}" class="btn-cliente cursor-pointer"> {{auth()->user()->name}}</a>

{{--        <div x-data="{ open: false }" class="relative inline-block">--}}

{{--            <!-- Botão -->--}}
{{--            <button--}}
{{--                @click="open = !open"--}}
{{--                @click.outside="open = false"--}}
{{--                class="flex items-center gap-2 bg-white text-azul font-bold text-sm px-5 py-2.5 rounded-full cursor-pointer">--}}
{{--                {{ auth()->user()->name }}--}}
{{--                <svg--}}
{{--                    :class="open ? 'rotate-180' : ''"--}}
{{--                    class="w-4 h-4 transition-transform duration-200"--}}
{{--                    fill="none" stroke="currentColor" viewBox="0 0 24 24">--}}
{{--                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />--}}
{{--                </svg>--}}
{{--            </button>--}}

{{--            <!-- Dropdown -->--}}
{{--            <div--}}
{{--                x-show="open"--}}
{{--                x-transition:enter="transition ease-out duration-150"--}}
{{--                x-transition:enter-start="opacity-0 scale-95"--}}
{{--                x-transition:enter-end="opacity-100 scale-100"--}}
{{--                x-transition:leave="transition ease-in duration-100"--}}
{{--                x-transition:leave-start="opacity-100 scale-100"--}}
{{--                x-transition:leave-end="opacity-0 scale-95"--}}
{{--                class="absolute right-0 mt-2 w-56 bg-white rounded-2xl shadow-lg overflow-hidden z-50"--}}
{{--                style="display: none;">--}}

{{--                <a href="{{route('my-profile')}}" class="flex items-center gap-3 px-5 py-3 text-sm text-gray-700 hover:bg-gray-50 transition-colors">--}}
{{--                    <i data-lucide="user" class="w-4 h-4"></i>--}}
{{--                    Meu Perfil--}}
{{--                </a>--}}

{{--                <a href="{{route('my-my-orders')}}" class="flex items-center gap-3 px-5 py-3 text-sm text-gray-700 hover:bg-gray-50 transition-colors">--}}
{{--                    <i data-lucide="package" class="w-4 h-4"></i>--}}
{{--                    Meus Pedidos--}}
{{--                </a>--}}

{{--                <a href="#" class="flex items-center gap-3 px-5 py-3 text-sm text-gray-700 hover:bg-gray-50 transition-colors">--}}
{{--                    <i data-lucide="settings" class="w-4 h-4"></i>--}}
{{--                    Configurações--}}
{{--                </a>--}}

{{--                <div class="border-t border-gray-100"></div>--}}

{{--                <form id="logout-form" method="POST" action="{{ route('logout') }}">--}}
{{--                    @csrf--}}
{{--                    <a onclick="event.preventDefault(); document.getElementById('logout-form').submit();"--}}
{{--                       class="flex items-center gap-3 px-5 py-3 text-sm text-red-600 hover:bg-red-50 transition-colors cursor-pointer">--}}
{{--                        <i data-lucide="log-out" class="w-4 h-4"></i>--}}
{{--                        Sair--}}
{{--                    </a>--}}
{{--                </form>--}}

{{--            </div>--}}

{{--        </div>--}}

{{--        <script>--}}
{{--            lucide.createIcons();--}}
{{--        </script>--}}

    @elseif(auth()->user() && auth()->user()->scope === 'admin'))
        <a href="{{route('admin.dashboard')}}" class="btn-cliente cursor-pointer"> {{auth()->user()->name}}</a>

    @elseif(auth()->user() && auth()->user()->scope === 'washer'))
        <a href="{{route('profissional.dashboard')}}" class="btn-cliente cursor-pointer"> {{auth()->user()->name}}</a>
    @else
        <a wire:click="openCentralModal('site.login.form', {'id': null })" class="btn-cliente cursor-pointer">Área do Cliente</a>
{{--        <a wire:click="openCentralModal('site.login.form', {'id': null })"  class="btn-lavador cursor-pointer">Área do Lavador</a>--}}
    @endif
</div>
