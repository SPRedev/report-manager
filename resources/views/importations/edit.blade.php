<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">✏️ Edit importations</h2>
    </x-slot>

    <div class="p-6 max-w-3xl mx-auto bg-white shadow-md rounded-lg mt-6">
        <form method="POST" action="{{ route('importations.update', $importations) }}" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <x-input-label for="importation_id" value="importation number" />
                <x-text-input id="importation_id" name="importation_id" class="mt-1 block w-full"
                    value="{{ old('importation_id', $importations->importation_id) }}" required />
                @error('importation_id')
                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <x-input-label for="fourniseur_name" value="fourniseur" />
                <select name="fourniseur_name" id="fourniseur_name" class="w-full border rounded px-2 py-1">
                  @foreach($fourniseurs as $f)
                    <option value="{{ $f->id }}" {{ $f->id === $order->fourniseur_name ? 'selected' : '' }}>
                      {{ $c->fourniseur_name }}
                    </option>
                  @endforeach
                </select>
              </div>
              <div>
                <x-input-label for="importation_date" value="importation Date" />
                <x-text-input name="importation_date" type="date" value="{{ \Carbon\Carbon::parse($importation->importation_date)->format('Y-m-d') }}" />
              </div>

            <div>
                <x-input-label for="montant_algex" value="montant algex" />
                <x-text-input id="montant_algex" name="montant_algex" class="mt-1 block w-full"
                    value="{{ old('montant_algex', $importations->montant_algex) }}" />
                @error('montant_algex')
                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <x-input-label for="montant_definitive" value="montant definitive" />
                <x-text-input id="montant_definitive" name="montant_definitive" type="montant_definitive" class="mt-1 block w-full"
                    value="{{ old('montant_definitive', $importations->montant_definitive) }}" />
                @error('montant_definitive')
                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <x-input-label for="status" value="Status" />
                <textarea id="status" name="status" rows="3"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-purple-500 focus:ring focus:ring-purple-200 focus:ring-opacity-50">{{ old('status', $importations->status) }}</textarea>
                @error('status')
                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end">
                <x-primary-button>Update importations</x-primary-button>
            </div>
        </form>
    </div>
</x-app-layout>
