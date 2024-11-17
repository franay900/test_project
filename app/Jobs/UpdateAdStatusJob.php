<?php

namespace App\Jobs;

use App\Models\Ad;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class UpdateAdStatusJob implements ShouldQueue
{
    use Queueable;

    protected $adId;


    public function __construct($adId)
    {
        $this->adId = $adId;

    }


    public function handle(): void
    {

        $ad = Ad::find($this->adId);
        $ad->update(['status' => 'Активен']);


    }
}
