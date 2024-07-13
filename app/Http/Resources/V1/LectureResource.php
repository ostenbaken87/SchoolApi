<?php

namespace App\Http\Resources\V1;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LectureResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        if ($request->query('onlyBasicInfo', false)) {
            return [
                'id' => $this->id,
                'topic' => $this->topic,
                'description' => $this->description,
            ];
        }
        
        return [
            'id' => $this->id,
            'topic' => $this->topic,
            'description' => $this->description,
            'students' => $this->students?->pluck('name'),
            'klass' => $this->klass?->pluck('name'),
            'created_at' => Carbon::parse($this->created_at)->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::parse($this->updated_at)->format('Y-m-d H:i:s'),
        ];
    }
}
