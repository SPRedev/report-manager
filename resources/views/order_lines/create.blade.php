<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">➕ New Order Line</h2>
    </x-slot>

    <div class="p-6 max-w-3xl mx-auto bg-white shadow-md rounded-lg mt-6">
        <form method="POST" action="{{ route('order_lines.store') }}" class="space-y-6">
            @csrf


            {{-- --}}
            <div>
                <x-input-label for="client_name" value="client name" />
                <select name="order_id" class="mt-1 block w-full">
                    @foreach($orders as $order)
                    <option value="{{ $order->id }}" {{ old('order_id')==$order->id ? 'selected' : '' }}>
                        Order #{{ $order->id }} ({{ $order->client->client_name ?? '' }})
                    </option>
                    @endforeach
                </select>
            </div>

            <div>
                 <x-input-label for="product_id" value="product" />
                <select name="product_id" class="w-full border rounded">
                    @foreach($products as $product)
                    <option value="{{ $product->id }}" {{ old('product_id')==$product->id ? 'selected' : '' }}>
                        {{ $product->designation }} ({{ $product->reference }})
                    </option>
                    @endforeach
                </select>
            </div>

            <div>
                 <x-input-label for="quantity" value="quantity" />
                <input type="number" name="quantity" class="w-full border rounded" value="{{ old('quantity') }}">
            </div>
            <div class="flex justify-end">
                <x-primary-button>Add product</x-primary-button>
            </div>
        </form>
    </div>
</x-app-layout>