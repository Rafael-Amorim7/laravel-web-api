<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Series;
use Illuminate\Http\Request;

class SeasonsController extends Controller
{
    public function index(int $series)
    {
        $series = Series::with('seasons.episodes')->find($series);
        if ($series === null) {
            return response()->json(['message' => 'Seasons not found'], 404);
        }

        return $series;

    }
}
