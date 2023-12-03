<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Parking;
use App\Pipelines\FinishSession;
use App\Pipelines\MarkCarSpotAsBusy;
use App\Pipelines\MarkCarSpotAsFree;
use App\Pipelines\OpenBarrier;
use App\Pipelines\PayForParking;
use App\Pipelines\SelectCarSpot;
use App\Pipelines\StartSession;
use App\Pipelines\TurnOnLamppost;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Pipeline;

class ParkingController extends Controller
{
    /**
     * Start parking session.
     */
    public function start(Parking $parking): JsonResponse
    {
        DB::beginTransaction();

        $result = Pipeline::send([
            'parking' => $parking,
            'user' => auth()->user(),
        ])->through([
            SelectCarSpot::class,
            MarkCarSpotAsBusy::class,
            OpenBarrier::class,
            StartSession::class,
            TurnOnLamppost::class,
        ])->thenReturn();

        DB::commit();

        return response()->json([
            'car_spot' => $result['car_spot']->name,
        ]);
    }

    /**
     * Finish parking session.
     */
    public function finish(Parking $parking): Response
    {
        DB::beginTransaction();

        Pipeline::send([
            'user' => auth()->user()->load('activeSession.carSpot'),
            'parking' => $parking,
        ])->through([
            FinishSession::class,
            OpenBarrier::class,
            TurnOnLamppost::class,
            PayForParking::class,
            MarkCarSpotAsFree::class,
        ])->thenReturn();

        DB::commit();

        return response()->noContent();
    }
}
