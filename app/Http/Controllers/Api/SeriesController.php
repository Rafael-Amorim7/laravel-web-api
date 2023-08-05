<?php

namespace App\Http\Controllers\Api;

use App\Models\Series;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\SeriesRequest;
use App\Repositories\EloquentSeriesRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class SeriesController extends Controller
{
    public function __construct(private EloquentSeriesRepository $repository) {}

    public function index()
    {
        return Series::all();
    }

    public function store(SeriesRequest $request)
    {
        return response()
            ->json($this->repository->add($request), 201);
    }

    public function show(int $series)
    {
        $seriesModel = Series::with('seasons.episodes')->find($series);
        if ($seriesModel === null) {
            return response()->json(['message' => 'Series not found'], 404);
        }

        return $seriesModel;
    }

    public function update(int $series, Request $request)
    {
        $series = Series::find($series);

        if (!$series) {
            return response()->json(['message' => 'Series not found.'], 404);
        }

        $series->update($request->all());

        return $series;
    }

    public function destroy(Series $series) {
        Series::destroy($series);
        return response()->noContent();
    }
}
