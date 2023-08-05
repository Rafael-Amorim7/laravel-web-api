<?php

namespace App\Http\Controllers\Api;

use App\Models\Series;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\SeriesRequest;
use App\Repositories\EloquentSeriesRepository;
use Illuminate\Contracts\Auth\Authenticatable;

class SeriesController extends Controller
{
    public function __construct(private EloquentSeriesRepository $repository) {}

    public function index(Request $request)
    {
        $query = Series::query();
        if ($request->has('name')) {
            $query->where('name' , $request->name);
        }

        return $query->paginate(5);
    }

    public function store(SeriesRequest $request)
    {
        return response()
            ->json($this->repository->add($request), 201);
    }

    public function show(int $series)
    {
        $series = Series::find($series);
        if ($series === null) {
            return response()->json(['message' => 'Series not found'], 404);
        }

        return $series;
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

    public function destroy(Series $series, Authenticatable $user) {
        if (!$user->tokenCan('series:delete')) {
            return response()->json('Forbidden', 403);
        }
        Series::destroy($series);
        return response()->noContent();
    }

    public function episodes(int $series)
    {
        $series = Series::find($series);

        if (!$series) {
            return response()->json(['message' => 'Series not found.'], 404);
        }

        return $series->episodes;
    }
}
