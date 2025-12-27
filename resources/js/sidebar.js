/**
 * EventMaster - Sidebar Component
 * Responsive sidebar with toggle functionality
 */

// State
window.sidebarExpanded = true;
window.sidebarMobileOpen = false;

// Toggle sidebar (mobile - show/hide)
window.toggleMobileSidebar = function () {
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('sidebar-overlay');

    if (!sidebar || !overlay) return;

    window.sidebarMobileOpen = !window.sidebarMobileOpen;

    if (window.sidebarMobileOpen) {
        sidebar.classList.remove('-translate-x-full');
        sidebar.classList.add('translate-x-0');
        overlay.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    } else {
        sidebar.classList.add('-translate-x-full');
        sidebar.classList.remove('translate-x-0');
        overlay.classList.add('hidden');
        document.body.style.overflow = '';
    }
};

// Toggle sidebar (desktop - collapse/expand)
window.toggleSidebar = function () {
    const sidebar = document.getElementById('sidebar');
    const toggleIcon = document.getElementById('toggle-icon');
    const sidebarInner = sidebar.querySelector('.sidebar-inner');

    window.sidebarExpanded = !window.sidebarExpanded;

    if (window.sidebarExpanded) {
        // Expand
        sidebar.style.width = '16rem'; // w-64
        if (toggleIcon) toggleIcon.textContent = 'chevron_left';

        document.querySelectorAll('.sidebar-label').forEach(el => {
            el.style.display = 'block';
            el.style.opacity = '1';
        });
        document.querySelectorAll('.sidebar-link').forEach(el => {
            el.style.justifyContent = 'flex-start';
            el.style.paddingLeft = '0.75rem';
            el.style.paddingRight = '0.75rem';
        });
        document.querySelectorAll('.sidebar-logo').forEach(el => {
            el.style.justifyContent = 'flex-start';
        });
        document.querySelectorAll('.sidebar-profile').forEach(el => {
            el.style.justifyContent = 'flex-start';
        });
        document.querySelectorAll('.theme-toggle-row').forEach(el => {
            el.style.justifyContent = 'space-between';
        });
        const themeSwitch = document.getElementById('theme-switch');
        if (themeSwitch) themeSwitch.style.display = 'inline-flex';
    } else {
        // Collapse
        sidebar.style.width = '88px';
        if (toggleIcon) toggleIcon.textContent = 'chevron_right';

        document.querySelectorAll('.sidebar-label').forEach(el => {
            el.style.display = 'none';
            el.style.opacity = '0';
        });
        document.querySelectorAll('.sidebar-link').forEach(el => {
            el.style.justifyContent = 'center';
            el.style.paddingLeft = '0.75rem';
            el.style.paddingRight = '0.75rem';
        });
        document.querySelectorAll('.sidebar-logo').forEach(el => {
            el.style.justifyContent = 'center';
        });
        document.querySelectorAll('.sidebar-profile').forEach(el => {
            el.style.justifyContent = 'center';
        });
        document.querySelectorAll('.theme-toggle-row').forEach(el => {
            el.style.justifyContent = 'center';
        });
        const themeSwitch = document.getElementById('theme-switch');
        if (themeSwitch) themeSwitch.style.display = 'none';
    }
};

// Theme toggle
window.toggleTheme = function () {
    const html = document.documentElement;
    const themeIcon = document.getElementById('theme-icon');
    const themeLabel = document.getElementById('theme-label');
    const themeSwitch = document.getElementById('theme-switch');
    const switchKnob = themeSwitch ? themeSwitch.querySelector('span') : null;

    if (html.classList.contains('dark')) {
        html.classList.remove('dark');
        html.classList.add('light');
        localStorage.setItem('theme', 'light');
        if (themeIcon) themeIcon.textContent = 'light_mode';
        if (themeLabel) themeLabel.textContent = 'Modo Claro';
        if (themeSwitch) {
            themeSwitch.classList.remove('bg-orange-600');
            themeSwitch.classList.add('bg-gray-500');
        }
        if (switchKnob) {
            switchKnob.classList.remove('translate-x-5');
            switchKnob.classList.add('translate-x-0');
        }
    } else {
        html.classList.remove('light');
        html.classList.add('dark');
        localStorage.setItem('theme', 'dark');
        if (themeIcon) themeIcon.textContent = 'dark_mode';
        if (themeLabel) themeLabel.textContent = 'Modo Oscuro';
        if (themeSwitch) {
            themeSwitch.classList.add('bg-orange-600');
            themeSwitch.classList.remove('bg-gray-500');
        }
        if (switchKnob) {
            switchKnob.classList.add('translate-x-5');
            switchKnob.classList.remove('translate-x-0');
        }
    }
};

// Init Theme
document.addEventListener('DOMContentLoaded', () => {
    if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
        document.documentElement.classList.add('dark');
        const themeIcon = document.getElementById('theme-icon');
        const themeLabel = document.getElementById('theme-label');
        if (themeIcon) themeIcon.textContent = 'dark_mode';
        if (themeLabel) themeLabel.textContent = 'Modo Oscuro';
        // Note: Toggle switch state setting would be needed here too ideally
    } else {
        document.documentElement.classList.remove('dark');
    }
});
