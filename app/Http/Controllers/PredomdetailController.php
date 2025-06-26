<?php

namespace App\Http\Controllers;
use App\Models\Predomdetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class PredomdetailController extends Controller
{


    public function index($predom_id)
{
    $predomdetail = Predomdetail::where('predom_id', $predom_id)->first();

    if (!$predomdetail) {
       $predomdetail = Predomdetail::create([
    'predom_id' => $predom_id,
    'predomdetail_id' => uniqid(), // or another suitable value
    'rc_nif' => '',
    'rc_nif_statust' => 'Pending',
    'decision' => '',
    'decision_statust' => 'Pending',
    'tax' => '',
    'tax_statust' => 'Pending',
    'certificate' => '',
    'certificate_statust' => 'Pending',
    'facture' => '',
    'facture_statust' => 'Pending',
    'engagement' => '',
    'engagement_statust' => 'Pending',
]);

    }

    return view('predom_details.index', compact('predomdetail'));
}


public function updateField(Request $request, $id)
{
    $predomdetail = Predomdetail::findOrFail($id);
    $field = $request->field;
    $statusField = $field . '_statust';

    try {
        logger()->debug("Incoming form data: ", $request->all());

        // Handle file upload if present
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $originalName = $file->getClientOriginalName();
            logger()->debug("File received: " . $originalName);

            // Sanitize and create unique filename
            $filename = time() . '_' . $field . '_' . preg_replace('/[^A-Za-z0-9_\-]/', '_', pathinfo($originalName, PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();

            // Ensure directory exists
            $directory = storage_path('app/public/PredomFiles');$directory = public_path('storage/PredomFiles');

if (!File::exists($directory)) {
    File::makeDirectory($directory, 0755, true);
}

$path = $directory . '/' . $filename;
$file->move($directory, $filename);

// Save public path relative to domain
$predomdetail->$field = 'storage/PredomFiles/' . $filename;

        }

        // Update status field regardless of file upload
        if ($request->has('status')) {
            $predomdetail->$statusField = $request->status;
        }

        // Save any changes
        $predomdetail->save();
        logger()->debug("Updated: field = $field, statusField = $statusField");

        return redirect()->back()->with('success', 'updated successfully.');
    } catch (\Exception $e) {
        logger()->error("Update error: " . $e->getMessage());
        return redirect()->back()->with('error', 'Update failed: ' . $e->getMessage());
    }
}

public function deleteField(Request $request, $id)
{
    $predomdetail = Predomdetail::findOrFail($id);
    $field = $request->field;
    $statusField = $field . '_statust';

    try {
        $filePath = $predomdetail->$field;

        // Delete from storage if file exists
$filePath = public_path($filePath);
if (File::exists($filePath)) {
    File::delete($filePath);
}


        // Remove from DB
        $predomdetail->$field = null;
        $predomdetail->$statusField = null;
        $predomdetail->save();

        return redirect()->back()->with('success', 'File and status deleted successfully.');

    } catch (\Exception $e) {
        logger()->error("Delete error: " . $e->getMessage());
        return redirect()->back()->with('error', 'Delete failed: ' . $e->getMessage());
    }
}

}
