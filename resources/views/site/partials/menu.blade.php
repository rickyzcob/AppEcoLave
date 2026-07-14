<a class="logo" href="{{ route('home') }}">Eco<span>Lave</span></a>
<button class="menu-toggle" onclick="toggleMenu()">☰</button>
<div class="menu-area" id="menuArea">
    <nav>
        <a href="{{ route('home') }}" class="menu-link">Início</a>
        <a href="#problemas" class="menu-link">Soluções</a>
        <a href="{{ route('about') }}" class="menu-link">Sobre</a>
        <a href="{{ route('schedule') }}" class="menu-link">Agendar</a>
        <a href="{{ route('plans') }}" class="menu-link">Planos</a>
        <a href="{{ route('testimonials') }}" class="menu-link">Depoimentos</a>
        <a href="#faq" class="menu-link">FAQ</a>
        <a href="{{ route('contact') }}" class="menu-link">Contato</a>
    </nav>

    <livewire:site.partials.header.card/>
</div>

