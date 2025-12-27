<x-layout title="Ubicaciones - EventMaster" active-page="locations">
    <!-- Header -->
    <header class="h-auto shrink-0 mb-4 flex flex-wrap items-center justify-between gap-4 px-2">
        <div class="flex items-center gap-3 md:gap-4">
            <button onclick="toggleMobileSidebar()"
                class="md:hidden p-2 rounded-2xl glass text-slate-600 dark:text-slate-300">
                <span class="material-symbols-rounded">menu</span>
            </button>
            <h2 class="text-xl md:text-2xl font-bold text-slate-900 dark:text-white tracking-tight">Ubicaciones</h2>
        </div>
        <!-- Add Button (Mobile/Tablet) -->
        <button onclick="openFormModal()"
            class="xl:hidden flex items-center gap-1.5 bg-orange-600 hover:bg-orange-700 text-white h-9 px-3 rounded-xl font-semibold text-sm shadow-lg shadow-orange-500/20 transition-colors">
            <span class="material-symbols-rounded text-lg">add</span>
            <span class="hidden sm:inline">Añadir</span>
        </button>
    </header>

    <!-- Content Grid -->
    <div class="flex-1 grid grid-cols-1 xl:grid-cols-12 gap-4 overflow-hidden">
        <!-- Form (Hidden on mobile) -->
        <div class="hidden xl:block xl:col-span-4 glass rounded-[32px] shadow-float p-6 overflow-auto custom-scroll ring-1 ring-white/50 dark:ring-white/5">
            <div class="flex items-center gap-2 pb-4 border-b border-slate-300 dark:border-slate-700 mb-6">
                <span class="material-symbols-rounded text-orange-600">location_on</span>
                <h3 class="text-lg font-bold text-slate-900 dark:text-white">Nueva Ubicación</h3>
            </div>
            <form action="{{ route('locations.store') }}" method="POST" class="flex flex-col gap-5">
                @csrf
                <div>
                    <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">Nombre</label>
                    <input name="name" required
                        class="w-full rounded-2xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-dark-surface text-slate-900 dark:text-white h-12 px-4 placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-orange-500/50 focus:border-orange-500 transition-all shadow-sm"
                        placeholder="ej. Centro de Convenciones" />
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">Dirección</label>
                    <input name="address" required
                        class="w-full rounded-2xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-dark-surface text-slate-900 dark:text-white h-12 px-4 placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-orange-500/50 focus:border-orange-500 transition-all shadow-sm"
                        placeholder="Av. Principal 123" />
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">Latitud</label>
                        <input type="number" step="any" name="latitude"
                            class="w-full rounded-2xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-dark-surface text-slate-900 dark:text-white h-12 px-4 placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-orange-500/50 focus:border-orange-500 transition-all shadow-sm"
                            placeholder="-0.2295" />
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">Longitud</label>
                        <input type="number" step="any" name="longitude"
                            class="w-full rounded-2xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-dark-surface text-slate-900 dark:text-white h-12 px-4 placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-orange-500/50 focus:border-orange-500 transition-all shadow-sm"
                            placeholder="-78.5243" />
                    </div>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">Capacidad</label>
                    <input type="number" name="capacity"
                        class="w-full rounded-2xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-dark-surface text-slate-900 dark:text-white h-12 px-4 placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-orange-500/50 focus:border-orange-500 transition-all shadow-sm"
                        placeholder="ej. 500" />
                </div>
                <div class="flex gap-3 pt-2">
                    <button type="reset"
                        class="flex-1 bg-white dark:bg-slate-800 border border-slate-300 text-slate-700 h-12 rounded-2xl font-bold text-sm hover:bg-slate-50 transition-colors">
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

        <!-- Table -->
        <div class="col-span-1 xl:col-span-8 glass rounded-[24px] md:rounded-[32px] shadow-float flex flex-col overflow-hidden ring-1 ring-white/50 dark:ring-white/5">
            <div class="flex flex-col border-b border-slate-300 dark:border-slate-700 shrink-0">
                @if(session('success'))
                    <div class="bg-emerald-100 dark:bg-emerald-900/30 text-emerald-600 px-4 py-2 text-sm font-medium">
                        {{ session('success') }}
                    </div>
                @endif
                <div class="flex flex-wrap items-center justify-between gap-3 p-3 md:p-4">
                    <h3 class="text-slate-900 dark:text-white text-base md:text-lg font-bold">
                        Ubicaciones <span class="text-slate-400 font-medium text-sm ml-1">({{ $locations->total() }})</span>
                    </h3>
                    <div class="flex flex-1 max-w-md gap-2">
                        <div class="relative flex-1">
                            <input
                                class="w-full rounded-xl md:rounded-2xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-dark-surface text-slate-900 dark:text-white h-9 md:h-10 pl-9 md:pl-10 pr-4 text-sm placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-orange-500/50 focus:border-orange-500 transition-all shadow-sm"
                                placeholder="Buscar..." />
                            <span class="material-symbols-rounded absolute left-2.5 md:left-3 top-1/2 -translate-y-1/2 text-slate-400 text-base md:text-lg">search</span>
                        </div>
                        <button
                            class="bg-white dark:bg-slate-800 border border-slate-300 dark:border-slate-700 text-slate-600 h-9 md:h-10 px-3 rounded-xl md:rounded-2xl flex items-center gap-1 hover:bg-slate-50 transition-colors text-sm font-medium shadow-sm">
                            <span class="material-symbols-rounded text-base md:text-lg">filter_list</span>
                            <span class="hidden sm:inline">Filtrar</span>
                        </button>
                    </div>
                </div>
            </div>
            
            <div class="flex-1 overflow-auto custom-scroll">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-white/50 dark:bg-slate-900/50 backdrop-blur-md sticky top-0 z-10 border-b border-slate-300 dark:border-slate-700">
                        <tr>
                            <th class="py-3 md:py-4 px-4 md:px-6 text-xs font-bold uppercase tracking-widest text-slate-500">Ubicación</th>
                            <th class="py-3 md:py-4 px-4 md:px-6 text-xs font-bold uppercase tracking-widest text-slate-500 hidden md:table-cell">Dirección</th>
                            <th class="py-3 md:py-4 px-4 md:px-6 text-xs font-bold uppercase tracking-widest text-slate-500 hidden lg:table-cell">Capacidad</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200 dark:divide-slate-700">
                        @forelse($locations as $location)
                        <tr class="group hover:bg-orange-50/50 transition-colors">
                            <td class="py-3 md:py-4 px-4 md:px-6">
                                <div class="flex items-center gap-2 md:gap-3">
                                    <div class="w-8 h-8 md:w-10 md:h-10 rounded-full bg-orange-100 text-orange-600 flex items-center justify-center">
                                        <span class="material-symbols-rounded text-base md:text-lg">apartment</span>
                                    </div>
                                    <div>
                                        <span class="text-xs md:text-sm font-semibold text-slate-900 dark:text-white block">{{ $location->name }}</span>
                                        <span class="text-[10px] md:text-xs text-slate-500 md:hidden">{{ $location->address }}</span>
                                    </div>
                                </div>
                            </td>
                            <td class="py-3 md:py-4 px-4 md:px-6 hidden md:table-cell text-sm text-slate-600">{{ $location->address }}</td>
                            <td class="py-3 md:py-4 px-4 md:px-6 hidden lg:table-cell text-sm text-slate-600">{{ $location->capacity ?? 'N/A' }} personas</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="p-6 text-center text-slate-500">No hay ubicaciones registradas.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="px-4 py-3 border-t border-slate-300 dark:border-slate-700 bg-white/50 dark:bg-slate-900/50">
                {{ $locations->links() }}
            </div>
        </div>
    </div>

    <!-- Mobile Form Modal -->
    <div id="form-modal-backdrop"
        class="fixed inset-0 bg-black/50 backdrop-blur-sm z-40 hidden opacity-0 transition-opacity duration-300 xl:hidden"
        onclick="closeFormModal()"></div>
    <div id="form-modal"
        class="fixed inset-x-4 bottom-4 top-20 bg-white dark:bg-slate-900 rounded-[32px] shadow-float-lg z-50 hidden translate-y-full opacity-0 transition-all duration-300 flex flex-col xl:hidden overflow-hidden ring-1 ring-slate-200 dark:ring-slate-700">
        <div class="flex items-center justify-between p-4 border-b border-slate-200 dark:border-slate-700 shrink-0">
            <div class="flex items-center gap-2">
                <span class="material-symbols-rounded text-orange-600">location_on</span>
                <h3 class="text-lg font-bold text-slate-900 dark:text-white">Nueva Ubicación</h3>
            </div>
            <button onclick="closeFormModal()" class="p-2 rounded-xl hover:bg-slate-100 text-slate-500 transition-colors">
                <span class="material-symbols-rounded">close</span>
            </button>
        </div>
        <div class="flex-1 overflow-auto p-4 custom-scroll">
            <form action="{{ route('locations.store') }}" method="POST" class="flex flex-col gap-4">
                @csrf
                <div>
                    <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">Nombre</label>
                    <input name="name" required
                        class="w-full rounded-2xl border border-slate-300 bg-white text-slate-900 h-11 px-4 text-sm" placeholder="ej. Centro de Convenciones" />
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">Dirección</label>
                    <input name="address" required
                        class="w-full rounded-2xl border border-slate-300 bg-white text-slate-900 h-11 px-4 text-sm" placeholder="Av. Principal 123" />
                </div>
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">Latitud</label>
                        <input type="number" step="any" name="latitude"
                            class="w-full rounded-2xl border border-slate-300 bg-white text-slate-900 h-11 px-3 text-sm" placeholder="-0.2295" />
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">Longitud</label>
                        <input type="number" step="any" name="longitude"
                            class="w-full rounded-2xl border border-slate-300 bg-white text-slate-900 h-11 px-3 text-sm" placeholder="-78.5243" />
                    </div>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">Capacidad</label>
                    <input type="number" name="capacity"
                        class="w-full rounded-2xl border border-slate-300 bg-white text-slate-900 h-11 px-4 text-sm" placeholder="ej. 500" />
                </div>
                <div class="flex gap-3 pt-2">
                    <button type="button" onclick="closeFormModal()"
                        class="flex-1 bg-white border border-slate-300 text-slate-700 h-11 rounded-2xl font-bold text-sm">Cancelar</button>
                    <button type="submit"
                        class="flex-1 bg-orange-600 text-white h-11 rounded-2xl font-bold text-sm shadow-lg shadow-orange-500/20">Guardar</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Scripts for modal -->
    <script>
        function openFormModal() {
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
</x-layout>
