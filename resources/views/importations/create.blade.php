<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800">➕ New importation</h2>
        </div>
    </x-slot>

    <div class="p-6 max-w-3xl mx-auto bg-white shadow-md rounded-lg mt-6">
        <form method="POST" action="{{ route('importations.store') }}" class="space-y-6">
            @csrf

            {{-- fourniseur --}}
            <div>
                <label for="fourniseur_name" class="block text-sm font-medium text-gray-700 mb-1">fourniseur</label>
                <select name="fourniseur_name" id="fourniseur_name"
                    class="w-full border-gray-300 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500">
                    @foreach($fourniseurs as $f)
                    <option value="{{ $f->id }}">{{ $f->fourniseur_name }}</option>
                    @endforeach
                </select>
            </div>
            {{-- importation Date --}}
            <div>
                <label for="importation_date" class="block text-sm font-medium text-gray-700 mb-1">importation
                    Date</label>
                <input type="date" name="importation_date" id="importation_date"
                    class="w-full border-gray-300 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500"
                    value="{{ now()->toDateString() }}">
            </div>
            {{-- importation montant algex --}}

            <div>
                <x-input-label for="montant_algex" value="montant algex" />
                <x-text-input id="montant_algex" name="montant_algex" class="mt-1 block w-full" required />
                @error('montant_algex')
                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>
            {{-- importation montant definitive --}}

            <div>
                <x-input-label for="montant_definitive" value="montant definitive" />
                <x-text-input id="montant_definitive" name="montant_definitive" class="mt-1 block w-full" required />
                @error('montant_definitive')
                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <x-input-label for="montant_definitive" value="montant definitive" />
                <x-text-input id="montant_definitive" name="montant_definitive" class="mt-1 block w-full" required />
                @error('montant_definitive')
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