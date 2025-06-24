<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800">Fourniseurs</h2>
            <a href="{{ route('fourniseurs.create') }}" class="bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded-lg text-sm shadow">
                + Add fourniseur
            </a>
        </div>
    </x-slot>

    @if(session('success'))
        <div class="mt-4 bg-green-100 text-green-700 px-4 py-2 rounded-md shadow-sm">
            {{ session('success') }}
        </div>
    @endif

    <div class="mt-6 bg-white shadow rounded-lg overflow-hidden">
        <table class="w-full text-sm text-left text-gray-700">
            <thead class="bg-gray-50 border-b text-gray-600 uppercase text-xs">
                <tr>
                    <th class="px-6 py-3">Name</th>
                    <th class="px-6 py-3">Phone</th>
                    <th class="px-6 py-3">Email</th>
                    <th class="px-6 py-3">Region</th>
                    <th class="px-6 py-3">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($fourniseurs as $fourniseur)
                    <tr class="border-t hover:bg-gray-50">
                        <td class="px-6 py-4">{{ $fourniseur->fourniseur_name }}</td>
                        <td class="px-6 py-4">{{ $fourniseur->phone }}</td>
                        <td class="px-6 py-4">{{ $fourniseur->email }}</td>
                        <td class="px-6 py-4">{{ $fourniseur->region }}</td>
                        <td class="px-6 py-4 flex space-x-2">
                            <a href="{{ route('fourniseurs.edit', $fourniseur) }}" class="text-yellow-600 hover:text-yellow-800 font-medium">Edit</a>
                            <form action="{{ route('fourniseurs.destroy', $fourniseur->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this fourniseur?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800 font-medium">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach

                @if($fourniseurs->isEmpty())
                    <tr>
                        <td colspan="5" class="text-center py-4 text-gray-500">No fourniseurs found.</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</x-app-layout>
