<?php

namespace App\Http\Controllers;

use App\Http\Requests\Ad\StoreRequest;
use App\Http\Requests\Ad\UpdateRequest;
use App\Http\Resources\AdResource;
use App\Jobs\UpdateAdStatusJob;
use App\Models\Ad;
use Illuminate\Http\Request;

class AdController extends Controller
{
    public function index()
    {
        $ads = Ad::all();
        return AdResource::collection($ads);
    }

    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        $ad = Ad::create($data);
        return new AdResource($ad);
    }

    public function show(Ad $ad){
        return new AdResource($ad);
    }

    public function update(UpdateRequest $request, Ad $ad){
        $data = $request->validated();
        $ad->update($data);

        return new AdResource($ad);
    }

}
