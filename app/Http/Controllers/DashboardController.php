<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Predom;
class DashboardController extends Controller
{
public function index()
{
    $statusCounts = Predom::selectRaw('status, COUNT(*) as count')
        ->groupBy('status')
        ->pluck('count', 'status')
        ->toArray();

    return view('dashboard', compact('statusCounts'));
}
}
