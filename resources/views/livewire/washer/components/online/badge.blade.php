<div>
    <div class="flex flex-row gap-1 items-center">
        @if(auth()->user()->is_online === 'online')
            <span class="w-3 h-3 bg-green-500 rounded-full"></span>
            <span id="statusText">Online e Disponível</span>
        @else
            <span class="w-3 h-3 bg-red-500 rounded-full"></span>
            <span id="statusText">Offline</span>
        @endif
    </div>
</div>
