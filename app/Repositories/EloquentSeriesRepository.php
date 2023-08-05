<?php
namespace App\Repositories;

use App\Http\Requests\SeriesRequest;
use App\Models\Episode;
use App\Models\Season;
use App\Models\Series;
use App\Repositories\SeriesRepository;
use Illuminate\Support\Facades\DB;

class EloquentSeriesRepository implements SeriesRepository
{
    public function add(SeriesRequest $request): Series
    {
        return DB::transaction(function () use ($request)  {
            $series = Series::create([
                'name' => $request->name,
                'cover' => $request->coverPath ?? null,
            ]);

            $seasons = [];
            for ($i = 0; $i < $request->seasons; $i++) {
                $seasons[] = [
                    'series_id' => $series->id,
                    'number' => $i + 1
                ];
            }
            Season::insert($seasons);

            $episodes = [];
            foreach ($series->seasons as $season) {
                for ($j = 0; $j < $request->episodes; $j++) {
                    $episodes[] = [
                        'season_id' => $season->id,
                        'number' => $j + 1
                    ];
                }
            }
            Episode::insert($episodes);

            return $series;
        }, 5); // max 5 attempts to avoid deadlock

        //DB::beginTransaction();
        // your code here
        //DB::commit();
    }
}
