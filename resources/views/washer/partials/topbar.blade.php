<div class="topbar">
    <div class="topbar-left">
        <button class="toggle" onclick="toggleSidebar()">☰</button>

        @include('washer.partials.breadcrumb', ['title'=> $title, 'phrase' => $phrase])

    </div>

    <div class="quick-status">
        <livewire:washer.components.online.badge/>
    </div>
</div>
