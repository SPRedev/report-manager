<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800">products</h2>
            <a href="{{ route('products.create') }}"
                class="bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded-lg text-sm shadow">
                + Add product
            </a>
        </div>
    </x-slot>
    @if(session('success'))
    <p class="text-green-600 mt-2">{{ session('success') }}</p>
    @endif

    <div class="mt-6 bg-white shadow rounded-lg overflow-hidden">
        <table class="w-full text-sm text-left text-gray-700">
            <thead class="bg-gray-50 border-b text-gray-600 uppercase text-xs">
                <tr>
                    <th class="px-6 py-3">Reference</th>
                    <th class="px-6 py-3">Designation</th>
                    <th class="px-6 py-3">Marque</th>
                    <th class="px-6 py-3">Prix</th>
                    <th class="px-6 py-3">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                <tr class="border-t">
                    <td class="px-6 py-4">{{ $product->reference }}</td>
                    <td class="px-6 py-4">{{ $product->designation }}</td>
                    <td class="px-6 py-4">{{ $product->marque }}</td>
                    <td class="px-6 py-4">{{ $product->prix_vente }} DA</td>
                    <td class="px-6 py-4 space-x-2">
                        <a href="{{ route('products.edit', $product) }}" class="text-yellow-600 hover:text-yellow-800 font-medium">Edit</a>
                            <form action="{{ route('products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this product?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800 font-medium">Delete</button>
                            </form>

                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
</x-app-layout>