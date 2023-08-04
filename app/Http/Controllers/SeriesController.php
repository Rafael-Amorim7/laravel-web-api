<?php

namespace App\Http\Controllers;

use App\Http\Requests\SeriesFormRequest;
use App\Models\Series;
use App\Mail\SeriesCreated;
use App\Models\User;
use app\Repositories\SeriesRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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

        $userList = User::all();
        foreach ($userList as $index => $user) {
            $email = new SeriesCreated(
                $series->name,
                $series->id,
                $request->season,
                $request->episodes,
            );
            $when = now()->addSeconds($index * 5);
            Mail::to($user)->later($when, $email);
        }

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
