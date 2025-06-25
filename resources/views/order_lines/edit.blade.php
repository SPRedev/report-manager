<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">✏️ Edit order line</h2>
    </x-slot>

    <div class="p-6 max-w-3xl mx-auto bg-white shadow-md rounded-lg mt-6">
        <form method="POST" action="{{ route('order_lines.update', $orderLine) }}" class="space-y-6">
            @csrf
            @method('PUT')

        <div>
            <x-input-label for="order_id" value="order line" />
            <select name="order_id" class="w-full border rounded">
                @foreach($orders as $order)
                    <option value="{{ $order->id }}" {{ $order->id == $orderLine->order_id ? 'selected' : '' }}>
                        Order #{{ $order->id }} ({{ $order->client->client_name ?? '' }})
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label>Product</label>
            <select name="product_id" class="w-full border rounded">
                @foreach($products as $product)
                    <option value="{{ $product->id }}" {{ $product->id == $orderLine->product_id ? 'selected' : '' }}>
                        {{ $product->designation }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label>Quantity</label>
            <input type="number" name="quantity" min="1" value="{{ $orderLine->quantity }}" class="w-full border rounded">
        </div>

            <div class="flex justify-end">
                <x-primary-button>Update Client</x-primary-button>
            </div>
        </form>
    </div>
</x-app-layout>

