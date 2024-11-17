<?php

namespace App\Http\Controllers;

use App\Http\Requests\Campaign\StoreRequest;
use App\Http\Requests\Campaign\UpdateRequest;
use App\Http\Resources\CampaignResource;
use App\Models\Campaign;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;


class CampaignController extends Controller
{
    public function index()
    {
        $user = JWTAuth::parseToken()->authenticate();

        if ($user->is_admin) {

            return CampaignResource::collection(Campaign::all());
        }
        return CampaignResource::collection($user->campaigns);
    }

    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        $data['creator_id'] = JWTAuth::parseToken()->authenticate()->id;
        $campaign = Campaign::create($data);
        return new CampaignResource($campaign);
    }


    public function update(UpdateRequest $request, Campaign $campaign)
    {
        $data = $request->validated();
        $campaign->update($data);
        return new CampaignResource($campaign);
    }
}
