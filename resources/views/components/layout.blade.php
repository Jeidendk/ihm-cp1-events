<!DOCTYPE html>
<html class="light" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>{{ $title ?? 'EventMaster' }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200"
        rel="stylesheet" />
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body
    class="font-sans text-slate-600 dark:text-slate-300 antialiased overflow-hidden h-screen w-full flex bg-mesh-light dark:bg-mesh bg-fixed bg-cover selection:bg-orange-500 selection:text-white">

    <!-- Sidebar -->
    <x-sidebar :active-page="$activePage ?? 'dashboard'" />

    <!-- Main Content -->
    <main class="flex-1 flex flex-col h-full min-w-0 p-4 md:pl-0 relative z-10 animate-fade-in">
        {{ $slot }}
    </main>

    <!-- Form Modal Backdrop -->
    <div id="form-modal-backdrop"
        class="fixed inset-0 bg-black/50 backdrop-blur-sm z-40 hidden opacity-0 transition-opacity duration-300 xl:hidden"
        onclick="closeFormModal()"></div>
        
    <!-- Push additional scripts/modals if needed -->
    @stack('modals')
    @stack('scripts')
</body>

</html>
