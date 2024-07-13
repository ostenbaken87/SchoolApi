<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class KlassResource extends JsonResource
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
                'name' => $this->name,
            ];
        }

        // sort by order
        $lectures = $this->lectures->sortBy(function ($lecture) {
            return $lecture->pivot->order; 
        });

        return [
            'id' => $this->id,
            'name' => $this->name,
            'students' => $this->students->pluck('name'),
            'lectures' => LectureResource::collection($lectures),
            'lecturesCount' => $this->lectures->count(),
            'studentsCount' => $this->students->count(),
            'created_at' => Carbon::parse($this->created_at)->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::parse($this->updated_at)->format('Y-m-d H:i:s'),
        ];
    }
}
