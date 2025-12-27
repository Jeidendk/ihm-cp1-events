<x-layout title="Eventos - EventMaster" active-page="events">
    <!-- Header -->
    <header class="h-auto shrink-0 mb-4 flex flex-wrap items-center justify-between gap-3 px-2">
        <div class="flex items-center gap-3">
            <!-- Mobile Menu Button -->
            <button onclick="toggleMobileSidebar()"
                class="md:hidden p-2 rounded-2xl glass text-slate-600 dark:text-slate-300 hover:bg-white/50 transition-colors">
                <span class="material-symbols-rounded">menu</span>
            </button>
            <h2 class="text-xl md:text-2xl font-bold text-slate-900 dark:text-white tracking-tight">Eventos</h2>
        </div>

        <div class="flex items-center gap-2 md:gap-3">
            <!-- Add Button (Mobile/Tablet only - shows in header) -->
            <button onclick="openFormModal()"
                class="xl:hidden flex items-center gap-1.5 bg-orange-600 hover:bg-orange-700 text-white h-9 md:h-10 px-3 md:px-4 rounded-xl md:rounded-2xl font-semibold text-sm shadow-lg shadow-orange-500/20 transition-colors">
                <span class="material-symbols-rounded text-lg">add</span>
                <span class="hidden sm:inline">Añadir</span>
            </button>

            <!-- View Switcher -->
            <div
                class="flex items-center p-1 bg-white dark:bg-slate-800 rounded-xl md:rounded-2xl shadow-sm ring-1 ring-slate-200 dark:ring-slate-700">
                <button
                    class="p-2 rounded-lg md:rounded-xl bg-orange-600/10 text-orange-600 shadow-sm transition-all">
                    <span class="material-symbols-rounded text-[20px]">view_list</span>
                </button>
            </div>
        </div>
    </header>

    <!-- Content Grid -->
    <div class="flex-1 grid grid-cols-1 xl:grid-cols-12 gap-4 overflow-hidden">

        <!-- Left: Form (Hidden on mobile/tablet) -->
        <div class="hidden xl:block xl:col-span-4 glass rounded-[32px] shadow-float p-6 overflow-auto custom-scroll ring-1 ring-white/50 dark:ring-white/5">
            <div class="flex items-center gap-2 pb-4 border-b border-slate-300 dark:border-slate-700 mb-6">
                <span class="material-symbols-rounded text-orange-600">event</span>
                <h3 class="text-lg font-bold text-slate-900 dark:text-white">Nuevo Evento</h3>
            </div>

            <form action="{{ route('events.store') }}" method="POST" class="flex flex-col gap-5">
                @csrf
                <div>
                    <label class="block text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-2">Nombre del Evento</label>
                    <input name="title" required
                        class="w-full rounded-2xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-dark-surface text-slate-900 dark:text-white h-12 px-4 placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-orange-500/50 focus:border-orange-500 transition-all shadow-sm"
                        placeholder="ej. Conferencia Tech 2024" />
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-2">Fecha</label>
                        <input type="date" name="date" required
                            class="w-full rounded-2xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-dark-surface text-slate-900 dark:text-white h-12 px-4 focus:outline-none focus:ring-2 focus:ring-orange-500/50 focus:border-orange-500 transition-all shadow-sm" />
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-2">Hora</label>
                        <input type="time" name="time" required
                            class="w-full rounded-2xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-dark-surface text-slate-900 dark:text-white h-12 px-4 focus:outline-none focus:ring-2 focus:ring-orange-500/50 focus:border-orange-500 transition-all shadow-sm" />
                    </div>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-2">Ubicación</label>
                    <select name="location_id"
                        class="w-full rounded-2xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-dark-surface text-slate-900 dark:text-white h-12 px-4 focus:outline-none focus:ring-2 focus:ring-orange-500/50 focus:border-orange-500 transition-all shadow-sm appearance-none">
                        <option value="">{{ $locations->count() > 0 ? 'Seleccionar...' : 'Sin ubicaciones disponibles (Opcional)' }}</option>
                        @foreach($locations as $location)
                            <option value="{{ $location->id }}">{{ $location->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-2">Contacto</label>
                    <select name="contact_id"
                        class="w-full rounded-2xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-dark-surface text-slate-900 dark:text-white h-12 px-4 focus:outline-none focus:ring-2 focus:ring-orange-500/50 focus:border-orange-500 transition-all shadow-sm appearance-none">
                        <option value="">{{ $contacts->count() > 0 ? 'Seleccionar...' : 'Sin contactos disponibles (Opcional)' }}</option>
                        @foreach($contacts as $contact)
                            <option value="{{ $contact->id }}">{{ $contact->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-2">Estado</label>
                    <div class="flex flex-wrap gap-2">
                        <label class="flex items-center gap-2 px-3 py-2 rounded-xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-dark-surface cursor-pointer hover:border-orange-500 transition-colors has-[:checked]:border-orange-500 has-[:checked]:bg-orange-50 dark:has-[:checked]:bg-orange-900/20 text-sm">
                            <input type="radio" name="status" value="planificado" class="w-4 h-4 text-orange-600" checked />
                            <span class="font-medium text-slate-700 dark:text-slate-300">Planificado</span>
                        </label>
                        <label class="flex items-center gap-2 px-3 py-2 rounded-xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-dark-surface cursor-pointer hover:border-orange-500 transition-colors has-[:checked]:border-orange-500 has-[:checked]:bg-orange-50 dark:has-[:checked]:bg-orange-900/20 text-sm">
                            <input type="radio" name="status" value="confirmado" class="w-4 h-4 text-orange-600" />
                            <span class="font-medium text-slate-700 dark:text-slate-300">Confirmado</span>
                        </label>
                    </div>
                </div>
                <div class="flex gap-3 pt-2">
                    <button type="reset"
                        class="flex-1 bg-white dark:bg-slate-800 border border-slate-300 dark:border-slate-600 text-slate-700 dark:text-slate-300 h-12 rounded-2xl font-bold text-sm hover:bg-slate-50 dark:hover:bg-slate-700 transition-colors">
                        Limpiar
                    </button>
                    <button type="submit"
                        class="flex-1 bg-orange-600 text-white h-12 rounded-2xl font-bold text-sm shadow-lg shadow-orange-500/20 hover:bg-orange-700 transition-colors flex items-center justify-center gap-2">
                        <span class="material-symbols-rounded text-lg">save</span>
                        Guardar
                    </button>
                </div>
            </form>
        </div>

        <!-- Right: Events List -->
        <div class="col-span-1 xl:col-span-8 glass rounded-[24px] md:rounded-[32px] shadow-float flex flex-col overflow-hidden ring-1 ring-white/50 dark:ring-white/5">
            <!-- Filters & Messages -->
            <div class="flex flex-col border-b border-slate-300 dark:border-slate-700 shrink-0">
                @if(session('success'))
                    <div class="bg-emerald-100 dark:bg-emerald-900/30 text-emerald-600 px-4 py-2 text-sm font-medium">
                        {{ session('success') }}
                    </div>
                @endif
                <div class="flex flex-wrap items-center justify-between gap-3 p-3 md:p-4">
                    <h3 class="text-slate-900 dark:text-white text-sm md:text-lg font-bold">
                        Eventos
                        <span class="text-slate-400 font-medium text-xs md:text-base ml-1">({{ $events->total() }})</span>
                    </h3>
                    <div class="flex flex-1 max-w-md gap-2">
                        <div class="relative flex-1">
                            <input
                                class="w-full rounded-xl md:rounded-2xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-dark-surface text-slate-900 dark:text-white h-9 md:h-10 pl-9 md:pl-10 pr-4 text-sm placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-orange-500/50 focus:border-orange-500 transition-all shadow-sm"
                                placeholder="Buscar..." />
                            <span class="material-symbols-rounded absolute left-2.5 md:left-3 top-1/2 -translate-y-1/2 text-slate-400 text-base md:text-lg">search</span>
                        </div>
                        <button
                            class="bg-white dark:bg-slate-800 border border-slate-300 dark:border-slate-700 text-slate-600 dark:text-slate-300 h-9 md:h-10 px-3 md:px-4 rounded-xl md:rounded-2xl flex items-center gap-1 md:gap-2 hover:bg-slate-50 dark:hover:bg-slate-700 transition-colors text-sm font-medium shadow-sm">
                            <span class="material-symbols-rounded text-base md:text-lg">filter_list</span>
                            <span class="hidden sm:inline">Filtrar</span>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Table -->
            <div class="flex-1 overflow-auto custom-scroll">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-white/50 dark:bg-slate-900/50 backdrop-blur-md sticky top-0 z-10 border-b border-slate-300 dark:border-slate-700">
                        <tr>
                            <th class="py-3 md:py-4 px-4 md:px-6 text-xs font-bold uppercase tracking-widest text-slate-500 dark:text-slate-400">Evento</th>
                            <th class="py-3 md:py-4 px-4 md:px-6 text-xs font-bold uppercase tracking-widest text-slate-500 dark:text-slate-400 hidden sm:table-cell">Fecha</th>
                            <th class="py-3 md:py-4 px-4 md:px-6 text-xs font-bold uppercase tracking-widest text-slate-500 dark:text-slate-400 hidden lg:table-cell">Ubicación</th>
                            <th class="py-3 md:py-4 px-4 md:px-6 text-xs font-bold uppercase tracking-widest text-slate-500 dark:text-slate-400">Estado</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200 dark:divide-slate-700">
                        @forelse($events as $event)
                        <tr class="group hover:bg-orange-50/50 dark:hover:bg-orange-900/10 transition-colors">
                            <td class="py-3 md:py-4 px-4 md:px-6">
                                <div class="flex items-center gap-2 md:gap-3">
                                    <div class="w-8 h-8 md:w-10 md:h-10 rounded-full bg-orange-100 dark:bg-orange-900/30 text-orange-600 flex items-center justify-center">
                                        <span class="material-symbols-rounded text-base md:text-lg">celebration</span>
                                    </div>
                                    <div>
                                        <span class="text-xs md:text-sm font-semibold text-slate-900 dark:text-white block">{{ $event->title }}</span>
                                        <span class="text-[10px] md:text-xs text-slate-500 sm:hidden">{{ $event->date->format('d M') }} • {{ $event->time }}</span>
                                    </div>
                                </div>
                            </td>
                            <td class="py-3 md:py-4 px-4 md:px-6 hidden sm:table-cell">
                                <div class="text-sm text-slate-600 dark:text-slate-300">
                                    <div class="font-medium">{{ $event->date->translatedFormat('d M Y') }}</div>
                                    <div class="text-slate-400 text-xs">{{ $event->time }}</div>
                                </div>
                            </td>
                            <td class="py-3 md:py-4 px-4 md:px-6 hidden lg:table-cell text-sm text-slate-600 dark:text-slate-300">
                                {{ $event->location->name ?? 'Sin ubicación' }}
                            </td>
                            <td class="py-3 md:py-4 px-4 md:px-6">
                                <span class="inline-flex items-center px-2 py-0.5 md:px-2.5 md:py-1 rounded-full text-[10px] md:text-xs font-bold 
                                    {{ $event->status === 'confirmado' ? 'bg-emerald-100 dark:bg-emerald-900/30 text-emerald-600' : 'bg-amber-100 dark:bg-amber-900/30 text-amber-600' }}">
                                    {{ ucfirst($event->status) }}
                                </span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="p-6 text-center text-slate-500">No hay eventos registrados.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="px-4 py-3 border-t border-slate-300 dark:border-slate-700 bg-white/50 dark:bg-slate-900/50 backdrop-blur-md">
                {{ $events->links() }}
            </div>
        </div>
    </div>

    <!-- Mobile Form Modal (Simplified) -->
    <script>
        function openFormModal() {
            // For now, toggle visibility or use a proper modal library implementation if needed.
            // Since we implemented the logic in separate files, we can just show/hide if we port that html structure.
            const modal = document.getElementById('form-modal');
            const backdrop = document.getElementById('form-modal-backdrop');
            if(modal && backdrop) {
                modal.classList.remove('hidden', 'translate-y-full', 'opacity-0');
                backdrop.classList.remove('hidden', 'opacity-0');
            }
        }
        function closeFormModal() {
            const modal = document.getElementById('form-modal');
            const backdrop = document.getElementById('form-modal-backdrop');
            if(modal && backdrop) {
                modal.classList.add('translate-y-full', 'opacity-0');
                backdrop.classList.add('opacity-0');
                setTimeout(() => {
                    modal.classList.add('hidden');
                    backdrop.classList.add('hidden');
                }, 300);
            }
        }
    </script>
    
    <!-- Mobile Modal Structure (Ported) -->
    <div id="form-modal" class="fixed inset-x-4 bottom-4 top-20 bg-white dark:bg-slate-900 rounded-[32px] shadow-float-lg z-50 hidden translate-y-full opacity-0 transition-all duration-300 flex flex-col xl:hidden overflow-hidden ring-1 ring-slate-200 dark:ring-slate-700">
        <div class="flex items-center justify-between p-4 border-b border-slate-200 dark:border-slate-700 shrink-0">
             <div class="flex items-center gap-2">
                <span class="material-symbols-rounded text-orange-600">event</span>
                <h3 class="text-lg font-bold text-slate-900 dark:text-white">Nuevo Evento</h3>
            </div>
            <button onclick="closeFormModal()" class="p-2 rounded-xl hover:bg-slate-100 dark:hover:bg-slate-800 text-slate-500 transition-colors">
                <span class="material-symbols-rounded">close</span>
            </button>
        </div>
        <div class="flex-1 overflow-auto p-4 custom-scroll">
            <form action="{{ route('events.store') }}" method="POST" class="flex flex-col gap-4">
                @csrf
                <!-- Fields duplicated for mobile... ideally use a shared component -->
                <div>
                    <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">Nombre</label>
                    <input name="title" required class="w-full rounded-2xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-dark-surface text-slate-900 dark:text-white h-11 px-4 text-sm" placeholder="ej. Conferencia Tech" />
                </div>
                 <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">Fecha</label>
                        <input type="date" name="date" required class="w-full rounded-2xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-dark-surface text-slate-900 dark:text-white h-11 px-3 text-sm" />
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">Hora</label>
                        <input type="time" name="time" required class="w-full rounded-2xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-dark-surface text-slate-900 dark:text-white h-11 px-3 text-sm" />
                    </div>
                </div>
                <div>
                     <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">Ubicación</label>
                     <select name="location_id" class="w-full rounded-2xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-dark-surface text-slate-900 dark:text-white h-11 px-4 text-sm appearance-none">
                        <option value="">Seleccionar...</option>
                        @foreach($locations as $location)
                            <option value="{{ $location->id }}">{{ $location->name }}</option>
                        @endforeach
                    </select>
                </div>
                 <!-- Contact... -->
                  <div>
                    <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">Estado</label>
                    <div class="flex gap-2">
                        <label class="flex-1 flex items-center justify-center gap-1.5 px-3 py-2 rounded-xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-dark-surface cursor-pointer has-[:checked]:border-orange-500 has-[:checked]:bg-orange-50 dark:has-[:checked]:bg-orange-900/20 text-xs">
                            <input type="radio" name="status" value="planificado" class="w-3 h-3 text-orange-600" checked />
                            <span class="font-medium text-slate-700 dark:text-slate-300">Planificado</span>
                        </label>
                        <label class="flex-1 flex items-center justify-center gap-1.5 px-3 py-2 rounded-xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-dark-surface cursor-pointer has-[:checked]:border-orange-500 has-[:checked]:bg-orange-50 dark:has-[:checked]:bg-orange-900/20 text-xs">
                            <input type="radio" name="status" value="confirmado" class="w-3 h-3 text-orange-600" />
                            <span class="font-medium text-slate-700 dark:text-slate-300">Confirmado</span>
                        </label>
                    </div>
                </div>

                <div class="flex gap-3 pt-2">
                    <button type="button" onclick="closeFormModal()" class="flex-1 bg-white dark:bg-slate-800 border border-slate-300 text-slate-700 h-11 rounded-2xl font-bold text-sm">Cancelar</button>
                    <button type="submit" class="flex-1 bg-orange-600 text-white h-11 rounded-2xl font-bold text-sm shadow-lg shadow-orange-500/20">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</x-layout>
