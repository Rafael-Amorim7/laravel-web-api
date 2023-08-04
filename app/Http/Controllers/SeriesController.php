<?php

namespace App\Http\Controllers;

use App\Http\Requests\SeriesFormRequest;
use App\Models\Series;
use app\Repositories\SeriesRepository;
use Illuminate\Http\Request;

class SeriesController extends Controller
{
    public function __construct(private SeriesRepository $repository) {}

    public function index(Request $request) {
       $series = Series::query()->orderBy('name')->get();
        $mensagem = session('mensagem.sucesso');

        return view('series.index', compact(['series', 'mensagem']));
    }

    public function create(Request $request) {
        return view('series.create');
    }

    public function store(SeriesFormRequest $request){
       $series = $this->repository->add($request);

        return to_route('series.index')
            ->with('mensagem.sucesso', "Series '{$series->name}' create successfully");
    }

    public function destroy(Series $series) {

        $series->delete();

        return to_route('series.index')
            ->with('mensagem.sucesso', "Series '{$series->name}' removed successfully");
    }

    public function edit(Series $series) {
        return view('series.edit')
            ->with('series', $series);
    }

    public function update(Series $series, SeriesFormRequest $request){
        $series->fill($request->all());
        $series->save();

        return to_route('series.index')
            ->with('mensagem.sucesso', "Series '{$series->name}' successfully updated");
    }
}
