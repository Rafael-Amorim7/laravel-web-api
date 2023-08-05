<?php

namespace App\Http\Controllers;

use App\Events\SeriesCreated as EventsSeriesCreated;
use App\Http\Requests\SeriesFormRequest;
use App\Models\Series;
use app\Repositories\SeriesRepository;
use Illuminate\Http\Request;

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

    public function store(SeriesFormRequest $request){

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

        return to_route('series.index')
            ->with('mensagem', "Series '{$series->name}' removed successfully");
    }

    public function edit(Series $series) {
        return view('series.edit')
            ->with('series', $series);
    }

    public function update(Series $series, SeriesFormRequest $request){
        $series->fill($request->all());
        $series->save();

        return to_route('series.index')
            ->with('mensagem', "Series '{$series->name}' successfully updated");
    }
}
