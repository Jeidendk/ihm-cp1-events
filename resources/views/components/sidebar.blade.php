@props(['activePage'])

<!-- Mobile Overlay -->
<div id="sidebar-overlay" class="fixed inset-0 bg-black/50 backdrop-blur-sm z-30 hidden" onclick="toggleMobileSidebar()"></div>

<!-- Sidebar -->
<aside id="sidebar" class="fixed md:relative w-72 md:w-64 flex-col justify-between shrink-0 z-40 p-4 h-full transition-all duration-300 ease-out -translate-x-full md:translate-x-0 flex" style="width: 16rem;">
    <div class="sidebar-inner bg-[#2c323d] text-white h-full flex flex-col shadow-2xl overflow-hidden rounded-[32px] border border-white/5">
        <!-- Logo Area -->
        <div class="sidebar-logo p-5 flex items-center gap-3 border-b border-white/5">
            <div class="w-10 h-10 rounded-xl bg-orange-600 flex items-center justify-center shrink-0">
                <span class="material-symbols-rounded text-white text-xl">calendar_month</span>
            </div>
            <div class="sidebar-label">
                <h1 class="text-base font-bold tracking-tight text-white leading-tight">Gestor de</h1>
                <p class="text-sm text-gray-400 font-medium">eventos</p>
            </div>
        </div>

        <!-- Toggle Button (Desktop) -->
        <button id="sidebar-toggle" class="hidden md:flex absolute -right-3 top-20 w-6 h-6 bg-[#2c323d] border border-white/10 rounded-full items-center justify-center text-white/60 hover:text-white hover:bg-orange-600 transition-colors z-50" onclick="toggleSidebar()">
            <span class="material-symbols-rounded text-sm" id="toggle-icon">chevron_left</span>
        </button>

        <!-- Navigation -->
        <nav class="flex-1 flex flex-col gap-1 p-3 overflow-y-auto custom-scroll">
            <div class="sidebar-label text-xs font-semibold text-gray-400 uppercase tracking-wider px-3 mb-2 mt-2">
                Menu
            </div>
            
            @php
            $menuItems = [
                ['id' => 'dashboard', 'icon' => 'dashboard', 'label' => 'Dashboard', 'href' => route('dashboard')],
                ['id' => 'events', 'icon' => 'event', 'label' => 'Eventos', 'href' => route('events.index')],
                ['id' => 'locations', 'icon' => 'location_on', 'label' => 'Ubicaciones', 'href' => route('locations.index')],
                ['id' => 'contacts', 'icon' => 'group', 'label' => 'Contactos', 'href' => route('contacts.index')],
            ];
            @endphp

            @foreach($menuItems as $item)
                @php
                    $isActive = $item['id'] === $activePage;
                    $classes = "sidebar-link flex items-center gap-3 py-3 px-3 rounded-2xl transition-all " . 
                             ($isActive ? "bg-white/10 text-white border border-white/10 shadow-sm" : "hover:bg-white/5 text-gray-300 hover:text-white");
                    $iconClasses = $isActive ? "icon-filled" : "";
                @endphp
                <a class="{{ $classes }}" href="{{ $item['href'] }}">
                    <span class="material-symbols-rounded {{ $iconClasses }} shrink-0 text-xl">{{ $item['icon'] }}</span>
                    <span class="sidebar-label text-sm font-{{ $isActive ? 'semibold' : 'medium' }}">{{ $item['label'] }}</span>
                </a>
            @endforeach
        </nav>

        <!-- Theme Toggle Switch -->
        <div class="p-3 border-t border-white/5">
            <div class="theme-toggle-row flex items-center gap-3 px-3 py-3 rounded-2xl justify-between">
                <div class="flex items-center gap-3">
                    <span class="material-symbols-rounded shrink-0 text-xl text-gray-300" id="theme-icon">light_mode</span>
                    <span class="sidebar-label text-sm font-medium text-gray-300" id="theme-label">Modo Claro</span>
                </div>
                <button id="theme-switch" onclick="toggleTheme()" 
                    class="sidebar-label relative inline-flex h-6 w-11 shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none bg-gray-500">
                    <span class="pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out translate-x-0"></span>
                </button>
            </div>
        </div>

        <!-- Profile Section -->
        <div class="p-3 border-t border-white/5">
            <div class="sidebar-profile flex items-center gap-3 px-3 py-2 rounded-2xl hover:bg-white/5 cursor-pointer transition-all">
                <img src="https://ui-avatars.com/api/?name=Demo&background=ea580c&color=fff&size=40&rounded=true&bold=true" 
                     alt="Profile" 
                     class="w-10 h-10 rounded-full shrink-0 ring-2 ring-orange-500/30">
                <div class="sidebar-label flex-1 min-w-0">
                    <p class="text-sm font-semibold text-white truncate">Demo</p>
                    <p class="text-xs text-gray-400 truncate">demo@event...</p>
                </div>
                <span class="sidebar-label material-symbols-rounded text-gray-400 text-lg">expand_more</span>
            </div>
        </div>
    </div>
</aside>
