<div x-data="orderModals()">

    <x-app-layout>
        <x-slot name="header">
            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-800">Order Importations</h2>
                <button @click="createModal = true"
                    class="bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded-lg text-sm shadow">
                    + Add Order
                </button>

            </div>
        </x-slot>

        @if (session('success'))
        <p class="text-green-600 mt-2">{{ session('success') }}</p>
        @endif

        <div class="mt-6 bg-white shadow rounded-lg overflow-auto">
            <table class="w-full text-sm text-left text-gray-700 min-w-[1000px]">
                <thead class="bg-gray-50 border-b text-gray-600 uppercase text-xs">
                    <tr>
                        <th class="px-4 py-3">Order ID</th>
                        <th class="px-4 py-3">Fourniseur</th>
                        <th class="px-4 py-3">Date Offre</th>
                        <th class="px-4 py-3">Offre</th>
                        <th class="px-4 py-3">Date Contre Offre</th>
                        <th class="px-4 py-3">Contre Offre</th>
                        <th class="px-4 py-3">Date Confirmation</th>
                        <th class="px-4 py-3">Confirmation</th>
                        <th class="px-4 py-3">Status</th>
                        <th class="px-4 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($orderimportations as $order)
                    <tr class="border-t">
                        <td class="px-4 py-2">{{ $order->id_ord }}</td>
                        <td class="px-4 py-2">{{ $order->fourniseur->fourniseur_name ?? 'N/A' }}</td>
                        <td class="px-4 py-2">{{ \Carbon\Carbon::parse($order->date_offre)->format('Y-m-d') }}</td>
                        <td class="px-4 py-2">
                            @if($order->offre)
                            <a href="{{ asset('storage/' . $order->offre) }}" target="_blank"
                                class="text-blue-600 underline">📎 View</a>
                            @else
                            <span class="text-gray-400 italic">No file</span>
                            @endif
                        </td>

                        <td class="px-4 py-2">{{ \Carbon\Carbon::parse($order->date_contre_offre)->format('Y-m-d') }}
                        </td>
                        <td class="px-4 py-2">
                            @if($order->contre_offre)
                            <a href="{{ asset('storage/' . $order->contre_offre) }}" target="_blank"
                                class="text-blue-600 underline">📎 View</a>
                            @else
                            <span class="text-gray-400 italic">No file</span>
                            @endif
                        </td>
                        <td class="px-4 py-2">{{ \Carbon\Carbon::parse($order->date_confirmation)->format('Y-m-d') }}
                        </td>
                        <td class="px-4 py-2">
                            @if($order->confirmation)
                            <a href="{{ asset('storage/' . $order->confirmation) }}" target="_blank"
                                class="text-blue-600 underline">📎 View</a>
                            @else
                            <span class="text-gray-400 italic">No file</span>
                            @endif
                        </td>
                       <td class="px-4 py-2">
    @php
        $colors = [
            'pending' => 'bg-yellow-100 text-yellow-800',
            'confirmed' => 'bg-green-100 text-green-800',
            'cancelled' => 'bg-red-100 text-red-800',
        ];
    @endphp
    <span class="px-2 py-1 rounded text-xs font-medium {{ $colors[$order->status] ?? 'bg-gray-100 text-gray-700' }}">
        {{ ucfirst($order->status) }}
    </span>
</td>

                        <td class="px-4 py-2 space-x-2 whitespace-nowrap">
                            <button @click="openEditModal({{ $order->toJson() }})"
                                class="px-3 py-1.5 bg-yellow-100 text-yellow-800 text-sm rounded hover:bg-yellow-200">
                                ✏️ Edit
                            </button>


                            <form action="{{ route('orderimportations.destroy', $order->id) }}" method="POST"
                                onsubmit="return confirm('Are you sure you want to delete this order?')"
                                class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="inline-flex items-center px-3 py-1.5 bg-red-100 text-red-700 hover:bg-red-200 hover:text-red-900 text-sm font-semibold rounded-lg transition">
                                    🗑️ Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="10" class="text-center py-4 text-gray-500">No order importations found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </x-app-layout>
    <!-- CREATE MODAL -->
    <div x-show="createModal" style="display: none;"
        class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
        <div class="bg-white p-6 rounded-lg w-full max-w-3xl">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-lg font-semibold">Add Order</h2>
                <button @click="createModal = false" class="text-gray-600 hover:text-red-600 text-xl">&times;</button>
            </div>
            @include('orderimportations.create')
        </div>
    </div>
    <!-- EDIT MODAL -->
    <div x-show="editModal" style="display: none;"
        class="fixed inset-0 z-50 bg-black bg-opacity-50 flex items-center justify-center">
        <div class="bg-white rounded-lg shadow p-6 w-full max-w-2xl">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-lg font-semibold">Edit Order</h2>
                <button @click="editModal = false" class="text-red-600 text-xl font-bold">&times;</button>
            </div>
            @include('orderimportations.edit')
        </div>
    </div>



</div>
<script>
    function orderModals() {
        return {
            createModal: false,
            editModal: false,

            openEditModal(order) {
                // Open modal
                this.editModal = true;

                // Set form action
                const form = document.getElementById('editForm');
                form.action = `/orderimportations/${order.id}`;

                // Fill input values
                document.getElementById('edit_id_ord').value = order.id_ord ?? '';
                document.getElementById('edit_id_fourniseur').value = order.id_fourniseur ?? '';
                document.getElementById('edit_date_offre').value = order.date_offre ?? '';
                document.getElementById('edit_offre').value = order.offre ?? '';
                document.getElementById('edit_date_contre_offre').value = order.date_contre_offre ?? '';
                document.getElementById('edit_contre_offre').value = order.contre_offre ?? '';
                document.getElementById('edit_date_confirmation').value = order.date_confirmation ?? '';
                document.getElementById('edit_confirmation').value = order.confirmation ?? '';
                document.getElementById('edit_status').value = order.status ?? '';
            }
        }
    }
</script>