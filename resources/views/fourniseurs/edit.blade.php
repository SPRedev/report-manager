<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">✏️ Edit fourniseurs</h2>
    </x-slot>

    <div class="p-6 max-w-3xl mx-auto bg-white shadow-md rounded-lg mt-6">
        <form method="POST" action="{{ route('fourniseurs.update', $fourniseur) }}" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <x-input-label for="fourniseur_name" value="Name" />
                <x-text-input id="fourniseur_name" name="fourniseur_name" class="mt-1 block w-full"
                    value="{{ old('fourniseur_name', $fourniseur->fourniseur_name) }}" required />
                @error('fourniseur_name')
                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <x-input-label for="phone" value="Phone" />
                <x-text-input id="phone" name="phone" class="mt-1 block w-full"
                    value="{{ old('phone', $fourniseur->phone) }}" />
                @error('phone')
                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <x-input-label for="email" value="Email" />
                <x-text-input id="email" name="email" type="email" class="mt-1 block w-full"
                    value="{{ old('email', $fourniseur->email) }}" />
                @error('email')
                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <x-input-label for="region" value="Region" />
                <x-text-input id="region" name="region" class="mt-1 block w-full"
                    value="{{ old('region', $fourniseur->region) }}" />
                @error('region')
                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <x-input-label for="address" value="Address" />
                <textarea id="address" name="address" rows="3"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-purple-500 focus:ring focus:ring-purple-200 focus:ring-opacity-50">{{ old('address', $fourniseur->address) }}</textarea>
                @error('address')
                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end">
                <x-primary-button>Update fourniseurs</x-primary-button>
            </div>
        </form>
    </div>
</x-app-layout>
