<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800">➕ New predom</h2>
        </div>
    </x-slot>

    <div class="p-6 max-w-3xl mx-auto bg-white shadow-md rounded-lg mt-6">
        <form method="POST" action="{{ route('predoms.store') }}" class="space-y-6">
            @csrf
             <input type="hidden" name="importation_id" value="{{ $importation_id }}">
            {{-- importation_id --}}
            <div>
                <label for="importation_id" class="block text-sm font-medium text-gray-700 mb-1">importation_id</label>
                <select name="importation_id" id="importation_id"
                    class="w-full border-gray-300 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500">
                    @foreach($importations as $im)
                    <option value="{{ $im->id }}">{{ $im->importation_id }}</option>
                    @endforeach
                </select>
            </div>
            {{-- predom id --}}
            <div>
                <x-input-label for="predom_id" value="Predom" />
                <x-text-input id="predom_id" name="predom_id" class="mt-1 block w-full" required />
                @error('predom_id')
                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- predom Date --}}
            <div>
                <label for="date_predom" class="block text-sm font-medium text-gray-700 mb-1">predom
                    Date</label>
                <input type="date" name="date_predom" id="date_predom"
                    class="w-full border-gray-300 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500"
                    value="{{ now()->toDateString() }}">
            </div>
                {{-- Status --}}
            <div>
                <x-input-label for="status" value="Status" />
                <textarea id="status" name="status" rows="3"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-purple-500 focus:ring focus:ring-purple-200 focus:ring-opacity-50"></textarea>
                @error('status')
                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
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