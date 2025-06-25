<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">➕ New Product</h2>
    </x-slot>

    <div class="p-6 max-w-3xl mx-auto bg-white shadow-md rounded-lg mt-6">
        <form method="POST" action="{{ route('products.store') }}" class="space-y-6">
            @csrf

            <div>
                <x-input-label for="reference" value="reference" />
                <x-text-input id="reference" name="reference" class="mt-1 block w-full" required />
                @error('reference')
                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <x-input-label for="designation" value="designation" />
                <x-text-input id="designation" name="designation" class="mt-1 block w-full" />
                @error('designation')
                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <x-input-label for="marque" value="marque" />
                <x-text-input id="marque" name="marque" type="marque" class="mt-1 block w-full" />
                @error('marque')
                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <x-input-label for="prix_vente" value="prix de vente" />
                <x-text-input id="prix_vente" name="prix_vente" class="mt-1 block w-full" />
                @error('prix_vente')
                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end">
                <x-primary-button>Add Product</x-primary-button>
            </div>
        </form>
    </div>
</x-app-layout>
