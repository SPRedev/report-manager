<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 flex items-center space-x-2">
    <span>Predom Detail</span>
    <span class="inline-block px-3 py-1 text-sm font-semibold bg-purple-100 text-purple-800 rounded-full shadow">
        {{ $predomdetail->predom->predom_id ?? 'Dont existe or Deleted' }}
    </span>
</h2>

    </x-slot>

    @if ($predomdetail)
        <div class="mt-6 bg-white shadow rounded-lg overflow-hidden max-w-3xl mx-auto">
            <table class="w-full text-sm text-left text-gray-700">
                <thead class="bg-gray-50 border-b text-gray-600 uppercase text-xs">
                    <tr>
                        <th class="px-6 py-3">Predom Info</th>
                        <th class="px-6 py-3">File</th>
                        <th class="px-6 py-3">Status</th>
                        <th class="px-6 py-3">Action</th>
                    </tr>
                </thead>
                <tbody>
 
                    @foreach (['rc_nif', 'decision', 'tax', 'certificate', 'facture', 'engagement'] as $field)
                        @php
                            $statusField = $field . '_statust';
                            $status = $predomdetail->$statusField ?? 'N/A';
                            $badgeColor = match ($status) {
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
                                    <a href="{{ asset('storage/' . $predomdetail->$field) }}" class="text-blue-600 hover:text-blue-800">
                                        📎 Download
                                    </a>
                                @else
                                    <span class="text-sm text-gray-400 italic">No file</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 rounded-full text-xs font-semibold {{ $badgeColor }}">
                                    {{ $status }}
                                </span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="text-center py-10 text-gray-500">No predom detail found.</div>
    @endif
</x-app-layout>
