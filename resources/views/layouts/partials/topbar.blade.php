<header class="bg-white shadow-md p-4 flex justify-between items-center">
    <h1 class="text-xl font-bold text-purple-700">{{ $pageTitle ?? 'Dashboard' }}</h1>

    <div class="flex items-center gap-4">
<input type="text"
       id="global-search"
       placeholder="Search..."
       class="px-4 py-2 border rounded-lg">
<!-- 🔔 Notification Bell -->
<div x-data="{ show: false, items: [] }"
     x-init="
        const loadNotifications = () => {
            fetch('/notifications')
                .then(res => res.json())
                .then(data => items = data);
        };
        loadNotifications();
        setInterval(loadNotifications, 60000); // every 60 sec
     "
     class="relative">

    <button @click="show = !show" class="relative text-gray-600 hover:text-purple-600">
        🔔
        <span x-show="items.length > 0" x-cloak
              class="absolute top-0 right-0 block w-3 h-3 bg-red-500 rounded-full ring-2 ring-white"></span>
    </button>

    <div x-show="show" @click.away="show = false" x-cloak
         class="absolute right-0 mt-2 w-80 bg-white border shadow-lg rounded-lg z-50 p-2 text-sm max-h-96 overflow-y-auto">

        <template x-if="items.length === 0">
            <div class="text-gray-500 text-center py-2">No new notifications</div>
        </template>

        <template x-for="(item, index) in items" :key="index">
            <a :href="item.link"
               class="block px-3 py-2 border-b hover:bg-purple-50 transition">
                <strong x-text="item.title"></strong>
                <div class="text-xs text-gray-500" x-text="item.message"></div>
            </a>
        </template>
    </div>
</div>


        <!-- User Dropdown -->
        <x-dropdown align="right" width="48">
            <x-slot name="trigger">
                <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                    <div>{{ Auth::user()->name }}</div>
                    <div class="ms-1">
                        <svg class="fill-current h-4 w-4" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </div>
                </button>
            </x-slot>

            <x-slot name="content">
                <x-dropdown-link :href="route('profile.edit')">Profile</x-dropdown-link>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                        Log Out
                    </x-dropdown-link>
                </form>
            </x-slot>
        </x-dropdown>
    </div>
</header>
