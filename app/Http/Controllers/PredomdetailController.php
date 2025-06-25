<?php

namespace App\Http\Controllers;
use App\Models\Predomdetail;
use Illuminate\Http\Request;

class PredomdetailController extends Controller
{
    // public function index()
    // {
    //     $predomdetails = Predomdetail::all();
    //     return view('predom_details.index', compact('predomdetails'));
    // }

public function index($predom_id)
{
    $predomdetail = Predomdetail::where('predom_id', $predom_id)->first();
    return view('predom_details.index', compact('predomdetail'));

}
}
