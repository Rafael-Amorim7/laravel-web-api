<?php

namespace App\Listeners;

use App\Events\SeriesDestroy;
use Illuminate\Support\Facades\File;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class DeleteCoverSeries
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(SeriesDestroy $event): void
    {
        File::delete(public_path('storage/'.$event->seriesCoverPath));
    }
}
