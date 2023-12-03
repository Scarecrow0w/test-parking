<?php

namespace App\Http\Controllers;

use App\Models\Parking;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ParkingController extends Controller
{
    /**
     * Display the specified resource.
     */
    public function show(Parking $parking): View
    {
        return view('pages.parkings.show', [
            'parking' => $parking->load('barrier', 'carSpots.lamppost'),
            'user' => Auth::user()?->load('card', 'activeSession'),
        ]);
    }
}
