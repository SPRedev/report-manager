<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800">➕ New Order</h2>
        </div>
    </x-slot>

       <div class="p-6 max-w-3xl mx-auto bg-white shadow-md rounded-lg mt-6">
        <form method="POST" action="{{ route('orders.store') }}" class="space-y-6">
                @csrf

                {{-- Client --}}
                <div>
                    <label for="client_id" class="block text-sm font-medium text-gray-700 mb-1">Client</label>
                    <select name="client_id" id="client_id"
                        class="w-full border-gray-300 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500">
                        @foreach($clients as $c)
                            <option value="{{ $c->id }}">{{ $c->client_name }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Commercial --}}
                <div>
                    <label for="commercial_id" class="block text-sm font-medium text-gray-700 mb-1">Commercial (optional)</label>
                    <select name="commercial_id" id="commercial_id"
                        class="w-full border-gray-300 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500">
                        <option value="">— none —</option>
                        @foreach($commercials as $u)
                            <option value="{{ $u->id }}">{{ $u->name }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Order Date --}}
                <div>
                    <label for="order_date" class="block text-sm font-medium text-gray-700 mb-1">Order Date</label>
                    <input type="date" name="order_date" id="order_date"
                        class="w-full border-gray-300 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500"
                        value="{{ now()->toDateString() }}">
                </div>

                {{-- Status --}}
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                    <select name="status" id="status"
                        class="w-full border-gray-300 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500">
                        <option value="in_preparation">In Preparation</option>
                        <option value="ready">Ready</option>
                        <option value="delivered">Delivered</option>
                    </select>
                </div>

                {{-- Button --}}
                <div>
                    <button type="submit"
                        class="bg-purple-600 hover:bg-purple-700 text-white px-6 py-2 rounded-lg shadow text-sm">
                        💾 Save Order
                    </button>
                </div>
            </form>
        </div>
    </main>
</x-app-layout>
