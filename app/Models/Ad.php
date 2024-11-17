<?php

namespace App\Models;

use App\Jobs\UpdateAdStatusJob;
use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    protected $table = 'ads';
    protected $guarded = false;


    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }


}
