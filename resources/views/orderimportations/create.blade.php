<form action="{{ route('orderimportations.store') }}" method="POST" enctype="multipart/form-data">


    @csrf

    <div class="grid grid-cols-2 gap-4">
        <div>
            <label for="id_ord">Order ID</label>
            <input id="id_ord" name="id_ord" type="text" class="w-full border rounded" required>
        </div>

        <div>
            <label for="id_fourniseur">Fourniseur</label>
            <select id="id_fourniseur" name="id_fourniseur" class="w-full border rounded" required>
                @foreach($fourniseurs as $fourniseur)
                    <option value="{{ $fourniseur->id }}">{{ $fourniseur->fourniseur_name }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="date_offre">Date Offre</label>
            <input id="date_offre" name="date_offre" type="date" class="w-full border rounded">
        </div>

        <div>
            <label for="offre">Offre</label>
            <input id="offre" name="offre" type="file" class="w-full border rounded">

        </div>

        <div>
            <label for="date_contre_offre">Date Contre Offre</label>
            <input id="date_contre_offre" name="date_contre_offre" type="date" class="w-full border rounded">
        </div>

        <div>
            <label for="contre_offre">Contre Offre</label>
            <input id="contre_offre" name="contre_offre" type="file" class="w-full border rounded">
        </div>

        <div>
            <label for="date_confirmation">Date Confirmation</label>
            <input id="date_confirmation" name="date_confirmation" type="date" class="w-full border rounded">
        </div>

        <div>
            <label for="confirmation">Confirmation</label>
            <input id="confirmation" name="confirmation" type="file" class="w-full border rounded">
        </div>

        <div>
            <label for="status">Status</label>
            <input id="status" name="status" type="text" class="w-full border rounded">
        </div>
    </div>

    <div class="mt-4 text-right">
        <button type="submit" class="bg-purple-600 text-white px-4 py-2 rounded">Save</button>
    </div>
</form>
