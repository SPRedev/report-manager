<?php

namespace App\Http\Controllers;

use Illuminate\Support\Carbon;
use App\Models\Predom;

class NotificationController extends Controller
{
   public function fetch()
{
    $notifications = [];

    $today = now()->startOfDay();
    $tenDaysLater = $today->copy()->addDays(10);

    // 🔔 Only show those expiring in next 10 days, not expired
    $predoms = \App\Models\Predom::whereDate('date_predom', '<=', $tenDaysLater)
        ->whereDate('date_predom', '>=', $today) // >= today means not expired yet
        ->where('status', 'pending')
        ->orderBy('date_predom')
        ->get(['id', 'predom_id', 'date_predom']);

    foreach ($predoms as $predom) {
        $notifications[] = [
            'type' => 'predom',
            'title' => "Predom #{$predom->predom_id} is expiring soon",
            'message' => 'Expires on ' . \Carbon\Carbon::parse($predom->date_predom)->format('Y-m-d'),
            'link' => route('predoms.edit', $predom),
        ];
    }

    return response()->json($notifications);
}

}
