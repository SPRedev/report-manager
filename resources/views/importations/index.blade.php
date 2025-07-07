<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800">All Importations</h2>
            <a href="{{ route('importations.create') }}"
                class="bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded-lg text-sm shadow">
                + Add importation
            </a>
        </div>
    </x-slot>

    @if (session('success'))
        <div class="mt-4 bg-green-100 text-green-700 px-4 py-2 rounded-md shadow-sm">
            {{ session('success') }}
        </div>
    @endif

    <div class="mt-6 bg-white shadow rounded-lg overflow-hidden">
        <table class="w-full text-sm text-left text-gray-700">
            <thead class="bg-gray-50 border-b text-gray-600 uppercase text-xs">
                <tr>
                    <th class="px-6 py-3">importation number</th>
                    <th class="px-6 py-3">fourniseur_name</th>
                    <th class="px-6 py-3">importation_date</th>
                    <th class="px-6 py-3">Order</th>
                    <th class="px-6 py-3">montant_algex</th>
                    <th class="px-6 py-3">montant_definitive</th>
                    <th class="px-6 py-3">Status</th>
                    <th class="px-6 py-3">Actions</th>
                </tr>
            </thead>
            <tbody id="importation-body">
                @foreach ($importations as $importation)
                    <tr class="border-t hover:bg-gray-50">
                        <td class="px-6 py-4"><a href="{{ route('predoms.create', ['importation_id' => $importation->id]) }}">{{ $importation->importation_id }}
                        </a></td>
                        <td class="px-6 py-4">{{ $importation->fourniseur->fourniseur_name ?? 'Fournisseur supprimé' }}
                        </td>
                        <td class="px-6 py-4">{{ $importation->importation_date }}</td>
                        <td>empty</td>
                        <td class="px-6 py-4">{{ $importation->montant_algex }}</td>
                        <td class="px-6 py-4">{{ $importation->montant_definitive }}</td>
                        <td class="px-6 py-4">{{ $importation->status }}</td>
                        <td class="px-6 py-4 flex space-x-2">
                            <a href="{{ route('importations.edit', $importation) }}" class="inline-flex items-center px-3 py-1.5 bg-yellow-100 text-yellow-800 hover:bg-yellow-200 hover:text-yellow-900 text-sm font-semibold rounded-lg transition">
                                ✏️ Edit
                             </a>
                            <form action="{{ route('importations.destroy', $importation->id) }}" method="POST"
                                onsubmit="return confirm('Are you sure you want to delete this importation?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="inline-flex items-center px-3 py-1.5 bg-red-100 text-red-700 hover:bg-red-200 hover:text-red-900 text-sm font-semibold rounded-lg transition">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" stroke-width="2"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3m-4 0h14" />
                                    </svg>
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach

                @if ($importations->isEmpty())
                    <tr>
                        <td colspan="5" class="text-center py-4 text-gray-500">No importations found.</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('global-search');
    if (searchInput) {
        searchInput.dataset.searchEndpoint = '/importations/search';
        searchInput.dataset.searchTarget = '#importation-body';
    }
});
</script>
@endpush
</x-app-layout>


