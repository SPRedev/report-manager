<aside class="w-64 bg-white shadow-md h-full">
    <div class="p-6 font-bold text-purple-700 text-2xl">🛠️ AdminPanel</div>

    <nav class="mt-8 flex flex-col space-y-1 px-4">
        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">📊 Dashboard</x-nav-link>

        @if(auth()->user()?->role === 'admin')
            <x-nav-link :href="route('users.index')" :active="request()->routeIs('users.*')">👤 Users</x-nav-link>
        @endif

        {{-- Importations Parent + Child --}}
        <div x-data="{ open: {{ request()->routeIs('importations.*') || request()->routeIs('predoms.*') ? 'true' : 'false' }} }">
            <button @click="open = !open"
                class="flex items-center justify-between w-full text-left px-3 py-2 text-gray-700 hover:bg-purple-100 rounded-lg transition">
                <span>📦 Importations</span>
                <svg :class="{ 'rotate-90': open }" class="w-4 h-4 transform transition-transform" fill="none" stroke="currentColor"
                    stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                </svg>
            </button>

            <div x-show="open" x-transition class="ml-6 mt-1 space-y-1">
                <x-nav-link :href="route('importations.index')" :active="request()->routeIs('importations.*')">📁 All Importations</x-nav-link>
                <x-nav-link :href="route('predoms.index')" :active="request()->routeIs('predoms.*')">📄 Predoms</x-nav-link>
            </div>
        </div>

        <x-nav-link :href="route('clients.index')" :active="request()->routeIs('clients.*')">🧑‍💼 Clients</x-nav-link>
        <x-nav-link :href="route('fourniseurs.index')" :active="request()->routeIs('fourniseurs.*')">🏭 Fournisseurs</x-nav-link>
        <x-nav-link :href="route('orderimportations.index')" :active="request()->routeIs('orderimportations.*')">🧾 Order Importations</x-nav-link>
        <x-nav-link :href="route('orders.index')" :active="request()->routeIs('orders.*')">📬 Orders</x-nav-link>
        <x-nav-link :href="route('products.index')" :active="request()->routeIs('products.*')">🛒 Products</x-nav-link>
        <x-nav-link :href="route('order_lines.index')" :active="request()->routeIs('order_lines.*')">📦 Order Lines</x-nav-link>
    </nav>
</aside>
