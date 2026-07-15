<div class="topbar">
    <div class="topbar-left">
        <button class="toggle" onclick="toggleSidebar()">☰</button>

        @include('admin.partials.breadcrumb', ['title'=> $title, 'phrase' => $phrase])
    </div>

    <div class="user-box">
        <div>
            <strong>{{auth()->user()->name}}</strong>
            <p> {{auth()->user()->email}}</p>
        </div>

        <div x-data="{ open: false }" class="relative inline-block">

            <button
                @click="open = !open"
                @click.outside="open = false"
                class="user-avatar cursor-pointer">
                {{mb_strtoupper(mb_substr(auth()->user()->name, 0, 1))}}
            </button>

            <div
                x-show="open"
                x-transition:enter="transition ease-out duration-150"
                x-transition:enter-start="opacity-0 scale-95"
                x-transition:enter-end="opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-100"
                x-transition:leave-start="opacity-100 scale-100"
                x-transition:leave-end="opacity-0 scale-95"
                class="absolute right-0 mt-2 w-56 bg-white rounded-2xl shadow-lg z-100"
                style="display: none;">

                <a href="{{route('admin.my-profile')}}" class="flex items-center gap-3 px-5 py-3 text-sm text-gray-700 hover:bg-gray-50 transition-colors">
                    <i data-lucide="user" class="w-4 h-4"></i>
                    Meu Perfil
                </a>

                <a href="{{route('admin.my-my-orders')}}" class="flex items-center gap-3 px-5 py-3 text-sm text-gray-700 hover:bg-gray-50 transition-colors">
                    <i data-lucide="package" class="w-4 h-4"></i>
                    Meus Pedidos
                </a>

                <div class="border-t border-gray-100"></div>

                <form id="logout-form" method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                       class="flex items-center gap-3 px-5 py-3 text-sm text-red-600 hover:bg-red-50 transition-colors cursor-pointer">
                        <i data-lucide="log-out" class="w-4 h-4"></i>
                        Sair
                    </a>
                </form>

            </div>
        </div>
    </div>
</div>
