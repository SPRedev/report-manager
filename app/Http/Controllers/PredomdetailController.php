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
        // Initial log
        logger()->debug("Incoming form data: ", $request->all());

        // Check if file is present
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $originalName = $file->getClientOriginalName();
            logger()->debug("File received: " . $originalName);

            // Sanitize filename
            $filename = time() . '_' . $field . '_' . preg_replace('/[^A-Za-z0-9_\-]/', '_', pathinfo($originalName, PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();

            // Ensure directory exists
            $directory = storage_path('app/public/PredomFiles');
            if (!File::exists($directory)) {
                File::makeDirectory($directory, 0755, true);
                logger()->debug("Created directory: $directory");
            }

// Save the file in storage/app/public/PredomFiles
$path = $file->storeAs('PredomFiles', $filename, 'public');
logger()->debug("Saved to path: " . $path);

// Save relative path for the asset() helper
$predomdetail->$field = 'PredomFiles/' . $filename;


        } else {
            logger()->warning("No file received in request.");
            return redirect()->back()->with('error', 'No file was uploaded.');
        }

        // Update the status field
        $predomdetail->$statusField = $request->status;

        // Save changes
        $predomdetail->save();
        logger()->debug("Database updated: field = $field, statusField = $statusField");

        return redirect()->back()->with('success', 'Field updated and file uploaded successfully.');

    } catch (\Exception $e) {
        logger()->error("Exception during file upload/update: " . $e->getMessage());
        return redirect()->back()->with('error', 'Upload failed: ' . $e->getMessage());
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
        if ($filePath && Storage::disk('public')->exists($filePath)) {
            Storage::disk('public')->delete($filePath);
            logger()->debug("Deleted file: storage/app/public/$filePath");
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
