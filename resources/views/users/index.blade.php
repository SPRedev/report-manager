<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800">Users</h2>
            <a href="{{ route('users.create') }}"
               class="bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded-lg text-sm shadow">
                + Add User
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
                    <th class="px-6 py-3">Email</th>
                    <th class="px-6 py-3">Role</th>
                    <th class="px-6 py-3">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $user)
                    <tr class="border-t hover:bg-gray-50">
                        <td class="px-6 py-4">{{ $user->name }}</td>
                        <td class="px-6 py-4">{{ $user->email }}</td>
                        <td class="px-6 py-4 capitalize">{{ $user->role }}</td>
                        <td class="px-6 py-4 flex space-x-2">
                            {{-- Optional edit link --}}
                            {{-- <a href="{{ route('users.edit', $user) }}" class="text-yellow-600 hover:text-yellow-800 font-medium">Edit</a> --}}
                            <form action="{{ route('users.destroy', $user) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this user?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800 font-medium">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center py-4 text-gray-500">No users found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-app-layout>
