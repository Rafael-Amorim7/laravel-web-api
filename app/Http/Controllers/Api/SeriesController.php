<?php

namespace App\Http\Controllers\Api;

use App\Models\Series;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\SeriesRequest;
use App\Repositories\EloquentSeriesRepository;

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
        return Series::whereId($series)->with('seasons.episodes')->first();
    }

    public function update(Series $series, Request $request)
    {
        $series->fill($request->all());
        $series->save();

        return $series;
    }

    public function destroy(Series $series) {
        Series::destroy($series);
        return response()->noContent();
    }
}
