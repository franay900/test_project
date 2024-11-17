<?php

namespace App\Observers;

use App\Jobs\UpdateAdStatusJob;
use App\Models\Ad;

class AdObserver
{
    /**
     * Handle the Ad "created" event.
     */
    public function created(Ad $ad): void
    {
        //
    }

    /**
     * Handle the Ad "updated" event.
     */
    public function updated(Ad $ad): void
    {
        if ($ad->getOriginal('budget') == 0 && $ad->budget > 0 && $ad->getOriginal('status') == 'В ожидании') {

            $ad->status = 'Активен';
            $ad->saveQuietly();
        }

        if($ad->getOriginal('text') != $ad->getAttribute('text')) {

            $ad->status = 'В ожидании';
            $ad->saveQuietly();
            UpdateAdStatusJob::dispatch($ad->id)->delay(now()->addMinutes(3));
        }
    }

    /**
     * Handle the Ad "deleted" event.
     */
    public function deleted(Ad $ad): void
    {
        //
    }

    /**
     * Handle the Ad "restored" event.
     */
    public function restored(Ad $ad): void
    {
        //
    }

    /**
     * Handle the Ad "force deleted" event.
     */
    public function forceDeleted(Ad $ad): void
    {
        //
    }
}
