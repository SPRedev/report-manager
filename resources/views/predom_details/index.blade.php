<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 flex items-center space-x-2">
            <span>Predom Detail</span>
            <span class="inline-block px-3 py-1 text-sm font-semibold bg-purple-100 text-purple-800 rounded-full shadow">
                {{ $predomdetail->predom->predom_id ?? 'Does not exist or deleted' }}
            </span>
        </h2>

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded my-2">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded my-2">
                {{ session('error') }}
            </div>
        @endif
    </x-slot>

    @if ($predomdetail)
        <div class="mt-6 bg-white shadow rounded-lg overflow-hidden max-w-3xl mx-auto">
            <table class="w-full text-sm text-left text-gray-700">
                <thead class="bg-gray-50 border-b text-gray-600 uppercase text-xs">
                    <tr>
                        <th class="px-6 py-3">Predom Info</th>
                        <th class="px-6 py-3">File</th>
                        <th class="px-6 py-3">Status</th>
                        <th class="px-6 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach (['rc_nif', 'decision', 'tax', 'certificate', 'facture', 'engagement'] as $field)
                        @php
                            $statusField = $field . '_statust';
                            $status = $predomdetail->$statusField ?? 'N/A';
                            $badgeColor = match($status) {
                                'Approved' => 'bg-green-100 text-green-700',
                                'Pending' => 'bg-yellow-100 text-yellow-700',
                                'Rejected' => 'bg-red-100 text-red-700',
                                default => 'bg-gray-100 text-gray-600'
                            };
                        @endphp
                        <tr class="border-t hover:bg-gray-50">
                            <td class="px-6 py-4 capitalize">{{ str_replace('_', ' ', $field) }}</td>
                            <td class="px-6 py-4">
    @if ($predomdetail->$field)
        <div class="flex items-center space-x-3">
            <a href="{{ asset($predomdetail->$field) }}" target="_blank"
               class="inline-flex items-center px-3 py-1 bg-blue-100 text-blue-600 text-sm font-medium rounded hover:bg-blue-200 transition">
                🔗 View
            </a>

            <form method="POST" action="{{ route('predomdetails.deleteField', $predomdetail->id) }}"
                  onsubmit="return confirm('Delete this file?')">
                @csrf
                <input type="hidden" name="field" value="{{ $field }}">
                <button type="submit"
                        class="inline-flex items-center px-3 py-1 bg-red-100 text-red-600 text-sm font-medium rounded hover:bg-red-200 transition">
                    🗑 Delete
                </button>
            </form>
        </div>
    @else
        <span class="text-sm text-gray-400 italic">No file</span>
    @endif
</td>

                            <td class="px-6 py-4">
                                <span class="px-2 py-1 rounded-full text-xs font-semibold {{ $badgeColor }}">
                                    {{ $status }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <button onclick="openModal('{{ $field }}')" class="inline-flex items-center px-3 py-1.5 bg-yellow-100 text-yellow-800 hover:bg-yellow-200 text-sm font-semibold rounded-lg">
                                    ✏️ Edit
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="text-center py-10 text-gray-500">No predom detail found.</div>
    @endif

    <!-- Modal -->
    <div id="editModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center">
        <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-md relative">
            <h3 class="text-lg font-bold mb-4">Edit Document</h3>
            <form id="editForm" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="field" id="modalField">

                <div class="mb-4">
                    <label for="file" class="block text-sm font-medium text-gray-700">Upload File</label>
                    <input type="file" name="file" id="file" class="mt-1 block w-full text-sm text-gray-600 border rounded p-2">
                </div>

                <div class="mb-4">
                    <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                    <select name="status" id="status" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        <option value="Pending">Pending</option>
                        <option value="Approved">Approved</option>
                        <option value="Rejected">Rejected</option>
                    </select>
                </div>

                <div class="flex justify-end">
                    <button type="button" onclick="closeModal()" class="mr-2 px-4 py-2 text-gray-600">Cancel</button>
                    <button type="submit" class="px-4 py-2 bg-purple-600 text-white rounded hover:bg-purple-700">Save</button>
                </div>
            </form>
            <button onclick="closeModal()" class="absolute top-2 right-2 text-gray-500 hover:text-gray-700">✖</button>
        </div>
    </div>

@if ($predomdetail)
<script>
    function openModal(field) {
        const form = document.getElementById('editForm');
        form.action = `/predomdetails/{{ $predomdetail->id }}/update-field`;
        document.getElementById('modalField').value = field;
        document.getElementById('editModal').classList.remove('hidden');
    }

    function closeModal() {
        document.getElementById('editModal').classList.add('hidden');
    }
</script>
@endif

</x-app-layout>
