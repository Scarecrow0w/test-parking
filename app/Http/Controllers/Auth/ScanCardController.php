<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ScanCardRequest;
use App\Models\Card;
use App\Models\Parking;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class ScanCardController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(ScanCardRequest $request, Parking $parking): RedirectResponse
    {
        Auth::login(Card::with('user')->find($request->validated()['card_id'])->user);

        return to_route('parkings.show', $parking);
    }
}
