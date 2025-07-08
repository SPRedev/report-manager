<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800">✏️ Edit Predom</h2>
        </div>
    </x-slot>

    <div class="p-6 max-w-3xl mx-auto bg-white shadow-md rounded-lg mt-6">
        <form method="POST" action="{{ route('predoms.update', $predom->id) }}" class="space-y-6">
            @csrf
            @method('PUT')

            {{-- Hidden importation ID --}}
            <input type="hidden" name="importation_id" value="{{ $predom->importation_id }}">

            {{-- predom id --}}
            <div>
                <x-input-label for="predom_id" value="Predom" />
                <x-text-input id="predom_id" name="predom_id" class="mt-1 block w-full"
                    value="{{ old('predom_id', $predom->predom_id) }}" required />
                @error('predom_id')
                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- predom Date --}}
            <div>
                <label for="date_predom" class="block text-sm font-medium text-gray-700 mb-1">Predom Date</label>
                <input type="date" name="date_predom" id="date_predom"
                    class="w-full border-gray-300 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500"
                    value="{{ old('date_predom', $predom->date_predom) }}">
            </div>

            {{-- Status --}}
            <div>
                              <select name="status" id="status" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        <option value="Pending">Pending</option>
                        <option value="Approved">Approved</option>
                        <option value="Rejected">Rejected</option>
                    </select>
            </div>

            {{-- Save Button --}}
            <div>
                <button type="submit"
                    class="bg-purple-600 hover:bg-purple-700 text-white px-6 py-2 rounded-lg shadow text-sm">
                    💾 Update Predom
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
