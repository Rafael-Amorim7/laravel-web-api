<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SeriesRequest;
use App\Models\Series;

class SeriesController extends Controller
{
    public function index()
    {
        return Series::all();
    }

    public function store(SeriesRequest $request)
    {
        return response()
            ->json(Series::create($request->all()), 201);
    }
}
