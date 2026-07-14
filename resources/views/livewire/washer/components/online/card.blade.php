<div>
    <div class="profile-photo">👤</div>
    <h3>{{auth()->user()->name}}</h3>
    <p>Lavador aprovado</p>
    <div class="status-toggle">
        <button @class($response->user['is_online'] === 'online' ? 'online' : 'offline') wire:click="changeStatus({{auth()->user()->id}}, 'online')">Online</button>
        <button @class($response->user['is_online'] === 'offline'  ? 'online' : 'offline') wire:click="changeStatus({{auth()->user()->id}}, 'offline')">Offline</button>
    </div>
</div>
