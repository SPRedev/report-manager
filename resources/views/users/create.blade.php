<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">➕ Create New User</h2>
    </x-slot>

    <div class="max-w-2xl mx-auto mt-6 bg-white p-6 rounded-lg shadow">
        <form action="{{ route('users.store') }}" method="POST" class="space-y-6">
            @csrf

            <div>
                <x-input-label for="name" value="Name" />
                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" required />
                @error('name') <p class="text-sm text-red-500 mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <x-input-label for="email" value="Email" />
                <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" required />
                @error('email') <p class="text-sm text-red-500 mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <x-input-label for="password" value="Password" />
                <x-text-input id="password" name="password" type="password" class="mt-1 block w-full" required />
                @error('password') <p class="text-sm text-red-500 mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <x-input-label for="role" value="Role" />
                <select id="role" name="role" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-purple-500 focus:ring focus:ring-purple-200 focus:ring-opacity-50" required>
                    <option value="admin">Admin</option>
                    <option value="commercial">Commercial</option>
                    <option value="appro">appro</option>
                    <option value="warehouse">Warehouse</option>
                </select>
                @error('role') <p class="text-sm text-red-500 mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="flex justify-end">
                <x-primary-button>Save</x-primary-button>
            </div>
        </form>
    </div>
</x-app-layout>
