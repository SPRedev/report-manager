<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">➕ New Client</h2>
    </x-slot>

    <div class="p-6 max-w-3xl mx-auto bg-white shadow-md rounded-lg mt-6">
        <form method="POST" action="{{ route('clients.store') }}" class="space-y-6">
            @csrf

            <div>
                <x-input-label for="client_name" value="Name" />
                <x-text-input id="client_name" name="client_name" class="mt-1 block w-full" required />
                @error('client_name')
                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <x-input-label for="phone" value="Phone" />
                <x-text-input id="phone" name="phone" class="mt-1 block w-full" />
                @error('phone')
                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <x-input-label for="email" value="Email" />
                <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" />
                @error('email')
                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <x-input-label for="region" value="Region" />
                <x-text-input id="region" name="region" class="mt-1 block w-full" />
                @error('region')
                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <x-input-label for="address" value="Address" />
                <textarea id="address" name="address" rows="3"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-purple-500 focus:ring focus:ring-purple-200 focus:ring-opacity-50"></textarea>
                @error('address')
                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end">
                <x-primary-button>Add Client</x-primary-button>
            </div>
        </form>
    </div>
</x-app-layout>
