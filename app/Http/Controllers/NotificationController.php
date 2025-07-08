<?php
namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Predom;

class NotificationController extends Controller
{
  public function fetch()
{
    $notifications = [];

    $today = now()->startOfDay();

    // Only pending Predoms
    $predoms = Predom::where('status', 'pending')->get(['id', 'predom_id', 'date_predom']);

    foreach ($predoms as $predom) {
        $start = \Carbon\Carbon::parse($predom->date_predom)->startOfDay();
        $expiry = $start->copy()->addDays(30);
        $daysLeft = $today->diffInDays($expiry, false); // false = allow negative (for expired)

        if ($daysLeft <= 10 && $daysLeft >= 0) {
            $notifications[] = [
                'id' => $predom->id,
                'type' => 'predom',
                'title' => "Predom #{$predom->predom_id} expires in {$daysLeft} days",
                'message' => "Expires on {$expiry->format('Y-m-d')}",
                'days_left' => $daysLeft,
                'link' => route('predoms.edit', $predom),
            ];
        }
    }

    return response()->json($notifications);
}

}
