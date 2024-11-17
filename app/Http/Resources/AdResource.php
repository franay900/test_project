<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AdResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'text' => $this->text,
            'status' => $this->status,
            'url' => $this->url,
            'impressions' => $this->impressions,
            'cpm' => $this->cpm,
            'budget' => $this->budget,
            'button_text' => $this->button_text,
            'campaign_id' => $this->campaign_id,
        ];
    }
}
