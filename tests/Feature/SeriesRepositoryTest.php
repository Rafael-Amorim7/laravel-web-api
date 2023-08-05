<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Repositories\EloquentSeriesRepository;
use App\Http\Requests\SeriesRequest;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SeriesRepositoryTest extends TestCase
{
    use RefreshDatabase;
    public function test_when_create_series_should_also_create_its_seasons_and_episodes(): void
    {
        $repository = $this->app->make(EloquentSeriesRepository::class);
        $request = new SeriesRequest([
            'name' => 'Series Name',
            'seasons' => 1,
            'episodes' => 1,
        ]);

        $repository->add($request);

        $this->assertDatabaseHas('series', ['name' => 'Series Name']);
        $this->assertDatabaseHas('seasons', ['number' => 1]);
        $this->assertDatabaseHas('episodes', ['number' => 1]);
    }
}
