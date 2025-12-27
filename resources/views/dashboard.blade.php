<x-layout title="Dashboard - EventMaster" active-page="dashboard">
    <!-- Header -->
    <header class="h-auto shrink-0 mb-4 md:mb-6 flex flex-wrap items-center justify-between gap-3 px-2">
        <div class="flex items-center gap-3 md:gap-4">
            <button onclick="toggleMobileSidebar()"
                class="md:hidden p-2 rounded-2xl glass text-slate-600 dark:text-slate-300 hover:bg-white/50 transition-colors">
                <span class="material-symbols-rounded">menu</span>
            </button>
            <div>
                <h2 class="text-xl md:text-2xl font-bold text-slate-900 dark:text-white tracking-tight">Bienvenido de nuevo</h2>
                <p class="text-xs md:text-sm text-slate-500 dark:text-slate-400">{{ now()->translatedFormat('F d, Y') }}</p>
            </div>
        </div>
    </header>

    <!-- Stats Cards -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 md:gap-4 mb-4 md:mb-6 px-2">
        <!-- Events Card -->
        <div class="glass rounded-[20px] md:rounded-[24px] shadow-float p-4 md:p-5 ring-1 ring-white/50 dark:ring-white/5 hover:scale-[1.02] transition-transform">
            <div class="flex items-start justify-between">
                <div class="w-10 h-10 md:w-12 md:h-12 rounded-xl md:rounded-2xl bg-orange-100 dark:bg-orange-900/30 text-orange-600 flex items-center justify-center">
                    <span class="material-symbols-rounded text-xl md:text-2xl">event</span>
                </div>
                <span class="hidden sm:inline-flex items-center px-2 py-0.5 rounded-full text-[10px] md:text-xs font-bold bg-emerald-100 text-emerald-600">+12%</span>
            </div>
            <div class="mt-3 md:mt-4">
                <p class="text-[10px] md:text-sm text-slate-500 font-medium">Total Eventos</p>
                <h3 class="text-2xl md:text-3xl font-bold text-slate-900 dark:text-white mt-0.5">{{ $eventsCount }}</h3>
            </div>
        </div>
        <!-- Locations Card -->
        <div class="glass rounded-[20px] md:rounded-[24px] shadow-float p-4 md:p-5 ring-1 ring-white/50 dark:ring-white/5 hover:scale-[1.02] transition-transform">
            <div class="flex items-start justify-between">
                <div class="w-10 h-10 md:w-12 md:h-12 rounded-xl md:rounded-2xl bg-blue-100 dark:bg-blue-900/30 text-blue-600 flex items-center justify-center">
                    <span class="material-symbols-rounded text-xl md:text-2xl">location_on</span>
                </div>
            </div>
            <div class="mt-3 md:mt-4">
                <p class="text-[10px] md:text-sm text-slate-500 font-medium">Ubicaciones</p>
                <h3 class="text-2xl md:text-3xl font-bold text-slate-900 dark:text-white mt-0.5">{{ $locationsCount }}</h3>
            </div>
        </div>
        <!-- Contacts Card -->
        <div class="glass rounded-[20px] md:rounded-[24px] shadow-float p-4 md:p-5 ring-1 ring-white/50 dark:ring-white/5 hover:scale-[1.02] transition-transform">
            <div class="flex items-start justify-between">
                <div class="w-10 h-10 md:w-12 md:h-12 rounded-xl md:rounded-2xl bg-violet-100 dark:bg-violet-900/30 text-violet-600 flex items-center justify-center">
                    <span class="material-symbols-rounded text-xl md:text-2xl">group</span>
                </div>
                <span class="hidden sm:inline-flex items-center px-2 py-0.5 rounded-full text-[10px] md:text-xs font-bold bg-emerald-100 text-emerald-600">+8%</span>
            </div>
            <div class="mt-3 md:mt-4">
                <p class="text-[10px] md:text-sm text-slate-500 font-medium">Contactos</p>
                <h3 class="text-2xl md:text-3xl font-bold text-slate-900 dark:text-white mt-0.5">{{ $contactsCount }}</h3>
            </div>
        </div>
        <!-- This Month Card -->
        <div class="glass rounded-[20px] md:rounded-[24px] shadow-float p-4 md:p-5 ring-1 ring-white/50 dark:ring-white/5 hover:scale-[1.02] transition-transform">
            <div class="flex items-start justify-between">
                <div class="w-10 h-10 md:w-12 md:h-12 rounded-xl md:rounded-2xl bg-amber-100 dark:bg-amber-900/30 text-amber-600 flex items-center justify-center">
                    <span class="material-symbols-rounded text-xl md:text-2xl">calendar_month</span>
                </div>
            </div>
            <div class="mt-3 md:mt-4">
                <p class="text-[10px] md:text-sm text-slate-500 font-medium">Este Mes</p>
                <h3 class="text-2xl md:text-3xl font-bold text-slate-900 dark:text-white mt-0.5">{{ $eventsThisMonth }}</h3>
            </div>
        </div>
    </div>

    <!-- Charts Row -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-3 md:gap-4 mb-4 md:mb-6 px-2">
        <div class="glass rounded-[20px] md:rounded-[24px] shadow-float p-4 md:p-6 ring-1 ring-white/50 dark:ring-white/5">
            <div class="flex items-center justify-between mb-3 md:mb-4">
                <h3 class="text-base md:text-lg font-bold text-slate-900 dark:text-white">Eventos por Mes</h3>
                <select class="text-xs md:text-sm border border-slate-300 dark:border-slate-700 rounded-lg md:rounded-xl px-2 md:px-3 py-1 md:py-1.5 bg-white dark:bg-dark-surface text-slate-600">
                    <option>{{ now()->year }}</option>
                </select>
            </div>
            <div class="h-48 md:h-64">
                <canvas id="barChart"></canvas>
            </div>
        </div>

        <div class="glass rounded-[20px] md:rounded-[24px] shadow-float p-4 md:p-6 ring-1 ring-white/50 dark:ring-white/5">
            <h3 class="text-base md:text-lg font-bold text-slate-900 dark:text-white mb-3 md:mb-4">Estado de Eventos</h3>
            <div class="h-48 md:h-64 flex items-center justify-center">
                <canvas id="pieChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Bottom Section -->
    <div class="grid grid-cols-1 xl:grid-cols-3 gap-3 md:gap-4 px-2 pb-4">
        <!-- Upcoming Events -->
        <div class="xl:col-span-2 glass rounded-[20px] md:rounded-[24px] shadow-float p-4 md:p-6 ring-1 ring-white/50 dark:ring-white/5">
            <div class="flex items-center justify-between mb-3 md:mb-4">
                <h3 class="text-base md:text-lg font-bold text-slate-900 dark:text-white">Próximos Eventos</h3>
                <a href="{{ route('events.index') }}" class="text-xs md:text-sm font-medium text-orange-600 hover:text-orange-700">Ver Todos</a>
            </div>
            <div class="space-y-2 md:space-y-3">
                @forelse($upcomingEvents as $event)
                <div class="flex items-center gap-3 md:gap-4 p-2 md:p-3 rounded-xl md:rounded-2xl hover:bg-white/50 dark:hover:bg-white/5 transition-colors border border-slate-200 dark:border-slate-700">
                    <div class="w-11 h-11 md:w-14 md:h-14 rounded-xl md:rounded-2xl bg-orange-100 dark:bg-orange-900/30 text-orange-600 flex flex-col items-center justify-center shrink-0">
                        <span class="text-[8px] md:text-[10px] font-bold uppercase">{{ $event->date->translatedFormat('M') }}</span>
                        <span class="text-lg md:text-xl font-bold">{{ $event->date->format('d') }}</span>
                    </div>
                    <div class="flex-1 min-w-0">
                        <h4 class="text-xs md:text-sm font-bold text-slate-900 dark:text-white truncate">{{ $event->title }}</h4>
                        <div class="flex items-center gap-2 md:gap-3 text-[10px] md:text-sm text-slate-500">
                            <span class="flex items-center gap-0.5"><span class="material-symbols-rounded text-[12px] md:text-[16px]">schedule</span> {{ $event->time }}</span>
                            @if($event->location)
                            <span class="flex items-center gap-0.5 hidden sm:flex"><span class="material-symbols-rounded text-[12px] md:text-[16px]">location_on</span> {{ $event->location->name }}</span>
                            @endif
                        </div>
                    </div>
                    <span class="px-2 py-0.5 rounded-full text-[9px] md:text-xs font-bold {{ $event->status == 'confirmado' ? 'bg-emerald-100 text-emerald-600' : 'bg-amber-100 text-amber-600' }} shrink-0">
                        {{ ucfirst($event->status) }}
                    </span>
                </div>
                @empty
                    <p class="text-sm text-slate-500 text-center py-4">No hay eventos próximos.</p>
                @endforelse
            </div>
        </div>

        <!-- Recent Contacts -->
        <div class="glass rounded-[20px] md:rounded-[24px] shadow-float p-4 md:p-6 ring-1 ring-white/50 dark:ring-white/5">
            <div class="flex items-center justify-between mb-3 md:mb-4">
                <h3 class="text-base md:text-lg font-bold text-slate-900 dark:text-white">Contactos Recientes</h3>
                <a href="{{ route('contacts.index') }}" class="text-xs md:text-sm font-medium text-orange-600 hover:text-orange-700">Ver Todos</a>
            </div>
            <div class="space-y-2 md:space-y-3">
                @forelse($recentContacts as $contact)
                <div class="flex items-center gap-2 md:gap-3 p-1.5 md:p-2 rounded-lg md:rounded-xl hover:bg-white/50 dark:hover:bg-white/5 transition-colors">
                    @if($contact->photo_path)
                        <img src="{{ asset('storage/' . $contact->photo_path) }}" class="w-9 h-9 md:w-10 md:h-10 rounded-full object-cover">
                    @else
                        <div class="w-9 h-9 md:w-10 md:h-10 rounded-full bg-orange-100 text-orange-600 flex items-center justify-center font-bold text-xs md:text-sm">
                            {{ substr($contact->name, 0, 2) }}
                        </div>
                    @endif
                    <div class="flex-1 min-w-0">
                        <p class="font-semibold text-slate-900 dark:text-white text-xs md:text-sm truncate">{{ $contact->name }}</p>
                        <p class="text-[10px] md:text-xs text-slate-500 truncate">{{ $contact->position ?? 'Sin cargo' }}</p>
                    </div>
                    @if($contact->email)
                    <a href="mailto:{{ $contact->email }}" class="p-1.5 md:p-2 rounded-lg md:rounded-xl hover:bg-orange-50 dark:hover:bg-orange-900/10 text-slate-400 hover:text-orange-600 transition-colors">
                        <span class="material-symbols-rounded text-[16px] md:text-[18px]">mail</span>
                    </a>
                    @endif
                </div>
                @empty
                    <p class="text-sm text-slate-500 text-center py-4">No hay contactos recientes.</p>
                @endforelse
            </div>
        </div>
    </div>

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const monthlyData = @json($monthlyData);
        const statusData = @json($statusData);

        // Bar Chart
        const barCtx = document.getElementById('barChart').getContext('2d');
        new Chart(barCtx, {
            type: 'bar',
            data: {
                labels: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
                datasets: [{
                    label: 'Eventos',
                    data: monthlyData,
                    backgroundColor: 'rgba(234, 88, 12, 0.8)',
                    borderRadius: 6,
                    barThickness: window.innerWidth < 768 ? 12 : 20
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: {
                    y: { beginAtZero: true, grid: { color: 'rgba(148, 163, 184, 0.2)' }, ticks: { color: '#64748b', font: { size: window.innerWidth < 768 ? 10 : 12 } } },
                    x: { grid: { display: false }, ticks: { color: '#64748b', font: { size: window.innerWidth < 768 ? 10 : 12 } } }
                }
            }
        });

        // Pie Chart
        const pieCtx = document.getElementById('pieChart').getContext('2d');
        new Chart(pieCtx, {
            type: 'doughnut',
            data: {
                labels: ['Confirmados', 'Planificados', 'Cancelados'],
                datasets: [{
                    data: statusData,
                    backgroundColor: ['rgb(16, 185, 129)', 'rgb(245, 158, 11)', 'rgb(239, 68, 68)'],
                    borderWidth: 0,
                    spacing: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '65%',
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: { padding: window.innerWidth < 768 ? 10 : 20, usePointStyle: true, pointStyle: 'circle', color: '#64748b', font: { size: window.innerWidth < 768 ? 10 : 12 } }
                    }
                }
            }
        });
    </script>
    @endpush
</x-layout>
