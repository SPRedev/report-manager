<form id="editForm" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="grid grid-cols-2 gap-4">
        <div>
            <label for="edit_id_ord">Order ID</label>
            <input id="edit_id_ord" name="id_ord" type="text" class="w-full border rounded" required>
        </div>

        <div>
            <label for="edit_id_fourniseur">Fourniseur</label>
            <select id="edit_id_fourniseur" name="id_fourniseur" class="w-full border rounded" required>
                @foreach($fourniseurs as $fourniseur)
                    <option value="{{ $fourniseur->id }}">{{ $fourniseur->fourniseur_name }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="edit_date_offre">Date Offre</label>
            <input id="edit_date_offre" name="date_offre" type="date" class="w-full border rounded">
        </div>

        <div>
            <label for="edit_offre">Offre</label>
            <input id="edit_offre" name="offre" type="file" class="w-full border rounded">

        </div>

        <div>
            <label for="edit_date_contre_offre">Date Contre Offre</label>
            <input id="edit_date_contre_offre" name="date_contre_offre" type="date" class="w-full border rounded">
        </div>

        <div>
            <label for="edit_contre_offre">Contre Offre</label>
            <input id="edit_contre_offre" name="contre_offre" type="file" class="w-full border rounded">
        </div>

        <div>
            <label for="edit_date_confirmation">Date Confirmation</label>
            <input id="edit_date_confirmation" name="date_confirmation" type="date" class="w-full border rounded">
        </div>

        <div>
            <label for="edit_confirmation">Confirmation</label>
            <input id="edit_confirmation" name="confirmation" type="file" class="w-full border rounded">
        </div>

        <div>
            <label for="edit_status">Status</label>
            <input id="edit_status" name="status" type="text" class="w-full border rounded">
        </div>
    </div>

    <div class="mt-4 text-right">
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Update</button>
    </div>
</form>
