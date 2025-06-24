<aside class="w-64 bg-white shadow-md h-full">
    <div class="p-6 font-bold text-purple-700 text-2xl">AdminPanel</div>

    <nav class="mt-8 flex flex-col space-y-1 px-4">
        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">Dashboard</x-nav-link>

        @if(auth()->user()?->role === 'admin')
            <x-nav-link :href="route('users.index')" :active="request()->routeIs('users.*')">Users</x-nav-link>
        @endif
        
        <x-nav-link :href="route('importations.index')" :active="request()->routeIs('importations.*')">Importations</x-nav-link>
        <x-nav-link :href="route('clients.index')" :active="request()->routeIs('clients.*')">Clients</x-nav-link>
        <x-nav-link :href="route('fourniseurs.index')" :active="request()->routeIs('fourniseurs.*')">Fournisseurs</x-nav-link>
        <x-nav-link :href="route('orders.index')" :active="request()->routeIs('orders.*')">Orders</x-nav-link>
        <x-nav-link :href="route('products.index')" :active="request()->routeIs('products.*')">Products</x-nav-link>
        <x-nav-link :href="route('order_lines.index')" :active="request()->routeIs('order_lines.*')">Order Lines</x-nav-link>
    </nav>
</aside>
