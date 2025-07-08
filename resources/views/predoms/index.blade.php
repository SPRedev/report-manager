<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800">All Predoms</h2>
                        <a href="{{ route('predoms.create') }}"
                class="bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded-lg text-sm shadow">
                + Add predom
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
                    <th class="px-6 py-3">predom_id</th>
                    <th class="px-6 py-3">date_predom</th>
                    <th class="px-6 py-3">Status</th>
                    <th class="px-6 py-3">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($predoms as $predom)
                    <tr class="border-t hover:bg-gray-50">
                        <td class="px-6 py-4"><a href="{{ route('predom_details.index', $predom->id) }}">{{ $predom->importation->importation_id ?? 'importation supprimé' }}
                        </a></td>
                        <td class="px-6 py-4">{{ $predom->predom_id }}
                        </td>
                        <td class="px-6 py-4">{{ $predom->date_predom }}</td>
                       <td class="px-6 py-4">
    @php
        $status = strtolower($predom->status);
    @endphp
    <span class="inline-block px-2 py-1 rounded-full text-xs font-semibold
        @if ($status === 'approved')
            bg-green-100 text-green-700
        @elseif ($status === 'rejected')
            bg-red-100 text-red-700
        @elseif ($status === 'pending')
            bg-yellow-100 text-yellow-800
        @else
            bg-gray-200 text-gray-600
        @endif
    ">
        {{ ucfirst($status) }}
    </span>
</td>

                        <td class="px-6 py-4 flex space-x-2">
                            <a href="{{ route('predoms.edit', $predom) }}" class="inline-flex items-center px-3 py-1.5 bg-yellow-100 text-yellow-800 hover:bg-yellow-200 hover:text-yellow-900 text-sm font-semibold rounded-lg transition">
                                ✏️ Edit
                             </a>
                            <form action="{{ route('predoms.destroy', $predom->id) }}" method="POST"
                                onsubmit="return confirm('Are you sure you want to delete this predom?')">
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

                @if ($predoms->isEmpty())
                    <tr>
                        <td colspan="5" class="text-center py-4 text-gray-500">No predoms found.</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</x-app-layout>
