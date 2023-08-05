<?php

namespace App\Http\Controllers;

use App\Models\Series;
use Illuminate\Http\Request;
use App\Events\SeriesDestroy;
use app\Repositories\SeriesRepository;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Http\Requests\SeriesRequest;
use App\Events\SeriesCreated as EventsSeriesCreated;

class SeriesController extends Controller
{
    public function __construct(private SeriesRepository $repository) {}

    public function index(Request $request) {
       $series = Series::query()->orderBy('name')->get();
        $mensagem = session('mensagem');

        return view('series.index', compact(['series', 'mensagem']));
    }

    public function create(Request $request) {
        return view('series.create');
    }

    public function store(SeriesRequest $request){

       $request->coverPath = $request->file('cover')
            ->store('series_cover', 'public');
       $series = $this->repository->add($request);

       EventsSeriesCreated::dispatch(
            $series->name,
            $series->id,
            $request->seasons,
            $request->episodes,
       );

        return to_route('series.index')
            ->with('mensagem', "Series '{$series->name}' create successfully");
    }

    public function destroy(Series $series) {

        $series->delete();
        SeriesDestroy::dispatch(
            $series->cover
        );

        return to_route('series.index')
            ->with('mensagem', "Series '{$series->name}' removed successfully");
    }

    public function edit(Series $series) {
        return view('series.edit')
            ->with('series', $series);
    }

    public function update(Series $series, SeriesRequest $request){
        $series->fill($request->all());
        $series->save();

        return to_route('series.index')
            ->with('mensagem', "Series '{$series->name}' successfully updated");
    }
}
