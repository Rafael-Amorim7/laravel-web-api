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
        //$series = DB::select('SELECT name FROM series');
        //$series = Series::all();
        $series = Series::query()->orderBy('name')->get();
        $mensagem = session('mensagem.sucesso');

        return view('series.index', compact(['series', 'mensagem']));
    }

    public function create(Request $request) {
        return view('series.create');
    }

    public function store(SeriesFormRequest $request){
        //$request->validate([
        //    'name' => 'required|min:3'
        //]);

        //$nameSerie = $request->input('name');
        // //DB::insert('INSERT INTO series (name) VALUES (?)', [ $nameSerie ]);
        //$serie = new Series();
        //$serie->name = $nameSerie;
        //$serie->save();
        //Series::create($request->only(['name'])); // Caso for dar um update
        //Series::create($request->except(['_token'])); // Caso for dar um update
        $series = $this->repository->add($request);

        //$request->session()->flash('mensagem.sucesso', "Series '{$series->name}' create successfully");
        return to_route('series.index')
            ->with('mensagem.sucesso', "Series '{$series->name}' create successfully");
    }

    public function destroy(Series $series) {
        //dd($request->route()); // The best to debug

        //Series::find($request->series);
        //Series::destroy($request->series);

        $series->delete();

        //$request->session()->flash('mensagem.sucesso', "Series '{$series->name}' removed successfully");
        return to_route('series.index')
            ->with('mensagem.sucesso', "Series '{$series->name}' removed successfully");
    }

    public function edit(Series $series) {
        return view('series.edit')
            ->with('series', $series);
    }

    public function update(Series $series, SeriesFormRequest $request){
        //$series->name = $request->name;
        $series->fill($request->all()); // Usa os atributos $fillable da Model Series
        $series->save();

        return to_route('series.index')
            ->with('mensagem.sucesso', "Series '{$series->name}' successfully updated");
    }
}
